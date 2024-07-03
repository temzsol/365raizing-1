<?php

namespace App\Http\Controllers;

use App\Models\vendor;
use App\Models\User;
use App\Models\Brand;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Mail\VendorLoginMail;

use Mail;
use Auth;
use Session;
use Validator;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = vendor::where('vendors.is_deleted', 0)
        ->join('brands', 'vendors.vbrand', '=', 'brands.id')
        ->select('vendors.*', 'brands.bname')
        ->orderBy('vendors.id', 'DESC')
        ->paginate(20);

        return view('admin.vendors.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand=Brand::where('status',1)->where('is_deleted',0)->get();
        return view('admin.vendors.create',compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,vendor $vendor)
    {
        $data=$request->all();
        $data['vcont'] = implode(",", $request->vcont);
        $data['vemail'] = implode(",", $request->vemail);
        $data['vservice'] = implode(",", $request->vservice);
        $vendor->create($data);

        $user = User::create([
            'name' => $request->fname,
            'email' => $request->vemail[0],
            'status' => 1,
            'password' => Hash::make($request->vcont[0]),
            'type' => 'Vendor',
        ]);
        $mailresult=['email'=>$request->vemail[0],'password'=>$request->vcont[0]];
        
        Mail::to($request->vemail[0]) // Use cc or bcc if there are multiple recipients
        ->send(new VendorLoginMail($mailresult));
        return redirect(route('vendor.index'))->with('message','Vendor Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(vendor $vendor)
    {
        $brand=Brand::where('status',1)->where('is_deleted',0)->get();
        return view('admin.vendors.create',compact('brand','vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vendor $vendor)
    {
        $data=$request->all();
        $data['vcont'] = implode(",", $request->vcont);
        $data['vemail'] = implode(",", $request->vemail);
        $data['vservice'] = implode(",", $request->vservice);
        $vendor->update($data);
        return redirect(route('vendor.index'))->with('message','Vendor Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(vendor $vendor)
    {
        if ($vendor->update(['is_deleted' => 1])) {
            $response = array('success' => true, 'error' => false, 'message' => 'Data deleted successfully.');
        } else {
            $response = array('success' => false, 'error' => true, 'message' => 'Something went wrong!');
        }
        return response()->json($response);
    }
}
