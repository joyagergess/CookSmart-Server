<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'household_id',
        'amount',
        'date',
        'store',
        'receipt_url'
    ];
}
