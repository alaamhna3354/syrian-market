<?php

namespace App\Models;

use App\Http\Traits\Notify;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Notify;

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

    public function order()
    {
        return $this->hasMany(Order::class)->latest();
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class)->latest();
    }

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }


    public function serviceRates()
    {
        return $this->hasMany(UserServiceRate::class, 'user_id')->latest();
    }


    public function siteNotificational()
    {
        return $this->morphOne(SiteNotification::class, 'siteNotificational', 'site_notificational_type', 'site_notificational_id');
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




}
