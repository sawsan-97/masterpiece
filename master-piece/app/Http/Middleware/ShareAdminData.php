<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\JoinRequest;

class ShareAdminData
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_admin) {
            $pendingMessagesCount = ContactMessage::where('status', 'pending')->count();
            $pendingRequestsCount = JoinRequest::where('status', 'pending')->count();

            view()->share([
                'pendingMessagesCount' => $pendingMessagesCount,
                'pendingRequestsCount' => $pendingRequestsCount
            ]);
        }

        return $next($request);
    }
}
