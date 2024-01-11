<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingLog extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['item_id', 'action', 'user_id'];
}
