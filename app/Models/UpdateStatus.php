<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateStatus extends Model
{
    use HasFactory;

    protected $table = 'update_status';
    protected $primaryKey = 'id_update_status';
    public $timestamps = true;

    protected $fillable = [
        'aset_id',
        'aset_status',
        'tgl_update',
    ];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'aset_id');
    }

    public function getCurrentAsetStatusAttribute()
{
    $latestStatus = $this->updateStatuses()->orderBy('tgl_update', 'desc')->first();

    return $latestStatus ? $latestStatus->aset_status : $this->aset_status; 
}

}
