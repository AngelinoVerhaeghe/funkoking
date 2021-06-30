<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$addresses = Address::withTrashed()->paginate(5);
        $addresses = Address::with(['user'])->withTrashed()->get();
        return view('admin.addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = User::with(['photo', 'role'])->get();
        return view('admin.addresses.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        Session::flash('created_address', 'User address Created!');
        return redirect()->back();

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
    public function edit(Address $address)
    {
        //
        $user = User::all();
        return view('admin.addresses.edit', compact('address', 'user'));
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
        $address = Address::findOrFail($request->address_id);

        if ($request->postbox == ''){
            $input = $request->except('postbox');
        }else {
            $input = $request->all();
        }

        $address->update($input);
        Session::flash('updated_address', 'The address has been updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
        $address->delete();
        Session::flash('deleted_address', 'The address has been deleted!');
        return redirect('admin/addresses');
    }

    public function addressRestore($id)
    {
        Address::onlyTrashed()->where('id', $id)->restore();
        Session::flash('softdeleted_address', 'The address has been restored!');
        return redirect('admin/addresses');
    }
}
