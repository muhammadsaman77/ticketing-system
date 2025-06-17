<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
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
    public function rating(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'rating'    => 'required|integer|min:1|max:5',
            'comment'   => 'nullable|string|max:255',
        ]);
        $user = $request->user();

        $rating = Rating::create([
            'user_id'   => $user->id,
            'ticket_id' => $request->ticket_id,
            'rating'    => $request->rating,
            'comment'   => $request->comment,
        ]);
        return response()->json([
            'message' => 'Rating submitted successfully',
            'payload' => [
                'id'         => $rating->id,
                'rating'     => $rating->rating,
                'comment'    => $rating->comment,
                'created_at' => $rating->created_at,
                'updated_at' => $rating->updated_at,
            ],
        ]);
    }
}
