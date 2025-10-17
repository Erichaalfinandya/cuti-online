<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JatahCutiModel extends Model
{
    use HasFactory;
    protected $table = 'jatah_cutis';
    protected $guarded = [];

       public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function jenisCuti()
    {
        return $this->belongsTo(JenisCutiModel::class, 'jenis_cuti_id');
    }
}
