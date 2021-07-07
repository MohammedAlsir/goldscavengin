<?php

namespace App\Http\Controllers\Api\userOpration;

use App\Http\Controllers\Controller;
use App\Models\GoldBar;
use Carbon\Carbon;
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
            'error' => false,
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
        if (auth()->user()->role == 'User') {
            //Begin Store
            $data = $request->validate(
                [
                    // الاسم
                    'gold_bar_owner'        => 'required',
                    //وزن السبيكة
                    'gold_ingot_weight'     => 'required|numeric|min:0',
                    // وزن العينة
                    'sample_weight'         => 'required|numeric|min:0',
                    //عيار الذهب
                    'gold_karat_weight'     => 'required|numeric|min:0',
                    //
                    'net'                   => 'numeric|min:0',
                    //تاريخ الاضافة
                    'date_add'              =>'required'
                ]
            );


            $data['net'] =
                ($request->gold_ingot_weight + $request->sample_weight + $request->gold_karat_weight) / 875;


            $goldBarOwner = GoldBar::create($data);

            return response()->json([
                'goldBarOwner' => $goldBarOwner,
                'error' => false,
                'message_en' => '',
                'message_ar' => ''
            ], 200);
            // End Store
        } else {
            return response()->json([
                // 'error' => 'Sorry, Your account is for administration, you can not log in here',
                'error'     => true ,
                'message_en'   => 'Unauthorised ,Sorry, you do not have access to this page ' ,
                'message_ar'   => 'عفوا ، ليس لديك صلاحيات الوصول إلى هذه الصفحة' ,
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //Show Start
         if (auth()->user()->role == 'User') {
            //Begin Show
            $goldBarOwner = GoldBar::find($id);

            return response()->json([
                'goldBarOwner' =>$goldBarOwner,
                'error' => false,
                'message_en' => '',
                'message_ar' => ''
            ], 200);
            // End Show
        } else {
            return response()->json([
                // 'error' => 'Sorry, Your account is for administration, you can not log in here',
                'error'     => true ,
                'message_en'   => 'Unauthorised ,Sorry, you do not have access to this page ' ,
                'message_ar'   => 'عفوا ، ليس لديك صلاحيات الوصول إلى هذه الصفحة' ,
            ], 200);
        }
        //Show End
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
        //Update Start
        if (auth()->user()->role == 'User') {
            //Begin Update
            $goldBarOwner = GoldBar::find($id);
            $data = $request->validate(
                [
                    // الاسم
                    'gold_bar_owner'        => '',
                    //وزن السبيكة
                    'gold_ingot_weight'     => 'numeric|min:0',
                    // وزن العينة
                    'sample_weight'         => 'numeric|min:0',
                    //عيار الذهب
                    'gold_karat_weight'     => 'numeric|min:0',
                    //
                    'net'                   => 'numeric|min:0',
                    //تاريخ الاضافة
                    'date_add'              =>''
                ]
            );


            $data['net'] =
                ($request->gold_ingot_weight + $request->sample_weight + $request->gold_karat_weight) / 875;


            $goldBarOwner->update($data);
            // $goldBarOwner->update($data);


            return response()->json([
                'goldBarOwner' => $goldBarOwner,
                'error' => false,
                'message_en' => '',
                'message_ar' => ''
            ], 200);
            // End Update
        } else {
            return response()->json([
                // 'error' => 'Sorry, Your account is for administration, you can not log in here',
                'error'     => true ,
                'message_en'   => 'Unauthorised ,Sorry, you do not have access to this page ' ,
                'message_ar'   => 'عفوا ، ليس لديك صلاحيات الوصول إلى هذه الصفحة' ,
            ], 200);
        }
        //Update End
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //Remove Start
         if (auth()->user()->role == 'User') {
            //Begin Store
            $goldBarOwner = GoldBar::find($id);

            $goldBarOwner->delete();
            // $goldBarOwner->update($data);


            return response()->json([

                'error' => false,
                'message_en' => 'This item has been deleted successfully',
                'message_ar' => 'تم حذف هذا العنصر بنجاح'
            ], 200);
            // End Store
        } else {
            return response()->json([
                // 'error' => 'Sorry, Your account is for administration, you can not log in here',
                'error'     => true ,
                'message_en'   => 'Unauthorised ,Sorry, you do not have access to this page ' ,
                'message_ar'   => 'عفوا ، ليس لديك صلاحيات الوصول إلى هذه الصفحة' ,
            ], 200);
        }
        //Remove End
    }
}
