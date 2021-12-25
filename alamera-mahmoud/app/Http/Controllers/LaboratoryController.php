<?php

namespace App\Http\Controllers;

use App\Models\laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function index()
    {
        $laboratorys = Laboratory::latest()->paginate(200);
        return view('laboratorys.index',compact('laboratorys'))->with('i', (request()->input('page', 1) - 1) * 200);
    }

    public function create()
    {
        return view('laboratorys.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_qty' => 'required',
        ]);

        Laboratory::create($request->all());
        return redirect()->route('laboratorys.create')->with('success','Successfully.');
    }

    public function show(Laboratory $laboratory)
    {
        return view('laboratorys.show',compact('laboratory'));
    }


    public function edit(Laboratory $laboratory)
    {
        return view('laboratorys.edit',compact('laboratory'));
    }

    public function update(Request $request, Laboratory $laboratory)
    {
        $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_qty' => 'required',
        ]);

        $laboratory->update($request->all());
        return redirect()->route('laboratorys.index')->with('success',' Successfully.');
    }


    public function destroy(Laboratory $laboratory)
    {
        $laboratory->delete();
        return redirect()->route('laboratorys.index')->with('success',' deleted successfully.');
    }
}
