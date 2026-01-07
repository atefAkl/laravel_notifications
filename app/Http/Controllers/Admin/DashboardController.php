<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'new_users_today' => User::whereDate('created_at', today())->count(),
            'active_users' => User::where('email_verified_at', '!=', null)->count(),
            'admin_users' => User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->count(),
        ];

        $recentUsers = User::with('roles')
            ->latest()
            ->take(5)
            ->get();

        $userRegistrations = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'userRegistrations'));
    }
}
