<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Layanan;
use App\Models\Produk;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $layanan = Layanan::where('status_aktif', 1)->get();
        $produk  = Produk::where('status_aktif', 1)->take(6)->get();

        return view('frontend.index', compact('layanan', 'produk'));
    }

    public function produk()
    {
        $categories = Category::where('type', 'produk')->get();
        $produk     = Produk::with('category')->where('status_aktif', 1)->get();

        return view('frontend.produk', compact('produk', 'categories'));
    }

    public function produkDetail($slug)
    {
       
    $produk = Produk::with('category')->where('slug', $slug)->firstOrFail();
    $produkTerkait = Produk::with('category')
        ->where('status_aktif', 1)
        ->where('category_id', $produk->category_id)
        ->where('id', '!=', $produk->id)
        ->limit(4)
        ->get();
    return view('frontend.produk-detail', compact('produk', 'produkTerkait'));
    }

    public function layanan()
    {
        $layanan = Layanan::where('status_aktif', 1)->get();

        return view('frontend.layanan', compact('layanan'));
    }

    public function blog()
    {
        $blog = Blog::with('category')
        ->where('status','published')
        ->latest('published_at')
        ->paginate(9);
        $categories = Category::where ('type','blog')->withCount(['blogs' => function($q){$q
                    ->where('status','published');}])
                     ->get();
       
         $popularBlogs = Blog::where('status','published')
                        ->orderBy('views','desc')
                        ->limit(3)
                        ->get();
         $featuredBlog = Blog::with('category')
                        ->where('status','published')
                        ->latest('published_at')
                        ->first();
          return view('frontend.blog', compact('blog','categories','popularBlogs','featuredBlog'));
    }

    public function detailBlog($slug)
    {
               // Ambil artikel berdasarkan slug
        $blog = Blog::with('category','subJudul')
                    ->where('slug', $slug)
                    ->where('status', 'published')
                    ->firstOrFail();
 
        // Tambah view count
        $blog->increment('views');
 
        // Artikel sebelumnya (lebih lama)
        $prev = Blog::where('status', 'published')
                    ->where('id', '<', $blog->id)
                    ->orderBy('id', 'desc')
                    ->first();
 
        // Artikel selanjutnya (lebih baru)
        $next = Blog::where('status', 'published')
                    ->where('id', '>', $blog->id)
                    ->orderBy('id', 'asc')
                    ->first();
 
        // Artikel terbaru untuk sidebar
        $recentBlogs = Blog::where('status', 'published')
                           ->where('id', '!=', $blog->id)
                           ->latest('published_at')
                           ->limit(4)
                           ->get();
 
        // Kategori untuk sidebar
        $categories = Category::withCount(['blogs' => function ($q) {
                            $q->where('status', 'published');
                        }])
                        ->having('blogs_count', '>', 0)
                        ->orderBy('blogs_count', 'desc')
                        ->get();
 
        return view('frontend.blog-detail', compact(
            'blog', 'prev', 'next', 'recentBlogs', 'categories'
        ));

    }

    public function contact()
    {
        return view('frontend.contact');
    }
}