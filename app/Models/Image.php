<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

   // cette fonction est un scope qui va nous permettre de trier les user/images par date de création  voir utilisattion dans le controller homeContr
    public function scopeLatestWithUser($query){
        return $query->with('user')->latest() ;
    }
}
