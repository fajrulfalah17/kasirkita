<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'total'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    protected function getDateAttribute($date)
    {
        return Carbon::parse($date)->format('d-M-Y H:i:s');
    }
}
