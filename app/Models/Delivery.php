<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = ['uuid', 'destinasi_id','destinasi', 'dock', 'cycle', 'start', 'end', 'photo', 'total_delivery','logistic'];
}
