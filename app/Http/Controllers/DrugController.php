<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drug;

class DrugController extends Controller
{
    public function index() {
        return response()->view('drugs', [
            'drugs' => Drug::all()
        ]);
    }

    public function find($id) {
        $drug = Drug::findOrFail($id);
        return response()->view('drug', compact('drug'));
    }

    public function createForm() {
        return response()->view('drug_new');
    }

    public function create() {
        $name = request()->input('name');
        $code = request()->input('code');
        $is_active = (request()->input('available'))?:0;

        $drug = new Drug();
        $drug->name = $name;
        $drug->drug_code = $code;
        $drug->is_active = $is_active;
        $drug->save();

        return redirect()->route('drugs.index')->with('info', 'drug added');
    }
}
