<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sekolah',
        'alamat',
    ];

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
