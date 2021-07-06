<?php

namespace App\Http\Controllers\Api\userOpration;

use App\Http\Controllers\Controller;
use App\Models\GoldBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class GoldBarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goldBarOwners = GoldBar::all();
        return response()->json([
            'goldBarOwners' => $goldBarOwners,
            'error' => false  ,
            'message_en' => '',
            'message_ar' => ''
        ], 200);
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
        //Begin Store
        $data = $request->validate(
            [
                'gold_bar_owner' => 'required',
                'gold_ingot_weight' => 'required',
                'sample_weight' => 'required',
                'gold_karat_weight' => 'required',
                // 'role' =>
            ]);


        $goldBarOwner = GoldBar::create($data);

        //

        return response()->json([
            'goldBarOwner' =>$goldBarOwner,
            'error' => false  ,
            'message_en' => '',
            'message_ar' => ''
        ], 200);
        // End Store
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
