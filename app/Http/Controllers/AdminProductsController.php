<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductsCreateRequest;
use App\Order;
use App\Photo;
use App\Product;
use App\Review;
use App\Stock;
use App\SubCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::pluck('name', 'id')->all();
        $subcategories = SubCategory::pluck('name', 'id')->all();
        $photos = Photo::all();
        //$products = Product::withTrashed()->paginate(50);
        $products = Product::with(['photo', 'category', 'subcategory'])->withTrashed()->get();
        return view('admin.products.index', compact('products', 'photos', 'categories', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name', 'id')->all();
        $subcategories = SubCategory::pluck('name', 'id')->all();
        return view('admin.products.create', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsCreateRequest $request)
    {
        //Create new product
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->name = $request->name;
        $product->title = $request->title;
        $product->subtitle = $request->subtitle;
        $product->description = $request->description;
        $product->price = $request->price;
        $product['slug'] = Str::slug($request->title, '-');

        //Photo
        if ($file = $request->file('photo_id')) {
            $filename = time() . $file->getClientOriginalName();
            $name = $file->getClientOriginalName();
            $name = substr($name, 0, -4);
            $file->move('images/', $filename);
            $photo = Photo::create(['file' => $filename, 'name' => $name]);
            $product['photo_id'] = $photo->id;

        }

        /* if ($file = $request->file('photo2_id')) {
             $filename = 'products/' . time() . $file->getClientOriginalName();
             $name = $file->getClientOriginalName();
             $name = substr($name, 0, -4);
             $file->move('images/products/', $filename);
             $photo = Photo::create(['file' => $filename, 'name' => $name]);
             $product['photo2_id'] = $photo->id;
         }*/

        //Store product
        $product->save();

        //Store it to Stock table
        Stock::create([
            'product_id' => $product->id,
            'photo_id' => $product['photo_id'],
            'quantity' => '20' //Standard 20 in stock
        ]);


        Session::flash('created_product', 'The product has been created!');
        return redirect('admin/products');

    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = Auth::user();
        $product = Product::with(['photo', 'category', 'subcategory'])->where('slug', $slug)->first();
        $photosSlider = Product::with(['photo', 'category', 'subcategory'])->where('slug', '!=', $slug)->inRandomOrder()->take(8)->get();
        $reviews = Review::with(['product', 'user'])->get();
        $photos = Photo::all();
        $stocks = Stock::all();
        $users = User::with(['photo']);
        return view('product', compact('product', 'reviews', 'photos', 'users', 'photosSlider', 'stocks', 'user'));

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
        $product = Product::findOrFail($id);
        $photos = Photo::pluck('name', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();
        $subcategories = SubCategory::pluck('name', 'id')->all();
        return view('admin.products.edit', compact('product', 'categories', 'photos', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $product = Product::findOrFail($request->product_id);
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $input = $request->all();
        if ($file = $request->file('photo_id') == '') {
            $input = $request->except('photo_id');
        }elseif($file = $request->file('photo_id')) {
            unlink(public_path() . '/images/' . $product->photo->file);
            $product->photo->delete();
            $file = $request->file('photo_id');
            $filename = time() . $file->getClientOriginalName();
            $name = $file->getClientOriginalName();
            $name = substr($name, 0, -4);
            $file->move('images/', $filename);
            $photo = Photo::create(['file' => $filename, 'name' => $name]);
            $input['photo_id'] = $photo->id;
            DB::table('stocks')->update([
                'photo_id' => $photo->id,
            ]);
        }
        $input['slug'] = Str::slug($request->title, '-');
        $product->update($input);
        Session::flash('updated_product', 'The product has been updated!');
        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();
        Session::flash('deleted_product', 'The product has been deleted!');
        return redirect('admin/products');
    }

    public function productRestore($id)
    {
        Product::onlyTrashed()->where('id', $id)->restore();
        Session::flash('softdeleted_product', 'The product has been restored!');
        return redirect('admin/products');
    }

    public function productsPerCategory($slug)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $products = Product::with(['category', 'photo', 'subcategory'])->paginate(9);
        $toppers = Product::with(['photo'])->inRandomOrder()->take(3)->get();

        if ($slug == 'funko-pop') {
            $products = Product::with(['category', 'photo', 'subcategory'])
                ->where('category_id', '=', '1')
                ->paginate(9);
            return view('shop', compact('categories', 'products', 'subcategories', 'toppers'));
        } elseif ($slug == 'actie-figuren') {
            $products = Product::with(['category', 'photo', 'subcategory'])
                ->where('category_id', '=', '2')
                ->paginate(9);
            return view('shop', compact('categories', 'products', 'subcategories', 'toppers'));
        }elseif ($slug == 'sleutelhangers'){
            $products = Product::with(['category', 'photo', 'subcategory'])
                ->where('category_id', '=', '3')
                ->paginate(9);
            return view('shop', compact('categories', 'products', 'subcategories', 'toppers'));
        }
        return view('shop', compact('categories', 'products', 'subcategories', 'toppers'));

    }

    public function productsPerSubCategory($id)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $toppers = Product::with(['photo'])->inRandomOrder()->take(3)->get();
        $products = Product::with(['category', 'photo', 'subcategory'])
            ->where('subcategory_id', '=', $id)
           /* ->where('category_id', '=', '1')*/
            ->paginate(9);
        /*return view('pop', compact('subcategories', 'products', 'toppers'));*/
        return view('shop', compact('subcategories', 'products', 'toppers', 'categories'));
    }

    public function info($id)
    {
        $product = Product::findOrFail($id);
        $stocks = Stock::all();
        $photos = Photo::all();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('admin.products.info', compact('product', 'photos', 'categories', 'subcategories', 'stocks'));
    }

}

