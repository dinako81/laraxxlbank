<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'acc_number','client_id', 'client_id'];
    public $timestamps = false;

    public function accountClient() 
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}