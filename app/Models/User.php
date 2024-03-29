<?php

namespace App\Models;

use App\Http\Traits\Notify;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Notify,HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public  $allusers = [];

    protected $appends = ['fullname', 'mobile','profileName','photo'];

    protected $dates = ['sent_at'];

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    public function getPhotoAttribute()
    {
        return getFile(config('location.user.path').$this->image);
    }

    public function getProfileNameAttribute()
    {
        return '@'. $this->username;
    }

    public function getMobileAttribute()
    {
        return $this->phone;
    }

    public function funds()
    {
        return $this->hasMany(Fund::class)->latest()->where('status', '!=', 0);
    }

    public function debts()
    {
        return $this->hasMany(Debt::class,'user_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class)->latest();
    }

    public function balanceCoupons()
    {
        return $this->hasMany(BalanceCoupon::class)->latest();
    }

    public function children()
    {
        return $this->hasMany(User::class,'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function agent()
    {
        return $this->hasOne(Agent::class,'user_id');
    }

    public function serviceCodes()
    {
        return $this->hasMany(ServiceCode::class)->latest();
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class)->latest();
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }


    public function serviceRates()
    {
        return $this->hasMany(UserServiceRate::class, 'user_id')->latest();
    }

    public function userPriceRanges()
    {
        return $this->hasMany(UserPriceRange::class, 'user_id')->latest();
    }


    public function siteNotificational()
    {
        return $this->morphOne(SiteNotification::class, 'siteNotificational', 'site_notificational_type', 'site_notificational_id');
    }

    public function agentCommissionRate()
    {
        return $this->hasMany(AgentCommissionRate::class,'user_id');
    }

    public function priceRange()
    {
        return $this->belongsTo(PriceRange::class, 'price_range_id');
    }


    public function sendPasswordResetNotification($token)
    {
        $this->mail($this, 'PASSWORD_RESET', $params = [
            'message' => '<a href="'.url('password/reset',$token).'?email='.$this->email.'" target="_blank">Click To Reset Password</a>'
        ]);
    }

    public function getReferralLinkAttribute()
    {
        return $this->referral_link = route('register', ['ref' => $this->username]);
    }

    public function pointsTransactions()
    {
        return $this->hasMany(PointsTransaction::class);
    }

    public function getPointsBalanceByPointTransactionsAttribute()
    {
        return $this->activePointsTransactions()->sum('amount');
    }

    public function activePointsTransactions()
    {
        return $this->pointsTransactions()->where('status','active');
    }

    public function marketer()
    {
        return $this->hasOne(Marketer::class);
    }


}
