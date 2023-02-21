<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publisher extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone_number', 'address'];
    public function books()
    {
        return $this->hasMany('App\Models\Book', 'publisher_id');
    }
}
