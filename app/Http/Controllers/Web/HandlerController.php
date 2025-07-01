<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Handler;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HandlerController extends Controller
{
    public function index()
    {
        $handlers = Handler::select('id', 'name', 'email', 'phone_number', 'specialization', 'role')->get();
        return Inertia::render('handlers/Index',
            [
                'handlers' => $handlers,
            ]
        );

    }
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|string|email|unique:handlers,email',
            'phone_number'   => 'required|string|max:20',
            'specialization' => 'required|string|max:50',
            'role'           => 'required|string|in:HELPDESK,PIC',
        ]);

        try {
            // Handler::create([
            //     'name'           => $request->name,
            //     'email'          => $request->email,
            //     'phone_number'   => $request->phone_number,
            //     'specialization' => $request->specialization,
            //     'role'           => $request->role,
            // ]);
            return to_route('handlers.index')->with('success', 'Handler created successfully');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
