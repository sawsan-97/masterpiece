<?php

namespace App\Http\Controllers;

use App\Models\JoinRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JoinRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'product_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('join-requests', 'public');
        }

        JoinRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'product_image' => $imagePath,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'تم إرسال طلبك بنجاح وسيتم مراجعته قريباً');
    }

    // عرض طلبات الانضمام في لوحة التحكم
    public function index()
    {
        $requests = JoinRequest::latest()->paginate(10);
        $pendingRequestsCount = JoinRequest::where('status', 'pending')->count();

        return view('admin.join-requests.index', compact('requests', 'pendingRequestsCount'));
    }

    // تحديث حالة الطلب
    public function updateStatus(Request $request, JoinRequest $joinRequest)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_notes' => 'nullable|string'
        ]);

        $joinRequest->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        // إرسال بريد إلكتروني للمستخدم
        // يمكنك إضافة كود إرسال البريد الإلكتروني هنا

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح');
    }
}
