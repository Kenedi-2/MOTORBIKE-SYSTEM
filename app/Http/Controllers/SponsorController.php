<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::all();
        return view('sponsors.index', compact('sponsors'));
    }

    public function create()
    {
        return view('sponsors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
        ]);

        Sponsor::create($request->all());
        return redirect()->route('sponsors.index')->with('success','Sponsor added');
    }

        public function edit($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        return view('sponsors.edit', compact('sponsor'));
    }

    public function update(Request $request, $id)
    {
        $sponsor = Sponsor::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $sponsor->update($request->all());

        return redirect()->route('sponsors.index')->with('success', 'Sponsor updated successfully.');
    }
    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();
        return back()->with('success','Sponsor deleted');
    }
}