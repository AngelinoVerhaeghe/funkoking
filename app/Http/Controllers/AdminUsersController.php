<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\UsersCreateRequest;
use App\Mail\WelcomeMail;
use App\Order;
use App\Photo;
use App\Review;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::pluck('name', 'id')->all();
        $users = User::with(['photo', 'roles', 'address'])->withTrashed()->get();
        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersCreateRequest $request)
    {
        //
        //We krijgen de nieuwe waarden binnen van een user() + alle velden ook aanmaken die uit $request komen
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($file = $request->file('photo_id')) {
            $filename = time() . $file->getClientOriginalName();
            $name = $file->getClientOriginalName();
            $name = substr($name, 0, -4);
            $file->move('images/', $filename);
            $photo = Photo::create(['file' => $filename, 'name' => $name]);
            $user['photo_id'] = $photo->id;
        }
        $user->password = Hash::make($request->password);
        //Voordeel 2ledig alle gegevens weg schrijven in tabel van user en retourneerd aan het object van user automatisch het laatste ID ->save()
        $user->save();
        //User role ->sync(met de aangeklikte roles) de array die binnen komt ($request->roles)
        $user->roles()->sync($request->roles, false);
        Mail::to($user->email)->send(new WelcomeMail());
        Session::flash('created_user', 'User Created!');
        return redirect('/admin/users');

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
    public function edit(User $user)
    {
        $address = Address::all();
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.edit', compact('roles', 'user', 'address'));

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

        $user = User::findOrFail($request->user_id);
        //Als het paswoord veld leeg is update alles except() behalve het paswoord.
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            //Indien het paswoord veld niet leeg is dan update je alles en Hash je het paswoord dat werd in gevuld.
            $input = $request->all();
            $input['password'] = Hash::make($request['password']);
        }
        //Photo
        if ($file = $request->file('photo_id') == '') {
            $input = $request->except('photo_id');
        }elseif($file = $request->file('photo_id')) {
            unlink(public_path() . '/images/' . $user->photo->file);
            $user->photo->delete();
            $file = $request->file('photo_id');
            $filename = time() . $file->getClientOriginalName();
            $name = $file->getClientOriginalName();
            $name = substr($name, 0, -4);
            $file->move('images/', $filename);
            $photo = Photo::create(['file' => $filename, 'name' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $user->update($input);

        //In de tussentabel de aangeduide rollen moeten weggeschreven worden, detaching true = ermag gewijzigd worden in de tabel
        $user->roles()->sync($request->roles, true);
        Session::flash('updated_user', 'User has been Updated!');
        return redirect('/admin/users');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        //Delete user
        $user->delete();
        Session::flash('deleted_user', 'The user has been deleted!');
        return redirect('admin/users');
    }

    public function userRestore($id)
    {
        User::onlyTrashed()->where('id', $id)->restore();
        Session::flash('softdeleted_user', 'The user has been restored!');
        return redirect('admin/users');
    }

    public function profile($id)
    {
        $orders = Order::all();
        $review = Review::all();
        $user = User::findOrFail($id);
        $address = Address::all();
        $photo = Photo::all();
        return view('admin.users.profile', compact('address', 'photo', 'user', 'review', 'orders'));
    }

}
