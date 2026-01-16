<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $notifications = auth()->user()
                            ->notifications()
                            ->Active()
                            ->orderBy('created_at', 'desc')
                            ->when($request->get('filter') === 'unread', function ($query) {
                                return $query->Unread();
                            })
                            ->when($request->get('filter') === 'read', function ($query) {
                                return $query->Read();
                            })
                            ->get();

        return view('notifications', compact('notifications'));
    }

    public function update(Notification $notification){
        $notification->is_read = true;
        $notification->save();
        return redirect()->route('notifications');
    }

    public function destroy(Notification $notification)
    {
        return redirect()->route('notifications');
    }
}
