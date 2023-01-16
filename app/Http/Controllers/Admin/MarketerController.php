<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marketer;
use Illuminate\Http\Request;

class MarketerController extends Controller
{
    public function index()
    {
        $marketers = Marketer::with('log')->orderBy('id', 'DESC')->paginate(config('basic.paginate'));
        return view('admin.pages.marketers.index', compact('marketers'));
    }

    public function search(Request $request)
    {
        $search = $request->all();
        $dateSearch = $request->date_time;
        $date = preg_match("/^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}$/", $dateSearch);
        $marketers = Marketer::when(isset($search['username']), function ($query) use ($search) {
             $query->whereHas('user', function($q) use ($search){
                 return $q->where('username', 'LIKE', "%{$search['username']}%");
             });
        })

            ->when($date == 1, function ($query) use ($dateSearch) {
                return $query->whereDate("created_at", $dateSearch);
            })
            ->when(isset($search['status']), function ($query) use ($search) {
                return $query->where('status', $search['status']);
            })
            ->paginate(config('basic.paginate'));
        return view('admin.pages.marketers.index', compact('marketers', 'search'));
    }

    public function info(Marketer $marketer)
    {
        $invitation_logs=$marketer->log;
        $childrenLog=$marketer->childrenLog;
        return view('admin.pages.marketers.info',compact('marketer','invitation_logs','childrenLog'));
    }

    public function update(Request $request,$id)
    {
        $marketer = Marketer::findOrFail($id);
        $validated = $request->validate([
            'invitation_code' => 'sometimes|required',
            'remaining_invitation' => 'sometimes|required',
        ]);

        $marketer->invitation_code = $request->invitation_code;
        $marketer->remaining_invitation = $request->remaining_invitation;
        $marketer->status = $request->status;
        $marketer->is_golden = $request->is_golden;
        $marketer->notes = $request->note;
        $marketer->save();

        return back()->with('success', trans('Updated Successfully.'));
    }

}
