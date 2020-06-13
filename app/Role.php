<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Role extends Model
{
    //
    public function users(){
        
        return $this->belongsToMany(User::class, 'role_user');
    }

    
      
}
