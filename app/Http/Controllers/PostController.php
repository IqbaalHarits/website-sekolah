<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->string('kategori')->toString();

        $posts = Post::published()->with('category')
            ->when($category, fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $category)))
            ->paginate(9)->withQueryString();

        return view('berita.index', [
            'posts' => $posts,
            'categories' => PostCategory::orderBy('name')->get(),
            'activeCategory' => $category,
        ]);
    }

    public function show(string $slug): View
    {
        $post = Post::published()->with(['category', 'author'])->where('slug', $slug)->firstOrFail();
        $post->increment('views');

        return view('berita.show', [
            'post' => $post,
            'related' => Post::published()->where('id', '!=', $post->id)->limit(3)->get(),
        ]);
    }
}
