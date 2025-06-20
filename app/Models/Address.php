<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'address_type', 'address_details', 'primary'];

    protected $casts = [
        'address_details' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
