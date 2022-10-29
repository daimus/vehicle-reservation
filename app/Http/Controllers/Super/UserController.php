<?php

    namespace App\Http\Controllers\Super;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\User;
    use Inertia\Inertia;
    use Illuminate\Support\Str;

    class UserController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Inertia\Response
         */
        public function index()
        {
            $users = User::all();
            return Inertia::render('Super/User/Index', compact('users'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Inertia\Response
         */
        public function create()
        {
            return Inertia::render('Super/User/Create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function store(Request $request)
        {
            $requestInput = $request->validate([
                'name'     => 'required',
                'email'    => 'required',
                'password' => 'required',
                'role'     => 'required',
            ]);

            $requestInput['email_verified_at'] = now();
            $requestInput['remember_token'] = Str::random(10);

            $user = new User($requestInput);
            $user->save();

            return redirect('/super/user')->with('message', 'User Berhasil Disimpan');
        }

        /**
         * Display the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         * @return \Inertia\Response
         */
        public function edit($id)
        {
            $user = User::find($id);
            return Inertia::render('Super/User/Edit', compact('user'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function update(Request $request, $id)
        {
            $requestInput = $request->validate([
                'name'     => 'required',
                'email'    => 'required',
                'password' => 'nullable',
                'role'     => 'required',
            ]);

            $user = User::find($id);
            $user->update($requestInput);

            return redirect('/super/user')->with('message', 'User Berhasil Diperbarui');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function destroy($id)
        {
            User::where('id', $id)->delete();
            return redirect('/super/user')->with('message', 'User Berhasil Dihapus');
        }
    }
