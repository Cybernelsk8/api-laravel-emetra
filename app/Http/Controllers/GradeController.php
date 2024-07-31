<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index() {

        try {
            $grades = Grade::with(['student','subject'])->get();
            return response($grades);
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }

    public function store(Request $request) {
        
        $grade = $request->validate([
            'user_id' => 'required',
            'subject_id' => 'required',
            'score' => 'required|numeric',
        ]);

        try {

            Grade::create($grade);

            return response('Registro creado exitosamente');

        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }
    
    public function update($id, Request $request) {
        
        $request->validate([
            'subject_id' => 'required',
            'score' => 'required|numeric',
        ]);

        try {

            $grade = Grade::findOrFail($id)->update([
                'subject_id' => $request->subject_id,
                'score' => $request->score,
            ]);

            return response('Registro actualizado exitosamente');

        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }

    public function destroy($id) {
        try {

            $grade = Grade::findOrFail($id);
            $grade->delete();

            return response('Registro eliminado exitosamente');

        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }

    public function students() {
        try {
            $students = User::where('state',1)->get();
            return response($students);
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }
}
