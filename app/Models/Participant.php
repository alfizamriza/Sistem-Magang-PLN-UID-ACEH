<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'university',
        'description',
        'start_date',
        'end_date',
        'cv',
        'email',
        'whatsapp',
        'status',
        'unique_code',
        'magang_type',
        'other_magang',
        'address',
        'divisi_id',
    ];
    // Relasi ke divisi
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }

    // Status dinamis: pending, waiting, active, finished
    public function getStatusAttribute($value)
    {
        if ($value === 'pending') return 'pending';
        if ($value === 'rejected') return 'rejected';
        if ($value === 'accepted') {
            if (!$this->start_date || !$this->end_date) return 'waiting';
            $now = now();
            if ($now->lt(
                \Carbon\Carbon::parse($this->start_date))) return 'waiting';
            if ($now->between(
                \Carbon\Carbon::parse($this->start_date),
                \Carbon\Carbon::parse($this->end_date))) return 'active';
            if ($now->gt(\Carbon\Carbon::parse($this->end_date))) return 'finished';
        }
        return $value;
    }
}
