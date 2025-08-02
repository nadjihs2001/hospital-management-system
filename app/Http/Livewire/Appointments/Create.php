<?php

namespace App\Http\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Polyclinic;
use Livewire\Component;

class Create extends Component
{
    public $doctors;
    public $polyclinics;
    public $doctor;
    public $polyclinic;
    public $name;
    public $email;
    public $phone;
    public $notes;
    public $message= false;

    public function mount(){

      $this->polyclinics = Polyclinic::get();
      $this->doctors = collect();

    }

    public function render()
    {
        return view('livewire.appointments.create',
            [
                'polyclinics' => Polyclinic::get()
            ]);
    }

    public function updatedPolyclinic($polyclinic_id){

       $this->doctors = Doctor::where('polyclinic_id',$polyclinic_id)->get();
    }

    public function store(){

        $appointments = new Appointment();
        $appointments->doctor_id = $this->doctor;
        $appointments->polyclinic_id = $this->polyclinic;
        $appointments->name = $this->name;
        $appointments->email = $this->email;
        $appointments->phone = $this->phone;
        $appointments->notes = $this->notes;
        $appointments->save();
        $this->message =true;

    }



}
