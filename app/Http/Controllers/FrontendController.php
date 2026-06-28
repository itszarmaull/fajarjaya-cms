<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Project;
use App\Models\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $products = Product::latest()->take(3)->get();
        $projects = Project::latest()->take(3)->get();
        $faqs = \App\Models\Faq::orderBy('sort_order')->get();
        $testimonials = \App\Models\Testimonial::latest()->get();
        return view('home', compact('products', 'projects', 'faqs', 'testimonials'));
    }

    public function products()
    {
        $products = Product::latest()->get()->map(function ($product) {
            $product->image_url = $product->image ? \Storage::url($product->image) : null;
            return $product;
        });
        $categories = $products->pluck('category')->unique()->filter()->values();
        return view('produk', compact('products', 'categories'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('detail-produk', compact('product'));
    }

    public function projects()
    {
        $projects = Project::latest()->paginate(9);
        return view('proyek', compact('projects'));
    }

    public function about()
    {
        return view('tentang');
    }

    public function contact()
    {
        return view('kontak');
    }

    public function calculator()
    {
        $options = \App\Models\CalculatorOption::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $kusenBrands = $options->where('type', 'kusen')->values();
        $kusenColors = $options->where('type', 'warna')->values();
        $kacaTypes = $options->where('type', 'kaca')->values();
        $unitTypes = $options->where('type', 'unit')->values();

        return view('kalkulator', compact('kusenBrands', 'kusenColors', 'kacaTypes', 'unitTypes'));
    }

    public function blog(Request $request)
    {
        $query = Post::where('status', 'published')->latest();

        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->has('category') && !empty($request->input('category'))) {
            $query->where('category', $request->input('category'));
        }

        $posts = $query->paginate(9)->withQueryString();
        
        $categories = Post::where('status', 'published')
            ->whereNotNull('category')
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('blog', compact('posts', 'categories'));
    }

    public function blogDetail($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $post->increment('views_count');

        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('category', $post->category)
            ->latest()
            ->take(3)
            ->get();

        return view('detail-blog', compact('post', 'relatedPosts'));
    }

    public function sitemap()
    {
        $products = Product::latest()->get();
        $projects = Project::latest()->get();
        $posts = Post::where('status', 'published')->latest()->get();

        return response()->view('sitemap', compact('products', 'projects', 'posts'))
            ->header('Content-Type', 'text/xml');
    }
}
