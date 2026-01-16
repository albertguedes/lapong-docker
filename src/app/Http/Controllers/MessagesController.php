<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Customer;
use App\Models\Message;

class MessagesController extends Controller
{
    public function index(): View
    {
        $messages = auth()->user()
                        ->receivedMessages()
                        ->Unread()
                        ->Active()
                        ->where('is_deleted', false)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('messages.index', compact('messages'));
    }

    public function sent(): View
    {
        $messages = auth()->user()
                        ->sentMessages()
                        ->Active()
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('messages.sent', compact('messages'));
    }

    public function saved(): View
    {
        $messages = auth()->user()
                        ->receivedMessages()
                        ->Saved()
                        ->Active()
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('messages.saved', compact('messages'));
    }

    public function trash(): View
    {
        $messages = auth()->user()->receivedMessages()
                                ->where('is_deleted', true)
                                ->Active()
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('messages.trash', compact('messages'));
    }

    public function create(Request $request): View
    {
        $receiver_id = $request->get('receiver_id');

        $receiver = null;
        if($receiver_id){
            $receiver = Customer::find($receiver_id);
        }

        $sender = auth()->user();
        return view('messages.create', compact('sender', 'receiver'));
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('messages.sent');
    }

    public function edit(Message $message): View
    {
        return view('messages.edit', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $data = $request->all();

        $message->update($data);

        return redirect()->route('message.show', compact('message'));
    }

    public function show(Message $message): View
    {
        $message->is_read = true;
        $message->save();

        return view('messages.show', compact('message'));
    }

    public function destroy(Request $request, Message $message): RedirectResponse
    {
        $confirm = $request->get('confirm');
        if ($confirm) {
            $message->delete();
            if($message->exists()){
                return redirect()->route('message',compact('message'));
            }
        }

        return redirect()->route('message.show',compact('message'));
    }
}
