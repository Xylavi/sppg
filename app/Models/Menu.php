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
        'porsi',
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

    /**
     * Get the URL to the menu photo.
     * Returns the asset URL if photo exists, otherwise returns null.
     */
    public function getPhotoUrl(): ?string
    {
        if ($this->foto_menu) {
            return asset('storage/' . $this->foto_menu);
        }
        return null;
    }

    /**
     * Check if menu has a photo.
     */
    public function hasPhoto(): bool
    {
        return !is_null($this->foto_menu) && !empty($this->foto_menu);
    }
}
