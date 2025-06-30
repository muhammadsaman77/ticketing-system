<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::select('id', 'title', 'description', 'status')
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json([
            'message' => 'Get all tickets successfully',
            'payload' => $tickets,
        ]);
    }
    public function show($id)
    {
        $ticket = Ticket::find($id);
        return response()->json([
            'message' => 'Get ticket successfully',
            'payload' => $ticket,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:50',
            'description'   => 'required|string|max:255',
            'attachments'   => 'array|max:3',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $user = $request->user();
        try {
            DB::beginTransaction();
            $attachments = [];
            $newTicket   = Ticket::create([
                'user_id'     => $user->id,
                'title'       => $request->title,
                'description' => $request->description,
                'status'      => 'OPEN',
            ]);

            if ($request->hasFile('attachments')) {
                $files = $request->file('attachments');
                foreach ($files as $file) {
                    $path          = $file->store('attachments');
                    $newAttachment = TicketAttachment::create([
                        'ticket_id' => $newTicket->id,
                        'file_url'  => $path,
                    ]);
                    array_push($attachments, $newAttachment);

                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Submit new ticket failed',
                'error'   => $e->getMessage(),
            ]);
        }

        return response()->json([
            'message' => 'Submit new ticket successfully',
            'payload' => [
                'id'          => $newTicket->id,
                'title'       => $newTicket->title,
                'description' => $newTicket->description,
                'attachments' => $attachments,
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
