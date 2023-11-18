<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $timestamps = false;
    public function category(){
        return $this->belongsTo((Category::class));
    }

    public function unit(){
        return $this->belongsTo((Unit::class));
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'service_id');
    }

    public function rating(){
        $reviews = $this->reviews()->get();
        $ratingSum = 0;
        if(count($reviews) !== 0){
            foreach($reviews as $review){
                $ratingSum += $review->rating;
            }
            $rating = round($ratingSum/count($reviews), 1);
            return $rating;
        }
        return 0;
    }
}
