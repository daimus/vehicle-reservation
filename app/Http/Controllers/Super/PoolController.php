<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pool;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Branch;
use App\Models\Office;

class PoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $pools = Pool::with(['head', 'admin', 'office'])->get();
        return Inertia::render('Super/Pool/Index', compact('pools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $heads = User::where('role', 'head')->get();
        $admins = User::where('role', 'admin')->get();
        $offices = Office::all();
        return Inertia::render('Super/Pool/Create', compact('heads', 'admins', 'offices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $poolInput = $request->validate([
            'name' => 'required',
            'office_id' => 'required',
            'head_user_id' => 'required',
            'admin_user_id' => 'required'
        ]);

        $pool = new Pool($poolInput);
        $pool->save();

        return redirect('/super/pool')->with('message', 'Pool Berhasil Disimpan');
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
        $heads = User::where('role', 'head')->get();
        $admins = User::where('role', 'admin')->get();
        $pool = Pool::find($id);
        $offices = Office::all();

        return Inertia::render('Super/Pool/Edit', compact('heads', 'admins', 'pool', 'offices'));
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
        $poolInput = $request->validate([
            'name' => 'required',
            'office_id' => 'required',
            'head_user_id' => 'required',
            'admin_user_id' => 'required'
        ]);

        $pool = Pool::find($id);
        $pool->update($poolInput);

        return redirect('/super/pool')->with('message', 'Pool Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Pool::where('id', $id)->delete();
        return redirect('/super/pool')->with('message', 'Pool Berhasil Dihapus');
    }
}
