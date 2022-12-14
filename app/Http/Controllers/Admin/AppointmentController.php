<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tattoo;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppointmentRequest;


class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::all();

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tattoos = Tattoo::all()->pluck('name', 'id');
        $services = Service::all()->pluck('name', 'id');

        return view('admin.appointments.create', compact('tattoos','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {
        $appointment = Appointment::create($request->validated() + [
            'description' => $request->description
        ]);
        $appointment->services()->sync($request->input('services', []));

        return redirect()->route('admin.appointments.index')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $tattoos = Tattoo::all()->pluck('name', 'id');
        $services = Service::all()->pluck('name', 'id');

        return view('admin.appointments.edit', compact('appointment', 'tattoos', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentRequest $request,Appointment $appointment)
    {
        $appointment->update($request->validated() + [
            'description' => $request->description
        ]);
        $appointment->services()->sync($request->input('services', []));

        return redirect()->route('admin.appointments.index')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

     /**
     * Delete all selected Appoinment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        Appointment::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
