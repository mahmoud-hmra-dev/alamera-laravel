<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use Illuminate\Http\Request;

class DepotController extends Controller
{
    public function index()
    {
        $depots = Depot::latest()->paginate(200);
        return view('depots.index',compact('depots'))->with('i', (request()->input('page', 1) - 1) * 200);
    }

    public function create()
    {
        
        return view('depots.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_qty' => 'required',
        ]);

        Depot::create($request->all());
        return redirect()->route('depots.create')->with('success','Successfully.');
    }

    public function show(Depot $depot)
    {
        return view('depots.show',compact('depot'));
    }


    public function edit(Depot $depot)
    {
        return view('depots.edit',compact('depot'));
    }

    public function update(Request $request, Depot $depot)
    {
        $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_qty' => 'required',
        ]);

        $depot->update($request->all());
        return redirect()->route('depots.index')->with('success',' Successfully.');
    }


    public function destroy(Depot $depot)
    {
        $depot->delete();
        return redirect()->route('depots.index')->with('success',' deleted successfully.');
    }
}
