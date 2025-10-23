<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatCutiModel extends Model
{
    use HasFactory;
    protected $table = 'riwayat_cutis';
    protected $guarded = [];
    public function ajukanCuti()
    {
        return $this->belongsTo(AjukanCutiModel::class, 'ajukan_cuti_id');
    }
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }
}
