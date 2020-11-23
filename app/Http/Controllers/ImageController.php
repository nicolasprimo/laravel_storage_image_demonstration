<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        return view('images.index',compact('images'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img = new Image;
        $img->src = $request->file('image')->hashName();
        $img->save();
        $request->file('image')->storePublicly('images','public');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::find($id);

        return view('images/edit',compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // 1 . Retrouver l'image dans la DB
        $image = Image::find($id);
        // 2 . Supprimer l'image de base
        Storage::disk('public')->delete('images/' . $image->src);
       // 3 . Modifier le chemin de l'image dans la colonne src par celui de la nouvelle image
        $image->src = $request->file('image')->hashName();
        $image->save();
        // 4 . Rajouter l'image dans le dossier
        $request->file('image')->storePublicly('images', 'public');
        return redirect()->back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }

    public function download($id)
    {
       $image = Image::find($id);
       return Storage::disk('public')->download('images/'.$image->src);
    }
}
