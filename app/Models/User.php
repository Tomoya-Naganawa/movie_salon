<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use DB;
use Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image',
    ];

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

    public function updateProfile(Array $params)
    {
       if(isset($params['profile_image'])){
            DB::transaction(function() use($params){
                $path = Storage::disk('s3')->putFile('profile_image', $params['profile_image'], 'public');

                $this::where('id', $this->id)
                    ->update([
                        'name'          => $params['name'],
                        'profile_image' => Storage::disk('s3')->url($path),
                        'email'         => $params['email'],
                    ]);
            });    
        }else{
            DB::transaction(function() use($params){
                $this::where('id', $this->id)
                    ->update([
                        'name'          => $params['name'],
                        'email'         => $params['email'],
                    ]); 
            });     
        }
        return; 
    }

    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)->send(new ResetPassword($token));
    }

}
