<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Inertia\Inertia;

class SubmissionController extends Controller
{
    public function index()
    {
        $tickets = Ticket::select('id', 'title', 'description', 'status', 'user_id')
            ->with('submitter:id,name,email')
            ->get();

        return Inertia::render('submissions/Index',
            [
                'tickets' => $tickets,
            ]
        );
    }
    public function store()
    {}
    public function show()
    {}
    public function update()
    {}
    public function destroy()
    {}

}
