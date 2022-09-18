<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'cashier_id',
        'customer_id',
        'invoice',
        'cash',
        'change',
        'discount',
        'grand_total'
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function profits()
    {
        return $this->hasMany(Profit::class);
    }

    protected function getCreatedAtAttribute($date)
    {
        $date = Carbon::parse($date)->locale('id');

        $date->settings(['formatFunction' => 'translatedFormat']);
        return $date->format('d-M-Y H:i:s');
    }
}
