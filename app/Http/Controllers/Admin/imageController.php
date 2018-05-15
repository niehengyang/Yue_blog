<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class imageController extends Controller
{
    public function getimagelist(Request $request){
        try {
            $perPage = $request->get('limit');
            $page = $request->get('page');
            $title = $request->get('title');
            if ($page > 1 && $title !=null) {
                $articles = Article::where('title','like','%'.$title.'%')->paginate($perPage, '', '', $page);
            } else {
                $articles = Article::where('title','like','%'.$title.'%' )->paginate($perPage);
            }
            if (isEmpty($articles)) {
                return response('数据不存在', 500);
            } else {

                return response($articles, 200);
            }

        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
