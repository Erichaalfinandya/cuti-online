<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // contoh data dummy, nanti bisa diambil dari database
        $usersCount = 120;
        $projectsCount = 15;
        $revenue = 50250;

        $projects = [
            ['name' => 'Launch Mobile App', 'progress' => 100, 'value' => 20500],
            ['name' => 'New Pricing Page', 'progress' => 25, 'value' => 500],
            ['name' => 'Redesign Homepage', 'progress' => 40, 'value' => 4000],
        ];

        return view('dashboard', compact('usersCount', 'projectsCount', 'revenue', 'projects'));
    }
}