<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $guarded = [];

    public function users(){
        
        return $this->belongsToMany(User::class, 'post_user');
    }
    public function isNotUserInvolvedWithPost($user){
        
        if($this->users->where('id', $user->id)->count() >= 1){
            return false;
        }else{
            return true;
        }

     }
   
}
