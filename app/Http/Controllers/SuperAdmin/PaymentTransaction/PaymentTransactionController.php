<?php

namespace App\Http\Controllers\SuperAdmin\PaymentTransaction;

use App\Models\SuperAdmin\Package;
use App\Traits\Imageable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\PaymentTransaction;
use App\Http\Requests\SuperAdmin\PaymentTransaction\StoreRequest;

class PaymentTransactionController extends Controller
{
    use Imageable;
    public function index()
    {

        $data = PaymentTransaction::latest()->paginate(5);
        return view("dashboard.PaymentTransactions.index",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::all();

          return view("dashboard.PaymentTransactions.add" ,compact("packages"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {


        $data = $request->validated();
        if (isset($data['image']) && $data['image'] != null) {
            $data['image'] = $this->setImageAttribute($data['image']);
        }
        $data['user_id'] = auth()->user()->id;
        $PaymentTransaction = PaymentTransaction::create($data);
        return redirect()->route("PaymentTransaction.index")->with("success","Created success");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $PaymentTransaction = PaymentTransaction::find($id);
        $packages = Package::all();
       return view("dashboard.PaymentTransactions.show",compact("PaymentTransaction","packages"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $PaymentTransaction = PaymentTransaction::find($id);
        $packages = Package::all();
       return view("dashboard.PaymentTransactions.edit",compact("PaymentTransaction","packages"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {

        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $PaymentTransaction = PaymentTransaction::find($id);
        if (isset($data['image']) && $data['image'] != null) {
            $data['image'] = $this->setImageAttribute($data['image'], $PaymentTransaction->image);
        }
        $PaymentTransaction->update($data);
        return redirect()->route("PaymentTransaction.index")->with("success","Updated success");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $PaymentTransaction = PaymentTransaction::find($id);
        $PaymentTransaction->delete();
        return redirect()->route("PaymentTransaction.index")->with("success","Deleted success");
    }
}
