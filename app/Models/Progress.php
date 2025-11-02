<?php

namespace App\Models;

use App\Models\progress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Progress extends Model
{
    use HasFactory;


    protected $table = 'progress';
    protected $primaryKey = 'progress_id';
    public $timestamps = false;

    protected $fillable = [
        'topik',
        'matkul_id',
        'jenis',
        'status',
        'absensi',
        'rating_materi',
        'rating_paham',
        'tugas',
        'review',
        'notes',
        'topic_desc',
        'created_at',
    ];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'matkul_id');
    }
}
