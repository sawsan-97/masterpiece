<?php
namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class NewsController extends Controller
{
    /**
     * Display a listing of the news on the frontend
     */
    public function frontIndex()
    {
        $news = News::where('is_active', true)
                    ->latest()
                    ->paginate(9);
        return view('news.front-index', compact('news'));
    }

    /**
     * Display a specific news item on the frontend
     */
    public function show(News $news)
    {
        if (!$news->is_active) {
            abort(404);
        }
        return view('news.show', compact('news'));
    }

    /**
     * Display a listing of the news in admin panel
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new news item
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created news item in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        try {
            if ($request->hasFile('image')) {
                Log::info('Image file received: ' . $request->file('image')->getClientOriginalName());
                $imagePath = $request->file('image')->store('news', 'public');
                Log::info('Image stored at: ' . $imagePath);
                $data['image'] = 'storage/' . $imagePath;
            }

            $news = News::create($data);
            Log::info('News created with image path: ' . $news->image);

            return redirect()->route('admin.news.index')
                ->with('success', 'تم إضافة الخبر بنجاح');
        } catch (\Exception $e) {
            Log::error('Error storing news: ' . $e->getMessage());
            return back()->withInput()
                ->withErrors(['error' => 'حدث خطأ أثناء حفظ الخبر: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified news item in storage
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        // ضبط قيمة is_active - معالجة checkbox
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($news->image) {
                $oldImagePath = str_replace('storage/', '', $news->image);
                Storage::disk('public')->delete($oldImagePath);
            }

            $imagePath = $request->file('image')->store('news', 'public');
            $validated['image'] = 'storage/' . $imagePath;
        }

        try {
            $news->update($validated);
            Log::info('News updated successfully with ID: ' . $news->id);

            return redirect()->route('admin.news.index')
                ->with('success', 'تم تحديث الخبر بنجاح.');
        } catch (\Exception $e) {
            Log::error('Error updating news: ' . $e->getMessage());
            return back()->withInput()
                ->withErrors(['error' => 'حدث خطأ أثناء تحديث الخبر: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified news item from storage
     */
    public function destroy(News $news)
    {
        try {
            // حذف الصورة إذا كانت موجودة
            if ($news->image) {
                $imagePath = str_replace('storage/', '', $news->image);
                Storage::disk('public')->delete($imagePath);
            }

            $news->delete();
            Log::info('News deleted successfully with ID: ' . $news->id);

            return redirect()->route('admin.news.index')
                ->with('success', 'تم حذف الخبر بنجاح.');
        } catch (\Exception $e) {
            Log::error('Error deleting news: ' . $e->getMessage());
            return back()->withErrors(['error' => 'حدث خطأ أثناء حذف الخبر: ' . $e->getMessage()]);
        }
    }
}
