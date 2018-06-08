<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\CategorySaving;

class Category extends Model
{
    protected $fillable = ['name','slug'];
    // ici on propage l'evenement qu'on a crée
    protected $dispatchesEvents =[
        'saving' => CategorySaving::class,
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
