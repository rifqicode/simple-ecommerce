<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use App\Http\Requests\User\UserPostRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = "
                        <div class='row p-3'>
                            <a href='" . route('users.show', $row->id) . "' class='btn btn-primary btn-sm col-md-4'> View </a>
                            <a href='" . route('users.edit', $row->id) . "' class='btn btn-success btn-sm col-md-4'> Edit </a>

                            <form method='POST' action='" . route('users.destroy', $row->id) . "' class='col-md-4'>
                                <div class='row'>
                                    " . csrf_field() . "

                                    <input type='hidden' name='_method' value='DELETE'>
                                    <button type='submit' class='btn btn-danger btn-sm col-md-12'>Delete</button>
                                </div>
                            </form>
                        </div>
                    ";

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create-or-update');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserPostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('users.index')
            ->with('success', 'Data Added Successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.view', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrfail($id);
        return view('admin.users.create-or-update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);


        $password = '';
        if ($request->get('password')) {
            $request->validate([
                'password' => 'required|confirmed|min:8'
            ]);

            $password = bcrypt($request->get('password'));
        }

        $data = $request->only(['name', 'email', 'role']);
        $data = array_merge($data, ['password' => $password]);

        User::where('id', $id)->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Data Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')
            ->with('success', 'Data Delete Successfully');
    }
}
