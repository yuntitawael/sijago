<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
    use HasFactory;

    protected $guarded = ['id_depot'];

    protected $table = 'depot';

    protected $primaryKey = 'id_depot';

    protected $with = ['get_kelurahan', 'get_kecamatan', 'owner'];

    public function get_kelurahan()
    {
        return $this->belongsTo(Village::class, 'id_kelurahan');
    }

    public function get_kecamatan()
    {
        return $this->belongsTo(District::class, 'id_kecamatan');
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'id_owner');
    }

}
