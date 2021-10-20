<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueModel extends Model
{
    public $table='issues';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public  $timestamps=false;
}
