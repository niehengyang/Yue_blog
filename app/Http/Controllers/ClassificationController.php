<?php

namespace App\Http\Controllers;

use App\Model\classification;
use App\Model\Article;
use Illuminate\Http\Request;

class ClassificationController extends Controller
{
    public function index(){
        $classifications = classification::all();
        return view('category',['classifications' =>$classifications]);
    }
}
