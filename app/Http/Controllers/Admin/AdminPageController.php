<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Post;
use App\Services\WebpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminPageController extends Controller
{
    public function __construct(
        protected WebpService $webpService
    ) {}

    public function index()
    {
        $pages = Post::where('type', 'page')->orderBy('updated_at', 'desc')->paginate(20);

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'content' => 'nullable|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$count++;
        }

        $featuredImageUrl = null;
        if ($request->hasFile('featured_image')) {
            $converted = $this->webpService->processUploadedFile($request->file('featured_image'), 'pages', 85, 1600);
            if ($converted['success']) {
                $featuredImageUrl = $converted['url'];
            }
        }

        $page = Post::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'] ?? '',
            'excerpt' => $validated['excerpt'] ?? '',
            'featured_image' => $featuredImageUrl,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'type' => 'page',
            'status' => 'publish',
            'author_id' => Auth::id(),
            'published_at' => now(),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name ?? 'Admin',
            'action' => 'page_create',
            'description' => "Menambahkan halaman profil/statis baru: {$page->title}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return redirect()->route('admin.pages.index')->with('success', "Halaman '{$page->title}' berhasil dibuat.");
    }

    public function edit(Post $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Post $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($page->id)],
            'content' => 'nullable|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $featuredImageUrl = $page->featured_image;
        if ($request->hasFile('featured_image')) {
            $converted = $this->webpService->processUploadedFile($request->file('featured_image'), 'pages', 85, 1600);
            if ($converted['success']) {
                $featuredImageUrl = $converted['url'];
            }
        }

        $slug = $page->slug;
        if (! empty($validated['slug']) && $validated['slug'] !== $page->slug) {
            $slug = Str::slug($validated['slug']);
        }

        $page->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'] ?? '',
            'excerpt' => $validated['excerpt'] ?? '',
            'featured_image' => $featuredImageUrl,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name ?? 'Admin',
            'action' => 'page_update',
            'description' => "Memperbarui konten halaman profil: {$page->title}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'info',
        ]);

        return redirect()->route('admin.pages.index')->with('success', "Halaman '{$page->title}' berhasil diperbarui.");
    }

    public function destroy(Request $request, Post $page)
    {
        $protectedSlugs = ['visi-dan-misi', 'tentang-kami', 'sambutan-kepala-sekolah', 'sejarah', 'struktur-organisasi'];

        if (in_array($page->slug, $protectedSlugs)) {
            return back()->with('error', "Halaman inti sistem '{$page->title}' tidak dapat dihapus untuk menjaga keutuhan menu profil sekolah.");
        }

        $title = $page->title;
        $page->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name ?? 'Admin',
            'action' => 'page_delete',
            'description' => "Menghapus halaman: {$title}",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'warning',
        ]);

        return redirect()->route('admin.pages.index')->with('success', "Halaman '{$title}' berhasil dihapus.");
    }
}
