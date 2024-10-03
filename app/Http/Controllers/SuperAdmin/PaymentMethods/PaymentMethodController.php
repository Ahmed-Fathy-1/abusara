<?php

namespace App\Http\Controllers\SuperAdmin\PaymentMethods;

use App\Traits\Imageable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\PaymentMethod;
use App\Http\Requests\SuperAdmin\PaymentMethod\StoreRequest;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Imageable;
    public function index()
    {

        $data = PaymentMethod::latest()->paginate(5);
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
        if ($data['image'] && $data['image'] != null) {
            $data['image'] = $this->setImageAttribute($data['image']);
        }
        $data['user_id'] = auth()->user()->id;
        $paymentMethod = PaymentMethod::create($data);
        return redirect()->route("PaymentMethod.index")->with("success","Created success");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paymentMethod = PaymentMethod::find($id);
        return view("dashboard.paymentMethods.show",compact("paymentMethod"));
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
    public function update(StoreRequest $request, string $id)
    {


        // if($request->image)
        // {
        //     $request->image;
        // }
        // $request->user_id = '1';

        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;
        $paymentMethod = PaymentMethod::find($id);
        if ($data['image'] && $data['image'] != null) {
            $data['image'] = $this->setImageAttribute($data['image'], $paymentMethod->image);
        }
        $paymentMethod->update($data);
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
