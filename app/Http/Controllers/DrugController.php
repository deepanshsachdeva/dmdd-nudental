<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drug;

class DrugController extends Controller
{
    public function index() {
        return response()->view('drugs.index', [
            'drugs' => Drug::all()
        ]);
    }

    public function find($id) {
        $drug = Drug::findOrFail($id);
        return response()->view('drugs.show', compact('drug'));
    }

    public function createForm() {
        return response()->view('drugs.new');
    }

    public function create() {
        $validatedData = request()->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:3',
        ]);

        $name = request()->input('name');
        $code = request()->input('code');
        $is_active = (request()->input('available'))?true:false;

        $drug = new Drug();
        $drug->name = $name;
        $drug->drug_code = $code;
        $drug->is_active = $is_active;
        $drug->save();

        return redirect()->route('drugs.index')->with('info', 'drug added');
    }
}
