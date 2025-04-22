<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if the user is an admin
        $totalUsers = User::where('role', 'user')->count(); // Only non-admin users
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalRented = Rental::count();
    
        $monthlyData = Rental::selectRaw('MONTH(start_date) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');
    
    $monthLabels = [];
    foreach ($monthlyData->keys() as $monthNum) {
        $monthLabels[] = date('F', mktime(0, 0, 0, $monthNum, 10));
    }
        
        $statusCounts = Rental::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');
    
        return view('admin.dashboard', compact('totalUsers', 'totalCategories', 'totalProducts', 'totalRented', 'monthlyData', 'monthLabels', 'statusCounts'));
    }
}
