<?php

namespace App\Http\Controllers;

use App\Order;
use App\Photo;
use App\Product;
use App\Review;
use App\Stock;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class AdminPhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$photos = Photo::withTrashed()->paginate(5);
        $photos = Photo::all();
        return view('admin.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Dropzone
       /* $file = $request->file('file');
        $filename = time() . $file->getClientOriginalName();
        $name = $file->getClientOriginalName();
        $name = substr($name, 0, -4);
        $file->move('images/', $filename);
        Photo::create(['file' => $filename, 'name' => $name]);
        Session::flash('created_photo', 'Photo has been Uploaded!');
        return redirect('admin/photos');*/

        if (request()->has('file')){
            $file = $request->file('file');
            $filename = time() . $file->getClientOriginalName();
            $name = $file->getClientOriginalName();
            $name = substr($name, 0, -4);
            $file->move('images/', $filename);
            Photo::create(['file' => $filename, 'name' => $name]);
        }

        Session::flash('created_photo', 'Photo has been Uploaded!');
        return redirect('admin/photos');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $photo = Photo::findOrFail($id);
        return view('admin.photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, Photo $photo)*/
    public function update(Request $request)
    {
        //
        $photo = Photo::findOrFail($request->photo_id);
        //Als het photo veld leeg is update alles except() behalve het photo.
        if (trim($request->file) != '') {
            $input = $request->except('file');
        } else {
            $input = $request->all();

        }
        $photo->update($input);
        Session::flash('updated_photo', 'Photo name is updated!');
        return redirect('admin/photos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        //$photo = Photo::findOrFail($id);
        $photo = Photo::findOrFail($request->photo_id);
        unlink(public_path() . '/images/' . $photo->file);
        $photo->delete();
        Session::flash('deleted_photo', 'Photo has been deleted!');
        return redirect('admin/photos');
    }

    /* public function photosRestore($id)
     {
         Photo::onlyTrashed()->where('id', $id)->restore();
         Session::flash('softdeleted_photo', 'The photo has been restored!');
         return redirect('admin/photos');
     }*/

}
