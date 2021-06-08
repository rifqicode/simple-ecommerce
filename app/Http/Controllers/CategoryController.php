<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;
use App\Http\Requests\Category\CategoryPostRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = "
                        <div class='row p-3'>
                            <a href='" . route('category.show', $row->id) . "' class='btn btn-primary btn-sm col-md-4'> View </a>
                            <a href='" . route('category.edit', $row->id) . "' class='btn btn-success btn-sm col-md-4'> Edit </a>

                            <form method='POST' action='" . route('category.destroy', $row->id) . "' class='col-md-4'>
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

        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create-or-update');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryPostRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('category.index')
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
        return view('admin.category.view', [
            'category' => Category::findOrFail($id)
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
        $category = Category::findOrfail($id);
        return view('admin.category.create-or-update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryPostRequest $request, $id)
    {
        Category::where('id', $id)->update($request->validated());
        return redirect()->route('category.index')
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
        Category::destroy($id);
        return redirect()->route('category.index')
            ->with('success', 'Data Delete Successfully');
    }
}
