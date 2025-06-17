<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::select('id', 'title', 'description', 'attachment')->get();
        return response()->json([
            'message' => 'Get all tickets successfully',
            'payload' => $tickets,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'attachment'  => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);
        $path      = $request->file('attachment')->store('uploads/tickets', );
        $user      = $request->user();
        $newTicket = Ticket::create([
            'user_id'     => $user->id,
            'title'       => $request->title,
            'description' => $request->description,
            'attachment'  => $path,
        ]);
        return response()->json([
            'message' => 'Submit new ticket successfully',
            'payload' => [
                'id'          => $newTicket->id,
                'title'       => $newTicket->title,
                'description' => $newTicket->description,
                'created_at'  => $newTicket->created_at,
                'updated_at'  => $newTicket->updated_at,
            ],
        ]);
    }
    public function rating()
    {

    }
}
