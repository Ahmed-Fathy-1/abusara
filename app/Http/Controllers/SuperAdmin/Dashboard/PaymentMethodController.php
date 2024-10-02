<?php

namespace App\Http\Controllers\SuperAdmin\Dashboard;

use Illuminate\Http\Request;
use App\Models\SuperAdmin\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\PaymentMethod\StoreRequest;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = PaymentMethod::all();
        return view("dashboard.paymentMethods.index",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view("dashboard.paymentMethods.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $data = $request->validated();
        if(isset($data['image']))
        {
             $request->image;
        }
        $data['user_id'] = '1';
        $paymentMethod = PaymentMethod::create($request->all());
        return redirect()->route("PaymentMethod.index")->with("success","Created success");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paymentMethod = PaymentMethod::find($id);
       return view("dashboard.paymentMethods.edit",compact("paymentMethod"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        if($request->image)
        {
            $request->image;
        }
        $request->user_id = '1';
        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->update($request->all());
        return redirect()->route("PaymentMethod.index")->with("success","Updated success");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->delete();
        return redirect()->route("PaymentMethod.index")->with("success","Deleted success");
    }
}
