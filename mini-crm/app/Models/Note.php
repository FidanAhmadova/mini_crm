<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Customer;
use App\Models\Deal;

class Note extends Model
{
    /** @use HasFactory<\Database\Factories\NoteFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'customer_id', 'deal_id', 'content'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }
}
