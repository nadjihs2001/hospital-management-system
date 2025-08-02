<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Polyclinics\PolyclinicRepositoryInterface;
use Illuminate\Http\Request;

class PolyclinicController extends Controller
{

    private $Polyclinics;

    public function __construct(PolyclinicRepositoryInterface $Polyclinics)
    {
        $this->Polyclinics = $Polyclinics;
    }

    public function index()
    {
      return  $this->Polyclinics->index();

    }

    public function show($id)
    {
       return $this->Polyclinics->show($id);
    }


    public function store(Request $request)
    {
        return $this->Polyclinics->store($request);
    }


    public function update(Request $request)
    {
        return $this->Polyclinics->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->Polyclinics->destroy($request);
    }
}
