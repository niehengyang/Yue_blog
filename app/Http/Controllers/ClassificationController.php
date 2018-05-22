<?php

namespace App\Http\Controllers;

use App\Model\classification;
use Illuminate\Http\Request;

class ClassificationController extends Controller
{
    public function index(){
        $classifications = classification::all();
        return view('classificationlist',['classifications' =>$classifications]);
    }
}
