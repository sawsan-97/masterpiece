<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        $pendingMessagesCount = ContactMessage::where('status', 'pending')->count();

        return view('admin.contact-messages.index', compact('messages', 'pendingMessagesCount'));
    }

    public function updateStatus(Request $request, ContactMessage $message)
    {
        $request->validate([
            'status' => 'required|in:read,replied',
            'admin_notes' => 'nullable|string'
        ]);

        $message->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->back()->with('success', 'تم تحديث حالة الرسالة بنجاح');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->back()->with('success', 'تم حذف الرسالة بنجاح');
    }
}
