<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Province;
use App\Models\City;
use App\Models\TransactionDetail;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'province_id',
        'city_id',
        'courier_name',
        'courier_service',
        'courier_cost',
        'weight',
        'invoice',
        'address',
        'grand_total',
        'reference',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
