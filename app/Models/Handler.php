<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handler extends Model
{
    protected $table = 'handlers';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'specialization',
        'role',
    ];
}
