<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'status', 'company_id'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
}
}
