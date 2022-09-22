<?php

namespace App\Http\Controllers;

use App\Models\Chat\Branch;
use App\Models\Chat\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CampaignController extends Controller
{
    public function show() :View
    {
        $messages = Message::all();
        $branches = Branch::all();
        return view('admin.chats', ['messages' => $messages, 'branches' => $branches]);
    }

    public function update(Request $request)
    {
        $all = $request->all();
        Log::channel('chat')->debug(print_r($all, true));
        foreach ($all as $id => $chat) {
            if (!is_numeric($id)) {
                continue; // skipping token element
            }
            Log::channel('chat')->debug("ID: " . $id . " Text: " . $chat);

            $existing = Message::find($id);
            $existing->text = $chat;
            //$existing->id = $id;
            Log::channel('chat')->debug($existing);
            $existing->save();

        }

        return $this->show();
    }
}
