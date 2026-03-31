<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motorbike;

class MotorbikeController extends Controller
{
    public function index()
    {
        $motorbikes = Motorbike::paginate(10);
        return view('motorbikes.index', compact('motorbikes'));
    }

    public function create()
    {
        return view('motorbikes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => 'required|unique:motorbikes',
            'model' => 'required|string|max:255',
            'engine_number' => 'required|unique:motorbikes',
            'status' => 'nullable|in:available,contracted,own', // default to available if null
        ]);

        $data = $request->all();
        if (!isset($data['status'])) {
            $data['status'] = 'available';
        }

        Motorbike::create($data);

        return redirect()->route('motorbikes.index')->with('success','Motorbike added successfully.');
    }

    public function edit($id)
    {
        $motorbike = Motorbike::findOrFail($id);
        return view('motorbikes.edit', compact('motorbike'));
    }

    public function update(Request $request, $id)
    {
        $motorbike = Motorbike::findOrFail($id);

        $request->validate([
            'plate_number' => "required|unique:motorbikes,plate_number,{$motorbike->id}",
            'model' => 'required|string|max:255',
            'engine_number' => "required|unique:motorbikes,engine_number,{$motorbike->id}",
            'status' => 'required|in:available,contracted,own',
        ]);

        $motorbike->update($request->all());

        return redirect()->route('motorbikes.index')->with('success','Motorbike updated successfully.');
    }

    public function destroy(Motorbike $motorbike)
    {
        $motorbike->delete();
        return back()->with('success','Motorbike deleted successfully.');
    }
}