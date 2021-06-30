<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use App\Http\Requests\BlogsCreateRequest;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon;

class AdminBlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $photos = Photo::all();
        $blogCategories = BlogCategory::pluck('name', 'id')->all();
       /* $blogs = Blog::with(['user', 'photo', 'blogcategory'])->withTrashed()->paginate(5);*/
        $blogs = Blog::with(['user', 'photo', 'blogcategory'])->get();
        return view('admin.blogs.index', compact('blogs', 'photos', 'blogCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $blogCategories = BlogCategory::pluck('name', 'id')->all();
        return view('admin.blogs.create', compact('blogCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogsCreateRequest $request)
    {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->blog_category_id = $request->blog_category_id;
        if ($file = $request->file('photo_id')) {
            $filename = time() . $file->getClientOriginalName();
            $name = $file->getClientOriginalName();
            $name = substr($name, 0, -4);
            $file->move('images/', $filename);
            $photo = Photo::create(['file' => $filename, 'name' => $name]);
            $blog['photo_id'] = $photo->id;
        }
        $blog['user_id'] = Auth::User()->id;
        $blog['slug'] = Str::slug($request->title, '-');
        $blog->save();
        Session::flash('created_blog', 'Blog Created!');
        return redirect('/admin/blogs');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('blog-show', compact('blog'));
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
        $blog = Blog::findOrFail($id);
        $photos = Photo::pluck('name', 'id')->all();
        $blogCategories = BlogCategory::pluck('name', 'id')->all();
        return view('admin.blogs.edit', compact('blog', 'photos', 'blogCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        /*$blog = Blog::findOrFail($id);*/
        $blog = Blog::findOrFail($request->blog_id);
        $input = $request->all();
        if ($file = $request->file('photo_id') == '') {
            $input = $request->except('photo_id');
        }elseif($file = $request->file('photo_id')) {
            unlink(public_path() . '/images/' . $blog->photo->file);
            $blog->photo->delete();
            $file = $request->file('photo_id');
            $filename = time() . $file->getClientOriginalName();
            $name = $file->getClientOriginalName();
            $name = substr($name, 0, -4);
            $file->move('images/', $filename);
            $photo = Photo::create(['file' => $filename, 'name' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $input['slug'] = Str::slug($request->title, '-');
        $blog->update($input);
        Session::flash('updated_blog', 'Blog has been updated!');
        return redirect('admin/blogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $blog = Blog::findOrFail($request->blog_id);
        unlink(public_path() . '/images/' . $blog->photo->file);
        $blog->delete();
        Session::flash('deleted_blog', 'Blog has been deleted!');
        return redirect('admin/blogs');
    }

  /*  public function blogRestore($id)
    {
        Blog::onlyTrashed()->where('id', $id)->restore();
        Session::flash('softdeleted_blog', 'Blog has been restored!');
        return redirect('admin/blogs');
    }*/
}
