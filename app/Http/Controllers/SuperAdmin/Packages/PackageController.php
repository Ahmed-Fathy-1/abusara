<?php

namespace App\Http\Controllers\SuperAdmin\Packages;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\SuperAdmin\Item;
use App\Models\SuperAdmin\Package;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\PackageItem;
use App\Http\Requests\SuperAdmin\Package\StoreRequest;

class PackageController extends Controller
{
    public function index()
    {

        $data = Package::latest()->paginate(5);
        return view("dashboard.packages.index",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
           return view("dashboard.packages.add" ,compact("items"));
    }



    public function store(StoreRequest $request)
    {
    $data = $request->validated();
    $data['user_id'] = auth()->user()->id;

    $package = Package::create($data);


    if (isset($request->item_id) && is_array($request->item_id)) {
         $package->items()->syncWithoutDetaching($request->item_id);
    }

    return redirect()->route("packages.index")->with("success", "Created successfully");
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
        $Package = Package::find($id);
        $items = Item::all();
       return view("dashboard.packages.edit",compact("Package",'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {


        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $Package = Package::find($id);
        $Package->update($data);
        if ($request->item_id && is_array($request->item_id)) {
            $Package->items()->sync($request->item_id);
        }
        return redirect()->route("packages.index")->with("success","Updated success");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Package = Package::find($id);
        $Package->delete();
        return redirect()->route("packages.index")->with("success","Deleted success");
    }
}
