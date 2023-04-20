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
        
        'surname_asc' => 'By surname A-Z',
        'surname_desc' => 'By surname Z-A',
        'default' => 'No sort'
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