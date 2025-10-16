<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    /** @use HasFactory<\Database\Factories\DealFactory> */
    use HasFactory;
    protected $fillable = ['customer_id', 'title', 'amount', 'status'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
