<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\IssueCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $issues = Issue::query()
        ->when(request('status'), fn($q) => $q->where('status', request('status')))
        ->when(request('category'), fn($q) => $q->where('category_id', request('category')))
        // ->when(request('distance'), fn($q) => $q->withinDistance(request('distance'))) // custom scope
        ->paginate(9);
        return view('home', [
            'title' => 'Welcome to CivicTrack',
            'description' => 'Your platform for civic engagement and issue tracking.',
            'issues' => $issues,
            'categories' => IssueCategory::all(),
        ]);
    }
}
