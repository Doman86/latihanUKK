<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'products' => Product::count(),
            'comments' => Comment::count(),
            'users' => User::count(),
        ];

        $recentProducts = Product::with('user')->latest()->limit(4)->get();

        return view('dashboard', compact('stats', 'recentProducts'));
    }
}