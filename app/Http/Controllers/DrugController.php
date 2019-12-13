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
            'name'   => 'required|max:255',
            'code'   => 'required|max:3|unique:drug,drug_code',
            'active' => 'boolean'
        ]);

        $name = request()->input('name');
        $code = request()->input('code');
        $is_active = (request()->input('active'))?true:false;
        $user_id = auth()->user()->user_id;

        $drug = new Drug();
        $drug->name = $name;
        $drug->drug_code = $code;
        $drug->is_active = $is_active;
        $drug->created_by = $user_id;
        $drug->save();

        return redirect()->route('drugs.index');
    }

    public function editForm(Drug $drug) {
        return response()->view('drugs.show', compact('drug'));
    }

    public function edit(Drug $drug) {
        $validatedData = request()->validate([
            'name'   => 'required|max:255',
            'code'   => 'required|max:3|unique:drug,drug_code,'.$drug->drug_id.',drug_id',
            'active' => 'boolean'
        ]);

        $name = request()->input('name');
        $code = request()->input('code');
        $is_active = (request()->input('active'))? true : false;
        $user_id = auth()->user()->user_id;
        
        if ($drug->name != $name) {
            $drug->name = $name;
        }

        if ($drug->drug_code != $code) {
            $drug->drug_code = $code;
        }
        
        if ($drug->is_active != $is_active) {
            $drug->is_active = $is_active;
        }

        $drug->updated_by = $user_id;
        $drug->save();

        return redirect()->route('drugs.index');
    }
}
