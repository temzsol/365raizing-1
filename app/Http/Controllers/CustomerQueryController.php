<?php

namespace App\Http\Controllers;

use App\Models\Customer_query;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Company;
use App\Mail\MailMytask;
use Mail;
use Auth;
use Session;
use Validator;

class CustomerQueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer_query::where('is_deleted',0)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.customer-query.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand=Brand::where('status',1)->where('is_deleted',0)->get();
        return view('admin.customer-query.create',compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Customer_query $customer_query)
    {
        $data=$request->all();
        $data['query_date']=date('Y-m-d');
        $data['created_by']= Auth::user()->name;
        $customer_query->create($data);

        return redirect(route('customer-query.index'))->with('message','Query Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer_query  $customer_query
     * @return \Illuminate\Http\Response
     */
    public function show(Customer_query $customer_query)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer_query  $customer_query
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer_query $customer_query)
    {
        $brand=Brand::where('status',1)->where('is_deleted',0)->get();
        return view('admin.customer-query.create',compact('customer_query','brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer_query  $customer_query
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer_query $customer_query)
    {
        $data=$request->all();
        $data['query_date']=date('Y-m-d');
        $data['created_by']= Auth::user()->name;
        $customer_query->update($data);
        return redirect(route('customer-query.index'))->with('message','Query updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer_query  $customer_query
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer_query $customer_query)
    {
        if($customer_query->update(['is_deleted'=>1]))
        {
            $response = array('success' => true, 'error' => false, 'message' => 'Data Delete successfully..');
        }
    else{
        $response = array('success' => false, 'error' => true, 'message' => 'Something Went Wrong !');
            }
    return $response;
    }
}
