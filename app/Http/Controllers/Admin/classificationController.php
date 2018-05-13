<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use App\Model\classification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class classificationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $info = classification::all();
            if (is_null($info)) {
                throw new Exception('信息提取失败');
            }
            return response($info, 200);

        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            if (is_null($request->get('id'))) {
                $name = $request->get('name');
                if(classification::where('name',$name)->count() == 0){
                    $classification = new classification;
                    $classification->name = $request->get('name');
                    $classification->describe = $request->get('describe');
                    if ($classification->save()) {
                        return response('添加成功', 200);
                    } else {
                        throw new Exception('添加失败');
                    }
                }else{
                    throw new Exception('该分类已存在，请勿重复创建');
                }

            } else {
                $id = $request->get('id');
                $infodata = classification::find($id);
                if (is_null($infodata)) {
                    throw new Exception('该分类信息不存在');
                }
                $infodata->name = $request->get('name');
                $infodata->describe = $request->get('describe');
                if ($infodata->save()) {
                    return response('更新成功', 200);
                } else {
                    throw new Exception('更新失败');
                }
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function deltype(Request $request){
        try{
            $id = $request->get('id');
                if(is_null($id)){
                    throw new Exception('请重新选择删除');
                }
                if (Article::where('classification_id',$id)){
                    Article::where('classification_id',$id)->update(['classification_id' => 1]);
                }
                if(classification::destroy($id)){
                    return response('删除成功',200);
                }else{
                    throw new Exception('删除失败');
                }
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }
}
