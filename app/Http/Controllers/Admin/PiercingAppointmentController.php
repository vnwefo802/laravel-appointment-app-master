<?php

namespace App\Http\Controllers\Admin;

use App\Models\PiercingAppointment;
use App\Models\PiercingBodyparts;
use App\Models\PiercingServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PiercingAppointmentRequest;
use Illuminate\Http\Request;

class PiercingAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $piercing_appointments = PiercingAppointment::all();

        return view('admin.piercing appointments.index', compact('piercing_appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $piercing_bodyparts = PiercingBodyparts::all()->pluck('name', 'id');
        $piercing_services = PiercingServices::all()->pluck('name', 'id');
        return view('admin.piercing appointments.create', compact('piercing_services','piercing_bodyparts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PiercingAppointmentRequest $request)
    {
        $piercingAppointment = PiercingAppointment::create($request->validated() + [
            'name' => $request->name
        ]);
        $piercingAppointment->piercing_services()->sync($request->input('piercing_services', []));

        return redirect()->route('admin.piercing appointments.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PiercingAppointment  $piercingAppointment
     * @return \Illuminate\Http\Response
     */
    public function show(PiercingAppointment $piercingAppointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PiercingAppointment  $piercingAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(PiercingAppointment $piercingAppointment)
    {
        $piercing_bodyparts = PiercingBodyparts::all()->pluck('name', 'id');
        $piercing_services = PiercingServices::all()->pluck('name', 'id');
        return view('admin.piercing appointments.edit', compact('piercing_services','piercing_bodyparts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PiercingAppointment  $piercingAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(PiercingAppointmentRequest $request, PiercingAppointment $piercingAppointment)
    {
        $piercingAppointment = PiercingAppointment::create($request->validated() + [
            'name' => $request->name
        ]);
        $piercingAppointment->piercing_services()->sync($request->input('piercing_services', []));

        return redirect()->route('admin.piercing appointments.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PiercingAppointment  $piercingAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PiercingAppointment $piercingAppointment)
    {
        $piercingAppointment->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function massDestroy(Request $request)
    {
        PiercingAppointment::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
