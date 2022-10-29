<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Office;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $offices = Office::with('officer')->get();
        return Inertia::render('Super/Office/Index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $users = User::where('role', 'officer')->get();
        return Inertia::render('Super/Office/Create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $officeInput = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'user_id' => 'required'
        ]);

        $office = new Office($officeInput);
        $office->save();

        return redirect('/super/office')->with('message', 'Kantor Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $office = Office::find($id);
        $users = User::where('role', 'officer')->get();

        return Inertia::render('Super/Office/Edit', compact('office', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $officeInput = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'user_id' => 'required'
        ]);

        $office = Office::find($id);
        $office->update($officeInput);

        return redirect('/super/office')->with('message', 'Kantor Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Office::where('id', $id)->delete();
        return redirect('/super/office')->with('message', 'Kantor Berhasil Dihapus');
    }
}
