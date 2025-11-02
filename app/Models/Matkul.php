<?php

namespace App\Models;

use App\Models\matkul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matkul extends Model
{
    use HasFactory;

    protected $table = 'matkul';
    protected $primaryKey = 'matkul_id';
    public $timestamps = false;

    protected $fillable = [
        'matkul_name',
        'dosen_name',
        'sks',
        'semester',
        'matkul_desc',
        'jadwal_hari',
        'jadwal_jam',
    ];

    public function progresses()
    {
        return $this->hasMany(Progress::class, 'matkul_id');
    }
}
