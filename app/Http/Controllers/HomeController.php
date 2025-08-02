<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use App\Models\IssueCategory;
use App\Models\IssuePhoto;
use Intervention\Image\Image;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session as FacadesSession;

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
            "fetchIssuesUrl"=>"fetch-issues"
        ]);
    }
    function FetchAllIssues(Request $request)
    {
        $issues = Issue::query()->with("photos", "category", "status_updates")
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->category, fn($q) => $q->where('category_id', Crypt::decrypt($request->category)))
            ->when($request->distance, fn($q) => $q->withinDistance($request->latitude, $request->longitude, $request->distance))
            ->paginate(9);
        return response()->json($issues);
    }
    function FetchMyIssues(Request $request)
    {
        $issues = Issue::query()->with("photos")
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->category, fn($q) => $q->where('category_id', Crypt::decrypt($request->category)))
            ->when($request->distance, fn($q) => $q->withinDistance($request->latitude, $request->longitude, $request->distance))->
            where('user_id', Crypt::decrypt(FacadesSession::get('user_id')))
            ->paginate(9);
        return response()->json($issues);
    }
    public function UserIssue(){
        $issues = Issue::query()->with("photos")
        ->when(request('status'), fn($q) => $q->where('status', request('status')))
        ->when(request('category'), fn($q) => $q->where('category_id', request('category')))
        // ->when(request('distance'), fn($q) => $q->withinDistance(request('distance'))) // custom scope
        ->where('user_id', Crypt::decrypt(FacadesSession::get('user_id')))
        ->paginate(9);
        return view('home', [
            'title' => 'My Issues',
            'description' => 'View and manage your reported civic issues.',
            'issues' => $issues,
            "fetchIssuesUrl"=>"fetch-my-issues",
            'categories' => IssueCategory::all(),
        ]);
    }
    function IssueView($uri){
        $issue = Issue::with(['category', 'photos', 'status_updates'])
                     ->findOrFail($uri);
        
        // Get related issues in the same area (within 1km radius)
        $relatedIssues = Issue::where('id', '!=', $issue->id)
                             ->where('category_id', $issue->category_id)
                             ->whereRaw("
                                 (6371 * acos(cos(radians(?)) 
                                 * cos(radians(lat)) 
                                 * cos(radians(lng) - radians(?)) 
                                 + sin(radians(?)) 
                                 * sin(radians(lat)))) < ?
                             ", [$issue->lat, $issue->lng, $issue->lat, 1]) // 1km radius
                             ->with(['category', 'photos'])
                             ->limit(3)
                             ->get();
        var_dump($issue);
        return view('issue_view', [
            'title' => $issue->title,
            'description' => $issue->description,
            'issue' => $issue,
            'relatedIssues' => $relatedIssues,
            'categories' => IssueCategory::all(),
        ]);
    }
    function ReportIssueView(Request $req){
        if (!$req->session()->has('user_id')) {
            return redirect()->route('login');
        }
        return view('report-issue', [
            'title' => 'Report a Civic Issue',
            'description' => 'Report a civic issue in your community.',
            'categories' => IssueCategory::all(),
        ]);
    }
    public function reportIssue(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'address' => 'nullable|string|max:255',
            'category_id' => 'required',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:4096', // 4MB max per photo
        ]);


        $photoPaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $k=>$photo) {
                // Create a unique filename
                $filename = uniqid() . '.' . $photo->getClientOriginalExtension();

                // Compress and resize
                // $image = Image::make($photo->getRealPath());
                // $image->resize(1280, null, function ($constraint) {
                //     $constraint->aspectRatio();
                //     $constraint->upsize();
                // });

                // Save with 75% quality
                $path = 'issues/photos/' . $filename;
                // Storage::disk('public')->put($path, (string) $image->encode(null, 75));
                $request->file('images')[$k]->storeAs('issues/photos', $filename, 'public');

                $photoPaths[] = $path;
            }
        }

        $issue = Issue::insert([
            'user_id' => Crypt::decrypt(FacadesSession::get('user_id')),
            'title' => $request->title,
            'description' => $request->description,
            'lat' => $request->latitude,
            'lng' => $request->longitude,
            'address' => $request->address,
            'category_id' => Crypt::decrypt($request->category_id),
            'status' => 'reported',
            "created_at" => now(),
        ]);
        IssuePhoto::insert(array_map(function ($path) use ($issue) {
            return [
                'issue_id' => Issue::max('id'),
                'photo_path' => $path,
            ];
        }, $photoPaths));

        return redirect()->back()->with('success', 'Issue reported.');
    }
}
