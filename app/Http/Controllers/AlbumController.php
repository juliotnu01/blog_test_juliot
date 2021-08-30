<?php

namespace App\Http\Controllers;

use App\Models\{Album, Location, Tag, TagPhotos, Photo};
use Illuminate\Http\Request;
use App\Http\Resources\ALbumResource;
use DB;
use File;
use Illuminate\Support\Facades\Storage;


class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $album = Album::with(['belongsToLocation', 'belongsToMember', 'hasManyPhotos'])->get();
            return  response()->json(ALbumResource::collection($album));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('createAlbum');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Album $album, Location $location)
    {
        try {
            return DB::transaction(function () use ($request, $album, $location) {
                
                $location->name = $request['ubicacion'];
                $location->save();

                $album->title = $request['title'];
                $album->description = $request['descripcion'];
                $album->location_id = $location['id'];
                $album->save();


               foreach (collect($request) as $key => $value) {
                    if (is_file($request->file($key))) {
                        $photos[] = $request->file($key);
                    }
                }

                for ($i=0; $i < count($photos) ; $i++) { 
                        Storage::disk('photo')->put('photos/'.$photos[$i]->getClientOriginalName(),  File($photos[$i]) );
                        $url = Storage::disk('photo')->url('photos/'.$photos[$i]->getClientOriginalName());
                        $ph = new Photo();
                        $ph->imgPath = $url;
                        $ph->album_id = $album['id'];
                        $ph->save();
                }
                $albums = collect(ALbumResource::collection(Album::with(['belongsToLocation', 'belongsToMember', 'hasManyPhotos'])->get()));
                return view('home',compact('albums'));
            }, 5);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $album = Album::where('id', $id)->with(['belongsToLocation', 'belongsToMember', 'hasManyPhotos', 'hasManyPhotos.hasManyTags'])->first();
            return view('ViewAlbum', compact(['album']));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        //
    }
}
