<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Customer;
use App\Models\Deal;
use App\Models\Task;

class Task extends Model
{
   
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'customer_id', 'deal_id', 'title', 'description', 'due_date', 'status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

