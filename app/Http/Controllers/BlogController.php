<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Services\SEOService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Public index: list published posts
     */
    public function index()
    {
        $posts = BlogPost::published()
            ->with('user:id,name')
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return Inertia::render('Blog/Index', [
            'posts' => $posts
        ]);
    }

    /**
     * Public show: display a single post
     */
    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->published()
            ->with('user:id,name')
            ->firstOrFail();

        // SEO Keywords
        $seoKeywords = SEOService::generateKeywords($post->title, $post->content, 10);

        return Inertia::render('Blog/Show', [
            'post' => $post,
            'seoKeywords' => implode(', ', $seoKeywords)
        ]);
    }

    /**
     * Admin index: list all posts for management
     */
    public function adminIndex()
    {
        $this->authorizeAdmin();

        $posts = BlogPost::with('user:id,name')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return Inertia::render('Admin/Blog/Index', [
            'posts' => $posts
        ]);
    }

    /**
     * Admin: show creation form
     */
    public function create()
    {
        $this->authorizeAdmin();
        return Inertia::render('Admin/Blog/Editor');
    }

    /**
     * Admin: store a new post
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
        ]);

        $slug = Str::slug($validated['title']);
        // Ensure unique slug
        $count = BlogPost::where('slug', 'like', "$slug%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog', 'public');
        }

        $post = BlogPost::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'],
            'status' => $validated['status'],
            'featured_image' => $imagePath,
            'published_at' => $validated['status'] === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.blog.index')->with('message', 'Article créé avec succès !');
    }

    /**
     * Admin: show edit form
     */
    public function edit($id)
    {
        $this->authorizeAdmin();
        $post = BlogPost::findOrFail($id);
        return Inertia::render('Admin/Blog/Editor', [
            'post' => $post
        ]);
    }

    /**
     * Admin: update post
     */
    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();
        $post = BlogPost::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validated['title'] !== $post->title) {
            $slug = Str::slug($validated['title']);
            $count = BlogPost::where('slug', 'like', "$slug%")->where('id', '!=', $post->id)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            $post->slug = $slug;
        }

        if ($request->hasFile('image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $post->featured_image = $request->file('image')->store('blog', 'public');
        }

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->excerpt = $validated['excerpt'];
        
        if ($post->status === 'draft' && $validated['status'] === 'published') {
            $post->published_at = now();
        }
        $post->status = $validated['status'];
        
        $post->save();

        return redirect()->route('admin.blog.index')->with('message', 'Article mis à jour !');
    }

    /**
     * Admin: delete post
     */
    public function destroy($id)
    {
        $this->authorizeAdmin();
        $post = BlogPost::findOrFail($id);
        
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        
        $post->delete();

        return back()->with('message', 'Article supprimé.');
    }

    /**
     * Helper to check admin role
     */
    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Action réservée aux administrateurs.');
        }
    }
}
