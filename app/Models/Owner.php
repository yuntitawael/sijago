<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $guarded = ['id_owner'];

    protected $table = 'owner';

    protected $primaryKey = 'id_owner';
    
}
