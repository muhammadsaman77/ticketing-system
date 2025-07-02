<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\NotificationEmail;
use App\Models\Handler;
use App\Models\LogTicket;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class SubmissionController extends Controller
{
    public function index()
    {
        $tickets = Ticket::select('id', 'title', 'description', 'status', 'user_id')
            ->with('submitter:id,name,email')
            ->get();

        $handlers = Handler::select('id', 'name', 'role')->get();

        return Inertia::render('submissions/Index',
            [
                'tickets'  => $tickets,
                'handlers' => $handlers,
            ]
        );
    }
    public function store()
    {}
    public function show()
    {}
    public function update(HttpRequest $request, $id)
    {
        $request->validate([
            'status'     => 'required|string|in:OPEN,IN_PROGRESS,PENDING_USER_ACTION,RESOLVED,CLOSED,CANCELLED',
            'role'       => 'string|in:HELPDESK,PIC',
            'handler_id' => 'exists:handlers,id',
            'notes'      => 'nullable|string',
        ]
        );
        DB::beginTransaction();
        try {
            $ticket = Ticket::find($id);
            LogTicket::create([
                'ticket_id'   => $ticket->id,
                'handler_id'  => $request->handler_id,
                'from_status' => $ticket->status,
                'to_status'   => $request->status,
                'notes'       => $request->notes,
                'created_at'  => Carbon::now(),
            ]);
            $ticket->status     = $request->status;
            $ticket->handler_id = $request->handler_id;
            if ($request->status == 'RESOLVED') {
                $ticket->resolved_at = Carbon::now();
            }
            if ($request->status == 'CLOSED') {
                $ticket->closed_at = Carbon::now();
            }
            $ticket->save();

            Mail::to($ticket->submitter->email)->send(new NotificationEmail($ticket->submitter->name, $ticket->handler->name, $ticket->status, $ticket->handler->role));
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
    public function destroy()
    {}

}
