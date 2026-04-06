<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_menu',
        'tanggal_menu',
        'school_id',
        'foto_menu',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_menu' => 'date',
        ];
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function nutrition(): HasOne
    {
        return $this->hasOne(Nutrition::class);
    }
}
