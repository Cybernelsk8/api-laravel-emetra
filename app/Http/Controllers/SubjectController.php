<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index() {
        try {
            $subjects = Subject::all();
            return response($subjects);
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }
}
