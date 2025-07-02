<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table    = 'tickets';
    protected $fillable = ['user_id', 'title', 'description', 'handler_id', 'status'];

    public function rating()
    {
        return $this->belongsTo(Rating::class, );
    }
    public function handler()
    {
        return $this->belongsTo(Handler::class, 'handler_id');
    }
    public function submitter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
