<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Company;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Brand::where('is_deleted',0)->orderBy('id', 'DESC')->paginate(20);
        return view('admin.brands.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company=Company::where('status',1)->where('is_deleted',0)->get();
        return view('admin.brands.create',compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Brand $brand)
    {
        $data=$request->all();
        $data['bdivision'] = implode(",", $request->bdivision);
        $data['div_mail'] = implode(",",$request->div_mail);
        $data['div_mob'] = implode(",",$request->div_mob);
	    $data['bemail'] = implode(",",$request->bemail);
        $data['bmob']= implode(",",$request->bmob);
        $brand->create($data);
        return redirect(route('brands.index'))->with('message','Brand Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $company=Company::where('status',1)->where('is_deleted',0)->get();
        return view('admin.brands.create',compact('brand','company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $data=$request->all();
        $data['bdivision'] = implode(",", $request->bdivision);
        $data['div_mail'] = implode(",",$request->div_mail);
        $data['div_mob'] = implode(",",$request->div_mob);
	    $data['bemail'] = implode(",",$request->bemail);
        $data['bmob']= implode(",",$request->bmob);
        $brand->update($data);
        return redirect(route('brands.index'))->with('message','Brand updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if($brand->update(['is_deleted'=>1]))
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
         }
    return $response;
    }
}
