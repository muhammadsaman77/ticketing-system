<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    protected $table    = 'ticket_attachments';
    public $timestamps  = false;
    protected $fillable = [
        'ticket_id',
        'file_url',
        'uploaded_at',
    ];
}
