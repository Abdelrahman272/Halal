<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ask;
use Illuminate\Http\Request;

class AskController extends Controller
{
    public function index()
    {
        $asks = Ask::paginate(10);
        return view('admin.ask.index', compact('asks'));
    }
}
