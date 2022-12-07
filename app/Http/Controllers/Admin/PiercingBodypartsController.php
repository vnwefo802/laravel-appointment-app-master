<?php

namespace App\Http\Controllers\Admin;

use App\Models\PiercingBodyparts;
use App\Models\PiercingServices;
use App\Http\Requests\Admin\PiercingBodyPartRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PiercingBodypartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $piercing_bodyparts = PiercingBodyparts::all();

        return view('admin.bodypart_piercings.index', compact('piercing_bodyparts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $piercing_services = PiercingServices::all()->pluck('name', 'id');

        return view('admin.bodypart_piercings.create', compact('piercing_services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PiercingBodyPartRequest $request)
    {
        $piercingBodyparts = PiercingBodyparts::create($request->validated() + [
            'name' => $request->name,
        ]);
    $piercingBodyparts->piercing_services()->sync($request->input('piercing_services', []));

    return redirect()->route('admin.bodypart_piercings.index')->with([
        'message' => 'successfully created !',
        'alert-type' => 'success'
    ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PiercingBodyparts  $piercingBodyparts
     * @return \Illuminate\Http\Response
     */
    public function show(PiercingBodyparts $piercingBodyparts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PiercingBodyparts  $piercingBodyparts
     * @return \Illuminate\Http\Response
     */
    public function edit(PiercingBodyparts $piercingBodyparts)
    {
        $piercing_services = PiercingServices::all()->pluck('name', 'id');

        $piercingBodyparts->load('piercing_services');

        return view('admin.bodypart_piercings.edit', compact('piercing_services', 'piercingBodyparts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PiercingBodyparts  $piercingBodyparts
     * @return \Illuminate\Http\Response
     */
    public function update(PiercingBodyPartRequest $request, PiercingBodyparts $piercingBodyparts)
    {
        $piercingBodyparts->update($request->validated() + [
            'name' => $request->name,
        ]);

        $piercingBodyparts->piercing_services()->sync($request->input('piercing_services', []));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PiercingBodyparts  $piercingBodyparts
     * @return \Illuminate\Http\Response
     */
    public function destroy(PiercingBodyparts $piercingBodyparts)
    {
        $piercingBodyparts->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy(Request $request)
    {
        PiercingBodyparts::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
