<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AppointmentController extends Controller
{
    public function index() {
        return response()->view('appointments.index');
    }

    public function createForm() {
        return response()->view('appointments.new');
    }

}


