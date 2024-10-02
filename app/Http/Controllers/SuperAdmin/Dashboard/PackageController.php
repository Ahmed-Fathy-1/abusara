<?php

namespace App\Http\Controllers\SuperAdmin\Dashboard;

use Illuminate\Http\Request;
use App\Models\SuperAdmin\Package;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Package\StoreRequest;

class PackageController extends Controller
{
    public function index()
    {

        $data = Package::all();
        return view("dashboard.packages.index",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          return view("dashboard.packages.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $data = $request->validated();

        // $data['user_id'] = '1';
        $Package = Package::create($data);
        return redirect()->route("packages.index")->with("success","Created success");
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
       return view("dashboard.packages.edit",compact("Package"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {


    $data = $request->validated();
       $data['user_id'] = '1';
        $Package = Package::find($id);
        $Package->update($data);
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
