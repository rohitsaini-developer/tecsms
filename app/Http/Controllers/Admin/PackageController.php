<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PackagesDataTable;
use App\Http\Requests\Package\StoreRequest;
use App\Http\Requests\Package\UpdateRequest;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PackagesDataTable $dataTable)
    {
        abort_if(Gate::denies('package-browse'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $dataTable->render('admin.package.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('package-add'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        abort_if(Gate::denies('package-store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $package = Package::create($request->all());

        if($package){
            return to_route('admin.packages.index')->with('success', 'Package added successfully!');
        }else{
            return back()->with('error', 'Something went wrong! Try after some time.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        abort_if(Gate::denies('package-view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.package.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        abort_if(Gate::denies('package-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Package $package)
    {
        abort_if(Gate::denies('package-update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $package->update($request->all());

        if($package){
            return to_route('admin.packages.index')->with('success', 'Package Updated successfully!');
        }else{
            return back()->with('error', 'Something went wrong! Try after some time.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Package $package)
    {
        if($request->ajax()){
            $package->delete();
            return response()->json([ 'success' => true, 'message'=>'Package deleted successfully!']);
        }
    }
}
