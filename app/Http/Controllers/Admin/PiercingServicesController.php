<?php

namespace App\Http\Controllers\Admin;

use App\Models\PiercingServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServicesPiercingRequest;
use Illuminate\Http\Request;

class PiercingServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $piercing_services = PiercingServices::all();

        return view('admin.services_piercings.index', compact('piercing_services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services_piercings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicesPiercingRequest $request)
    {
        PiercingServices::create($request->validated() + ['deposit' => $request->deposit]);

        return redirect()->route('admin.services_piercings.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PiercingServices  $piercingServices
     * @return \Illuminate\Http\Response
     */
    public function show(PiercingServices $piercingServices)
    {
        return view('admin.services_piercings.show', compact('piercing_services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PiercingServices  $piercingServices
     * @return \Illuminate\Http\Response
     */
    public function edit(PiercingServices $piercingServices)
    {
        return view('admin.services_piercings.edit', compact('piercing_services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PiercingServices  $piercingServices
     * @return \Illuminate\Http\Response
     */
    public function update(ServicesPiercingRequest $request, PiercingServices $piercingServices)
    {
        $piercingServices->update($request->validated() + ['deposit' => $request->deposit]);

        return redirect()->route('admin.services_piercings.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PiercingServices  $piercingServices
     * @return \Illuminate\Http\Response
     */
    public function destroy(PiercingServices $piercingServices)
    {
        $piercingServices->delete();

        return redirect()->back()->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function massDestroy(Request $request)
    {
        PiercingServices::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
