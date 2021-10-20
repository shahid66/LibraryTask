<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembarsModel extends Model
{
    public $table='members';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public  $timestamps=false;
}
