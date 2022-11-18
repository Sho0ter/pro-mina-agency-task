<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePictureRequest;
use App\Http\Requests\UpdatePictureRequest;
use App\Models\Album;
use App\Models\Picture;
use Exception;
use Illuminate\Support\Facades\File;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Album $album)
    {
        $pictures = $album->pictures()->paginate(20);
        return view('picture.index',compact('pictures','album'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Album $album)
    {
        return view('picture.create', compact('album'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePictureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePictureRequest $request, Album $album)
    {
        $image = $request->file('file');
        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name= $filename.'-'.time().'.'.$extension;
        $image->move(public_path('uploads/albums/'.$album->id.'/'),$file_name);
            
        $imageUpload = new Picture();
        $imageUpload->name = $fileInfo;
        $imageUpload->path = $file_name;
        $imageUpload->album_id = $album->id;
        $imageUpload->save();
        return response()->json(['success'=>$file_name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album, Picture $picture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album, Picture $picture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePictureRequest  $request
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePictureRequest $request, Album $album, Picture $picture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album, Picture $picture)
    {
        try{
            if (File::exists(public_path('uploads/albums/'.$album->id.'/'.$picture->path))) {
                File::delete(public_path('uploads/albums/'.$album->id.'/'.$picture->path));
            }
            
            $picture->delete();
        }catch(Exception $e){
            session()->flash('error' , 'error In delete');
            return redirect(route('albums.pictures.index', ['album'=> $album->id]));
        }
        session()->flash('success' , 'picture deleted Successfully');
        return redirect(route('albums.pictures.index', ['album'=> $album->id]));   
    }
}
