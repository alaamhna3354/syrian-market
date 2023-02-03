<?php

namespace App\Http\Controllers;

use App\Models\Marketer;
use App\Models\MarketerLog;
use App\Models\PointsTransaction;
use App\Services\PointsService;
use App\Services\TransactionService;
use CoinGate\Exception;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MarketerController extends Controller
{
    private $pointsService;
    private $transactionService;

    /**
     * MarketerController constructor.
     */
    public function __construct(PointsService $pointsService, TransactionService $transactionService)
    {
        $this->pointsService = $pointsService;
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marketer = auth()->user()->marketer;

        return view('user.pages.marketer.index', compact('marketer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.pages.marketer.join_as_marketer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invitation_code' => 'required',
        ]);
        $user = auth()->user();
        $parent_marketer = Marketer::where('status', 'active')->where('invitation_code', $request->invitation_code)->where('remaining_invitation', '>', 0)->first();

        if (!$parent_marketer)
            return back()->with('error', trans("Invitation code not valid"))->withInput();

        if ($user->id == $parent_marketer->user_id)
            return back()->with('error', trans("You can't invite your self"))->withInput();

        if (!($user->balance >= config('basic.marketer_joining_fee')))
            return back()->with('error', trans("Your balance is not enough"))->withInput();

        DB::beginTransaction();
        try {
            $user->balance -= config('basic.marketer_joining_fee');
            $transaction = $this->transactionService->create('-', config('basic.marketer_joining_fee'), 'Joining as a marketer fee', $user);
            $user->save();

            if ($user->marketer) {
                $marketer = $user->marketer;
                $marketer->status = 'active';
            } else {
                $marketer = new Marketer();
                $marketer->invitation_code = $this->generateInvitationCode();
                $marketer->user_id = $user->id;
            }
            if ($parent_marketer->is_golden)
                $marketer->last_action = 'by_golden';
            else $marketer->last_action = 'by_marketer';

            $marketer->parent_id = $parent_marketer->id;
            $marketer->remaining_invitation += config('basic.marketer_invitation_number_each_join');
            $marketer->save();

            $parent_marketer->remaining_invitation -= 1;
            if ($parent_marketer->remaining_invitation == 0) {
                $parent_marketer->status = 'disabled';
                $parent_marketer->is_golden = 0;
            }
            $parent_marketer->save();

            $points = $this->pointsService->earnPoints('Marketer', config('basic.marketer_joining_points'), 'invaited marketer ' . $user->username, $marketer->id, $parent_marketer->user, 'pending');
            $log = $this->log($marketer->id, $parent_marketer->id, 'Joined as normal marketer and got ' . config('basic.marketer_invitation_number_each_join') . 'activations code ', 'joined', config('basic.marketer_joining_fee'), 0);
            DB::commit();
            return redirect(route('user.marketers'))->with('success', trans('Your order has been submitted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', trans("Error " . $e->getMessage()))->withInput();
        }
    }

    public function generateInvitationCode()
    {
        do {
            $invitation_code = Str::random(12);
        } while (Marketer::where("invitation_code", $invitation_code)->first());
        return $invitation_code;
    }

    public function getRandomInvitaionCode()
    {
        $marketer = Marketer::select('invitation_code')->where('status', 'active')->where('remaining_invitation', 10)->orderBy('created_at')->first();
        return $marketer->invitation_code;
    }

    public function goldenMarketer(Request $request)
    {
        $user = auth()->user();
        if (!($user->balance >= config('basic.golden_marketer_joining_fee')))
            return back()->with('error', trans("Your balance is not enough"))->withInput();

        DB::beginTransaction();
        try {
            $user->balance -= config('basic.golden_marketer_joining_fee');
            $transaction = $this->transactionService->create('-', config('basic.golden_marketer_joining_fee'), 'Joining as a golden marketer fee', $user);
            $user->save();

            if ($user->marketer) {
                $marketer = $user->marketer;
                $marketer->status = 'active';
                $marketer->parent_id = null;
            } else {
                $marketer = new Marketer();
                $marketer->invitation_code = $this->generateInvitationCode();
                $marketer->user_id = $user->id;
            }
            $marketer->is_golden = 1;
            $marketer->remaining_invitation += config('basic.marketer_invitation_number_each_join');
            $marketer->save();
            $log = $this->log($marketer->id, null, 'joined as golden marketer and got ' . config('basic.marketer_invitation_number_each_join') . 'invitation code ', 'golden_join', config('basic.golden_marketer_joining_fee'), 0);
            DB::commit();
            return redirect(route('user.marketers'))->with('success', trans('Your order has been submitted'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', trans("There are an error please try again or contact admin " . $e->getMessage()))->withInput();
        }
    }

    public function swap()
    {
        if (config('basic.marketers_swap') == 0)
            return back()->with('error', trans("Swapping process disabled by admin"))->withInput();
        $marketer = auth()->user()->marketer;
        $parent = $marketer->parentMarketer;
        if (!$marketer || !$parent)
            return back()->with('error', trans("You can't swap now"))->withInput();
        if ($marketer->remaining_invitation < 10)
            return back()->with('error', trans("You have used your invitation code"))->withInput();
        if ((new DateTime)->diff($marketer->updated_at)->days > 3)
            return back()->with('error', trans("You can't swap after 3 days of joining"))->withInput();

        DB::beginTransaction();
        try {

            if (!($marketer->last_action=='by_golden' && $parent->last_action=='refund')) {
                $parent->remaining_invitation += 1;
                $parent->status = 'active';
                $parent->save();
                $parentPoints = $this->pointsService->refundMarketerPoints(config('basic.marketer_joining_points') / 2, 'Refended for marketer swap', $parent->user);
            }

            $marketer->status = 'disabled';
            $marketer->remaining_invitation -= 10;
            $marketer->is_golden = 0;
            $marketer->last_action = 'swap';
            $marketer->save();


            $marketerPoints = $this->pointsService->earnPoints('Marketer', config('basic.marketer_joining_points') / 2, 'Swap marketer account');
            $pointTransaction = PointsTransaction::where('user_id', $parent->user->id)->where('order_id', $marketer->id)->where('status', 'pending')->first();
            if ($pointTransaction && (new DateTime)->diff($pointTransaction->created_at)->days < 4)
                $pointTransaction->update(['status' => 'active']);
            $log = $this->log($marketer->id, $parent->id, 'Swapped (disable account and get points)', 'swap', 0, config('basic.marketer_joining_points') / 2);

            DB::commit();
            return back()->with('success', trans("Swapped Successfully"))->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', trans("Something Error") . $e->getMessage())->withInput();
        }
    }

    public function goldenMareketerRefund()
    {
        if (config('basic.golden_refund') == 0)
            return back()->with('error', trans("Refund process disabled by admin"))->withInput();
        $marketer = auth()->user()->marketer;
        if ((new DateTime)->diff($marketer->created_at)->days > 7 || $marketer->is_golden == 0)
            return back()->with('error', trans("You can't refund after 7 days of joining"))->withInput();

        if ($marketer->remaining_invitation < 8)
            return back()->with('error', trans("You can't refund if you invite more than 2 marketers"))->withInput();
        if ($marketer->remaining_invitation < 10 && ((10 - $marketer->remaining_invitation) * config('basic.marketer_joining_points') > $marketer->user->points))
            return back()->with('error', trans("You can't refund if you replace your points"))->withInput();
        DB::beginTransaction();
        try {
            if ($marketer->remaining_invitation < 10) {
                $points = $this->pointsService->refundMarketerPoints((10 - $marketer->remaining_invitation) * config('basic.marketer_joining_points'), 'Refended golden marketer');
                $pendingPoints = PointsTransaction::where('user_id', $marketer->user->id)->where('status', 'pending')->get();
                foreach ($pendingPoints as $pendingpoint)
                    $pendingpoint->update(['status' => 'active']);
            }
            $marketer->status = 'disabled';
            $marketer->remaining_invitation = 0;
            $marketer->is_golden = 0;
            $marketer->last_action='refund';
            $marketer->save();
            $marketer->user->balance += config('basic.golden_marketer_joining_fee');
            $marketer->user->save();
            $transaction = $this->transactionService->create('+', config('basic.golden_marketer_joining_fee'), 'Golden marketer refund fee');
            $log = $this->log($marketer->id, null, 'Refund Golden fee  and disable account', 'refund', 0, 0);

            DB::commit();
            return back()->with('success', trans("Swapped Successfully"))->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function log($marketer, $parent = null, $note, $status, $paid, $points = null)
    {
        $log = MarketerLog::create([
            'marketer_id' => $marketer,
            'parent_id' => $parent,
            'note' => $note,
            'status' => $status,
            'paid' => $paid,
            'earned_points' => $points
        ]);
        return $log;
    }
}
