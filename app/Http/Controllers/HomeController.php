<?php

namespace App\Http\Controllers;
use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Resources\ALbumResource;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $albums = collect(ALbumResource::collection(Album::with(['belongsToLocation', 'belongsToMember'])->get()));
        return view('home',compact('albums'));
    }
}
