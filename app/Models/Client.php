<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'personal_code', 'client_id'];
    public $timestamps = false;
    
    const SORT = [
        'default' => 'Be rūšiavimo',
        'surname_asc' => 'Pavardė A-Z',
        'surname_desc' => 'Pavardė Z-A',
    ];

    const FILTER = [
        'default' => 'Visi',
        'acc_balance_pos' => 'Teigiamas likutis',
        'acc_balance_neg' => 'Neigiamas likutis',
        'acc_balance_zero' => 'Sąskaita lygu 0',
        'acc_number' => 'Nėra sąskaitų',
    ];

    const PER = [
        '10' => '10',
        '17' => '17',
        '33' => '33',
        '3' => 'tiny view',
    ];

    public function account()
    {
        return $this->hasMany(Account::class);
    }
}