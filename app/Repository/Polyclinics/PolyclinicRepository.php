<?php
namespace App\Repository\Polyclinics;

use App\Interfaces\Polyclinics\PolyclinicRepositoryInterface;
use App\Models\Doctor;
use App\Models\Polyclinic;

class PolyclinicRepository implements PolyclinicRepositoryInterface
{

    public function index()
    {
      $polyclinics = Polyclinic::all();
      return view('Dashboard.Polyclinics.index',compact('polyclinics'));
    }

    public function store($request)
    {
        Polyclinic::create([
            'name' => $request->input('name'),
        ]);

        session()->flash('add');
        return redirect()->route('Polyclinics.index');
    }

    public function update($request)
    {
        $polyclinic = Polyclinic::findOrFail($request->id);
        $polyclinic->update([
            'name' => $request->input('name'),
        ]);
        session()->flash('edit');
        return redirect()->route('Polyclinics.index');
    }


    public function destroy($request)
    {
        Polyclinic::findOrFail($request->id)->delete();
        session()->flash('delete');
        return redirect()->route('Polyclinics.index');
    }

    public function show($id)
    {
        $doctors = Polyclinic::findOrFail($id)->doctors;
        $polyclinic = Polyclinic::findOrFail($id);
        return view('Dashboard.Polyclinics.show_doctors',compact('doctors','polyclinic'));
    }

}
