<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class SubmissionController extends Controller
{
    public function index()
    {
        return Inertia::render('submissions/Index');
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
