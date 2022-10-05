<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chequedetail extends Model
{
    use HasFactory;

    protected $fillable = [ "depositdate", "payto", "amount", "currency", "accountholdername", "accountholdernumber", "chequenumber", "bankcode", "branchcode"];
}