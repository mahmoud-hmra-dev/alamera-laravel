<?php

namespace App\Http\Controllers;

use App\Models\Cru;
use Illuminate\Http\Request;

class CruController extends Controller
{
    public function index()
    {
        $crus = CRU::latest()->paginate(200);
        return view('crus.index',compact('crus'))->with('i', (request()->input('page', 1) - 1) * 200);
    }

    public function create()
    {
        return view('crus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_qty' => 'required',
        ]);

        Cru::create($request->all());
        return redirect()->route('crus.create')->with('success','Successfully.');
    }

    public function show(Cru $cru)
    {
        return view('crus.show',compact('cru'));
    }


    public function edit(Cru $cru)
    {
        return view('crus.edit',compact('cru'));
    }

    public function update(Request $request, Cru $cru)
    {
        $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_qty' => 'required',
        ]);

        $cru->update($request->all());
        return redirect()->route('crus.index')->with('success',' Successfully.');
    }


    public function destroy(Cru $cru)
    {
        $cru->delete();
        return redirect()->route('crus.index')->with('success',' deleted successfully.');
    }
}
