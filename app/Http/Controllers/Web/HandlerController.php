<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Handler;
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
    public function store()
    {

    }
}
