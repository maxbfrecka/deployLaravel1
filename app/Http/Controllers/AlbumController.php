<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests; 
use \App\Album;
use \App\Http\Resources\Album as AlbumResource;
use Illuminate\Validation\Rules\RequiredIf;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $albums = Album::all();
        return view('albums.albums')->with('albums', $albums);
    }

    //API CALL TO GET LIST OF ALBUMS
    public function getAlbums()
    {
        //get albums
        $albums = Album::paginate(15);
        return AlbumResource::collection($albums);
    }  

    public function getAlbumId($id)
    {
        //get albums
        $album = Album::findOrFail($id);
        return new AlbumResource($album);
    } 

    public function getAlbumCatalogId($catalogID)
    {
        //get albums
        $album = Album::where('catalogID', $catalogID)->FirstOrFail();
        return new AlbumResource($album);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //i dont understand this
        return view('/');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'albumtitle' => 'required'
        ]);
        $album = new Album([
            'albumtitle' => $request->get('albumtitle')
        ]);
        $album -> save();
        return redirect()->route('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($catalogID)
    {
        //passes the catalogID to the album.blade.php route
        $album = Album::where('catalogID', $catalogID)->FirstOrFail();

        return view('albums.album')->with('album', $album);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
