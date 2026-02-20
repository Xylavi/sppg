<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'kategori',
        'deskripsi',
        'nama_pelapor',
        'kontak_pelapor',
        'foto',
        'status',
        'catatan_tindak_lanjut',
    ];
}
