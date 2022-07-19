<?php

namespace App\Http\Controllers;

use App\Models\Chat\Branch;
use App\Models\Chat\Message;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatMessageController extends Controller
{
    public function show() :View
    {
        $messages = Message::all();
        $branches = Branch::all();
        return view('chats', ['messages' => $messages, 'branches' => $branches]);
    }

    public function update(Request $request)
    {

    }
}
