<?php

namespace App\Http\Controllers;

use App\Address;
use App\Blog;
use App\Cart;
use App\Category;
use App\Currency;
use App\Faq;
use App\FaqCategory;
use App\PaymentPlatform;
use App\Photo;
use App\Product;
use App\Review;
use App\SubCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use function Symfony\Component\String\u;

class PagesController extends Controller
{
    //
    public function funkoIndex()
    {
        $user = Auth::user();
        $products = Product::with(['photo', 'category', 'subcategory'])->take(4)->latest('created_at')->get();
        $aanbevolenProducts = Product::with(['photo', 'category', 'subcategory'])->inRandomOrder()->take(5)->get();
        return view('index', compact('products', 'aanbevolenProducts', 'user'));
    }

    public function funkoLogin()
    {
        return view('login');
    }

    public function funkoRegister()
    {
        return view('register');
    }

    public function funkoReview()
    {
        $user = Auth::user();
        $users = User::with(['photo'])->get();
        return view('review', compact('users', 'user'));
    }

    public function funkoFaq()
    {
        $user = Auth::user();
        $faqcategories = FaqCategory::all();
        //$faqcategories = Faq::with(['faq_category_id'])->where('faq_category_id', '=', $id)->get();
        return view('faq', compact('faqcategories', 'user'));
    }

    public function funkoShop()
    {
        $user = Auth::user();
        $subcategories = SubCategory::all();
        $photos = Photo::all();
        $products = Product::with(['photo', 'category', 'subcategory'])
            ->orderBy('created_at', 'DESC')
            ->paginate(9);
        $categories = Category::all();
        $toppers = Product::with(['photo', 'category', 'subcategory'])->inRandomOrder()->take(3)->get();

        if (request()->sort == 'low_high') {
            $products = Product::with(['photo', 'category', 'subcategory'])->orderBy('price')->paginate(9);
            return view('shop', compact('categories', 'products', 'photos', 'toppers', 'subcategories', 'user'));
        } elseif (request()->sort == 'high_low') {
            $products = Product::with(['photo', 'category', 'subcategory'])->orderByDesc('price')->paginate(9);
            return view('shop', compact('categories', 'products', 'photos', 'toppers', 'subcategories', 'user'));
        } elseif (request()->sort == 'name') {
            $products = Product::with(['photo', 'category', 'subcategory'])->orderBy('name')->paginate(9);
            return view('shop', compact('categories', 'products', 'photos', 'toppers', 'subcategories', 'user'));
        } else {
            return view('shop', compact('categories', 'products', 'photos', 'toppers', 'subcategories', 'user'));
        }


    }

    /* public function funkoPop()
     {
         $subcategories = SubCategory::all();
         $photos = Photo::all();
         $products = Product::with(['photo', 'category', 'subcategory'])->inRandomOrder()->paginate(9);
         $categories = Category::all();
         $toppers = Product::with(['photo', 'category', 'subcategory'])->inRandomOrder()->take(3)->get();

         if (request()->sort == 'low_high'){
             $products = Product::with(['photo', 'category', 'subcategory'])
                 ->where('category_id', '=', '1')
                 ->orderBy('price')
                 ->paginate(9);
             return view('pop', compact('categories', 'products', 'photos', 'toppers', 'subcategories'));
         }elseif(request()->sort == 'high_low'){
             $products = Product::with(['photo', 'category', 'subcategory'])
                 ->where('category_id', '=', '1')
                 ->orderByDesc('price')
                 ->paginate(9);
             return view('pop', compact('categories', 'products', 'photos', 'toppers', 'subcategories'));
         }elseif (request()->sort == 'name'){
             $products = Product::with(['photo', 'category', 'subcategory'])
                 ->where('category_id', '=', '1')
                 ->orderBy('name')
                 ->paginate(9);
             return view('pop', compact('categories', 'products', 'photos', 'toppers', 'subcategories'));
         }
         else{
             return view('pop', compact('categories', 'products', 'photos', 'toppers', 'subcategories'));
         }

     }*/

    public function funkoBlog()
    {
        $user = Auth::user();
        $photos = Photo::all();
        $blogs = Blog::with(['photo', 'blogcategory'])->get();
        return view('blog', compact('blogs', 'photos', 'user'));
    }

    public function blogShow()
    {
        $user = Auth::user();
        $photo = Photo::all();
        return view('blog-show', compact('photo', 'user'));
    }

    public function funkoWinkelwagen()
    {
        $user = Auth::user();
        return view('winkelwagen', compact('user'));
    }

    public function funkoCheckout()
    {

        $user = Auth::user();
        $currencies = Currency::all();
        $paymentPlatforms = PaymentPlatform::all();
        $addresses = Address::with(['user'])->get();
        if (!Session::has('cart')) {
            return redirect('index');
        } else {
            $currentCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($currentCart);
            $cart = $cart->products;
            return view('checkout', compact('addresses', 'cart', 'currencies', 'paymentPlatforms', 'user'));
        }

    }

    public function funkoAccount()
    {
        $user = Auth::user();
        $photos = Photo::all();
        return view('account', compact('photos', 'user'));
    }

    public function addToCart($id)
    {
        $product = Product::with(['category', 'subcategory', 'photo'])->where('id', '=', $id)->first();

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);
        return redirect()->route('winkelwagen')->with('success_message', 'Product toegevoegd aan winkelwagen!');
    }

    public function cart()
    {
        $user = Auth::user();
        if (!Session::has('cart')) {
            return redirect('index');
        } else {
            $currentCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($currentCart);
            $cart = $cart->products;
            return view('winkelwagen', compact('cart', 'user'));
        }
    }

    public function updateQuantity(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQuantity($request->id, $request->quantity);
        Session::put('cart', $cart);
        return redirect()->back();
    }

    public function removeItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        //Remove item vanuit model Cart
        $cart->removeItem($id);
        Session::put('cart', $cart);
        return redirect()->back()->with('remove_message', 'Product verwijderd uit winkelwagen!');
    }

    public function updateAccount(Request $request, User $user)
    {

        $user = Auth::user();

        //Als het paswoord veld leeg is update alles except() behalve het paswoord.
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            //Indien het paswoord veld niet leeg is dan update je alles en Hash je het paswoord dat werd in gevuld.
            $input = $request->all();
            $input['password'] = Hash::make($request['password']);
        }

        if (request()->has('photo_id')) {
            if (Auth::user()->photo_id == 1) {
                $file = $request->file('photo_id');
                $filename = time() . $file->getClientOriginalName();
                $name = $file->getClientOriginalName();
                $name = substr($name, 0, -4);
                $file->move('images/', $filename);
                $photo = Photo::create(['file' => $filename, 'name' => $name]);
                $input['photo_id'] = $photo->id;
            } else {
                unlink(public_path() . '/images/' . $user->photo->file);
                $file = $request->file('photo_id');
                $filename = time() . $file->getClientOriginalName();
                $name = $file->getClientOriginalName();
                $name = substr($name, 0, -4);
                $file->move('images/', $filename);
                $photo = Photo::create(['file' => $filename, 'name' => $name]);
                $input['photo_id'] = $photo->id;
            }
        }

        $user->update($input);

        Session::flash('updated_user', 'User Updated!');
        return redirect('account');
    }

    public function accountNewAddress(Request $request)
    {

        $user = Auth::user();

        $address = new address();
        $address->user_id = $request->user_id;
        $address->street = $request->street;
        $address->number = $request->number;
        $address->postalcode = $request->postalcode;
        if ($request->postbox != '') {
            $address->postbox = $request->postbox;
        } else {
            $address->postbox = 'NULL';
        }
        $address->city = $request->city;
        $address->country = $request->country;

        $address->save();

        DB::table('users')
            ->where('id', $user->id)
            ->update(['address_id' => $user->id]);

        Session::flash('created_address', 'The address has been created!');
        return redirect('account');
    }

    public function funkopaymentCompleted()
    {
        $user = Auth::user();
        return view('paymentCompleted', compact('user'));
    }

    public function updateAddress(Request $request)
    {
        $address = Address::findOrFail($request->address_id);
        $input = $request->all();
        $address->update($input);
        Session::flash('address_updated', 'Address updated!');
        return redirect('account');
    }


}
