<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tattoo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploading;
use App\Http\Requests\Admin\TattooRequest;

class TattooController extends Controller
{
    use MediaUploading;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tattoos = Tattoo::all();

        return view('admin.tattoos.index', compact('tattoos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tattoos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TattooRequest $request)
    {
        $tattoo = Tattoo::create($request->validated() + [
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        if ($request->input('photo', false)) {
            $tattoo->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return redirect()->route('admin.tattoos.index')->with([
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
    public function edit(Tattoo $tattoo)
    {
        return view('admin.tattoos.edit', compact('tattoo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TattooRequest $request,Tattoo $tattoo)
    {
        $tattoo->update($request->validated() + [
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        if ($request->input('photo', false)) {
            if (!$tattoo->photo || $request->input('photo') !== $tattoo->photo->file_name) {
                $tattoo->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($tattoo->photo) {
            $tattoo->photo->delete();
        }

        return redirect()->route('admin.tattoos.index')->with([
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
    public function destroy(Tattoo $tattoo)
    {
        $tattoo->delete();

        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

    /**
     * Delete all selected tattoo at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        Tattoo::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }
}
