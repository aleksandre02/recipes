<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $recipes = $user->recipes; // Assuming a user has many recipes
        $favorites = $user->favorites; // Assuming a user has a favorites relationship

        return view('dashboard.index', compact('recipes', 'favorites'));
    }
}
