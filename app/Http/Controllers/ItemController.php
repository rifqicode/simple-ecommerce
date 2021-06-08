<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use App\Models\{
    Item,
    Category
};
use App\Http\Requests\Item\ItemPostRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = item::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image_show', function ($row) {
                    $url = asset("$row->image");
                    return '<img src=' . $url . ' border="0" width="40" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($row) {
                    $button = "
                        <div class='row p-3'>
                            <a href='" . route('item.show', $row->id) . "' class='btn btn-primary btn-sm col-md-4'> View </a>
                            <a href='" . route('item.edit', $row->id) . "' class='btn btn-success btn-sm col-md-4'> Edit </a>

                            <form method='POST' action='" . route('item.destroy', $row->id) . "' class='col-md-4'>
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
                ->rawColumns(['action', 'image_show'])
                ->make(true);
        }

        return view('admin.item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.item.create-or-update', [
            'category' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemPostRequest $request)
    {
        $data = $request->validated();
        $file = $request->file('image');
        $file->move('item', $file->getClientOriginalName());

        $data['image'] = 'item' . '/' . $file->getClientOriginalName();

        Item::create($data);
        return redirect()->route('item.index')->with('success', 'Data Delete Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.item.view', [
            'item' => Item::findOrFail($id)
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
        return view('admin.item.create-or-update', [
            'item' => Item::findOrFail($id),
            'category' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemPostRequest $request, $id)
    {
        $data = $request->validated();
        $file = $request->file('image');
        $file->move('item', $file->getClientOriginalName());

        $data['image'] = 'item' . '/' . $file->getClientOriginalName();

        Item::where('id', $id)->update($data);
        return redirect()->route('item.index')->with('success', 'Data Delete Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);
        return redirect()->route('item.index')->with('success', 'Data Delete Successfully');
    }
}
