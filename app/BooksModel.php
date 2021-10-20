<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BooksModel extends Model
{
    //
    public $table='books';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public  $timestamps=false;
}
