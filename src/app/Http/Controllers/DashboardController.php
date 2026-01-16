<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;

class DashboardController extends Controller
{
    public function dashboard(){

        $customer = auth()->user();

        $next_event = Event::where('event_creator_id', $customer->id)
                           ->orWhereHas('participants', function ($q) use ($customer) {
                                $q->where('participant_id', $customer->id);
                           })
                           ->distinct()
                           ->Active()
                           ->where('begin', '>', now()->format('Y-m-d H:i:s'))
                           ->orderBy('begin','asc')
                           ->first();

        $last_message = $customer->receivedMessages()
                                 ->Active()
                                 ->where('is_deleted', false)
                                 ->orderBy('created_at', 'desc')
                                 ->first();

        $last_notification = $customer->notifications()
                                      ->Active()
                                      ->orderBy('created_at', 'desc')
                                      ->first();

        $latest_news = Post::published()->Active()
                                  ->orderBy('created_at', 'desc')
                                  ->take(3)
                                  ->get();

        return view('dashboard', compact(
            'next_event',
            'last_message',
            'last_notification',
            'latest_news'
        ));
    }
}
