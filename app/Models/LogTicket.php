<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogTicket extends Model
{

    protected $table    = 'log_ticket_processing';
    public $timestamps  = false;
    protected $fillable = [
        'ticket_id',
        'handler_id',
        'from_status',
        'to_status',
        'notes',
        'created_at',
    ];

}
