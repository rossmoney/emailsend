<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('message.create');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $messages = Message::orderBy('created_at', 'DESC')->get();
        
        return view('message.index', compact('messages'));
    }
}
