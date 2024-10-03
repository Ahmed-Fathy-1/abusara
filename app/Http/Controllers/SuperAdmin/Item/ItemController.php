<?php

namespace App\Http\Controllers\SuperAdmin\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\Item;
use App\Http\Requests\SuperAdmin\Item\StoreRequest;

class ItemController extends Controller
{
    public function index()
    {

        $data = Item::latest()->paginate(5);
        return view("dashboard.Items.index",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view("dashboard.Items.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $data = $request->validated();


        $Item = Item::create($data);
        return redirect()->route("Item.index")->with("success","Created success");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Item = Item::find($id);
        return view("dashboard.Items.show",compact("Item"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Item = Item::find($id);
       return view("dashboard.Items.edit",compact("Item"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {


    $data = $request->validated();

        $Item = Item::find($id);
        $Item->update($data);
        return redirect()->route("Item.index")->with("success","Updated success");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Item = Item::find($id);
        $Item->delete();
        return redirect()->route("Item.index")->with("success","Deleted success");
    }
}
