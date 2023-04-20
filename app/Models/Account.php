<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['acc_number', 'acc_balance', 'client_id'];
    public $timestamps = false;

    public function accountClient() 
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}