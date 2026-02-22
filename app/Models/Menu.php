<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'nama_menu',
        'tanggal_menu',
        'school_id',
        'foto_menu'
    ];

    protected $casts = [
        'tanggal_menu' => 'date',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function nutrition(){
        return $this->hasOne(Nutrition::class);
    }
}
