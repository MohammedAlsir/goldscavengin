<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class GoldBar extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'gold_bar_owner',
        'gold_ingot_weight',
        'sample_weight',
        'gold_karat_weight',
        'net'
    ];
}
