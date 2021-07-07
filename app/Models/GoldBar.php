<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class GoldBar extends Model
{
    use HasApiTokens, HasFactory;


    // protected $casts = [
    //     'created_at' => 'datetime:Y-m-d H:i:s', // Change your format
    //     'updated_at' => 'datetime:d/m/Y',
    // ];

    protected $fillable = [
        'gold_bar_owner',
        'gold_ingot_weight',
        'sample_weight',
        'gold_karat_weight',
        'net',
        'date_add'
    ];
}
