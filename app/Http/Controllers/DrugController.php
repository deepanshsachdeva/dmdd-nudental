<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drug;

class DrugController extends Controller
{
    public function index() {
        return response()->json(Drug::all());
    }

    public function find($id) {
        $drug = Drug::findOrFail($id);
        return response()->view('drug', compact('drug'));
    }
}
