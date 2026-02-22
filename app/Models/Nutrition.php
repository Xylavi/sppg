<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    protected $table = 'nutritions';

    protected $fillable = [
        'menu_id',
        'energi',
        'protein',
        'lemak',
        'karbohidrat'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
