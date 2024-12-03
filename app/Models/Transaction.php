<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'timestamp',
        'response_code',
        'type_transaksi',
        'url',
        'response_message',
    ];
    protected $table = 'transaksis';
    //
}
