<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class HandlerController extends Controller
{
    public function index()
    {
        return Inertia::render('handlers/Index');

    }
    public function store()
    {

    }
}
