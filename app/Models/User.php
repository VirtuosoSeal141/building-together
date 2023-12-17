<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function views(){
        return $this->hasMany(View::class, 'user_id');
    }
    public function services(){
        return $this->hasMany(Service::class, 'user_id');
    }
    public function reviews(){
        return $this->hasMany(Review::class, 'user_id');
    }
    public function checkRev($id){
        $review = $this->reviews()->where('service_id',$id)->get();
        if(count($review) === 0){
            return true;
        } else {
            return false;
        }
    }
    public function favourites(){
        return $this->hasMany(Favourite::class, 'user_id');
    }
    public function checkFav($id){
        $favourite = $this->favourites()->where('service_id',$id)->get();
        if(count($favourite) === 0){
            return true;
        } else {
            return false;
        }
    }
    public function clientOrders(){
        return $this->hasMany(Order::class, 'user1_id');
    }
    public function companyOrders(){
        return $this->hasMany(Order::class, 'user2_id');
    }
    public function checkOrder($id){
        $order = $this->clientOrders()->where('service_id',$id)->where('status_id', 4)->get();
        if(count($order) === 0){
            return false;
        } else {
            return true;
        }
    }
}
