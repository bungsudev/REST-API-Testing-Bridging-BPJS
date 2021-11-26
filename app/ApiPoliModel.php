<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiPoliModel extends Model
{
    protected $table = 'poli';
    //nama table yang akan di gunakan

    protected $primaryKey = 'id';
    //nama field primary
}
