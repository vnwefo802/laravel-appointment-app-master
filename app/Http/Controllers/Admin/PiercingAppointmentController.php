<?php

namespace App\Http\Controllers\Admin;

use App\Models\PiercingAppointment;
use App\Models\PiercingBodyparts;
use App\Models\PiercingServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PiercingAppointmentRequest;
use Illuminate\Http\Request;
use Session;
use DB;



class PiercingAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $piercing_appointments =  DB::table('piercing_appointments')
                        ->join('piercing_services','piercing_services.id', '=' , 'piercing_appointments.services_id')
                        ->join('piercing_bodyparts','piercing_bodyparts.id', '=' , 'piercing_appointments.piercing_bodyparts_id')
                        ->select('piercing_appointments.*','piercing_services.id','piercing_services.name as serviceName', 'piercing_services.deposit', 'piercing_bodyparts.name as bodypartName' )

                        ->get();


        // $piercing_appointments = PiercingAppointment::all();
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
        // dd($request->all());
        $piercingAppointment = new PiercingAppointment();
        $piercingAppointment->piercing_bodyparts_id  = $request->piercing_id;
        $piercingAppointment->name  = $request->name;
        $piercingAppointment->email  = $request->email;
        $piercingAppointment->phone  = $request->phone;
        $piercingAppointment->start_time  = $request->start_time;
        $piercingAppointment->services_id  = $request->services_piercings;
        $piercingAppointment->save();

        // $piercingAppointment = PiercingAppointment::create($request->validated() + [
        //     'name' => $request->name
        // ]);
        // $piercingAppointment->piercing_services()->sync($request->input('piercing_services', []));

        Session::flash('success', 'Record Inserted');
        return redirect()->back();


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
