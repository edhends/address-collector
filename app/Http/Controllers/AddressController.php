<?php

namespace App\Http\Controllers;

use App\Libs\Usps\Address as UspsAddress;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('addresses.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['country','city','state','zip5','zip4','address1','address2']);
        $address = Address::create($data);
        return ["success"=>true,"address" => $address];
    }

    public function validateAddress(Request $request)
    {

        // $validatedData = $request->validate([
        //     'address' => 'required',
        //     'country' => 'required',
        //     'state' => 'required',
        // ]);

        $address = new UspsAddress([
            'Address1' => $request->get('address1'),
            'Address2' => $request->get('address2'),
            'City' => $request->get('city'),
            'State' => $request->get('state'),
            'Zip5' => $request->get('zip5')
        ]);

        $response = $address->validate('object');

        if (isset($response->Address->Error)) {
            return ['success' => false, 'error' => $response->Address->Error->Description];
        }

        return ['success' => true, 'address' => $response->Address];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
