<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Divisi extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'kapasitas'];

    public function peserta()
    {
        return $this->hasMany(Participant::class, 'divisi_id');
    }
}
