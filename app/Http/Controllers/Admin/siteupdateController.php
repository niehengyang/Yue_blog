<?php

namespace App\Http\Controllers\Admin;

use App\Model\Deskpageinfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class siteupdateController extends Controller
{

    public function deskpageupdate(Request $request){
        try{
            if (is_null($request->all())){
               throw new Exception('数据获取失败，请重新提交!');
            }
            $top_img = $request->get('top_image');
            $web_title = $request->get('web_title');
            $web_speak = $request->get('web_speak');
            $web_describe = $request->get('web_describe');
            $data = [
                'APP_NAME' => $web_title,
                'APP_BACKGROUND_IMG' => $top_img,
                'APP_SPEAK_TITLE' => $web_speak,
                'APP_DESCRIBE_TITLE' => $web_describe,
            ];
            $this->modifyEnv($data);
            return response('提交成功!',200);
        }catch (Exception $e){
            return response($e->getMessage(),500);
        }
    }
    //修改env配置
    public function modifyEnv(array $data){
        $envPath = base_path().DIRECTORY_SEPARATOR.'.env';//获取绝对路径
        $contentArray = collect(file($envPath,FILE_IGNORE_NEW_LINES));

        $contentArray->transform(function($item) use ($data){
            //transform()将操作应用于指定范围的每个元素
            foreach ($data as $key =>$value){
                if (str_contains($item,$key)){
                    return $key.'='.$value;
                }
            }
            return $item;
        });
        $content = implode($contentArray->toArray(),"\n");
        //implode()返回由数组元素组合成的字符串
        \File::put($envPath,$content);
    }

    public function getdeskpageinfo(){
        $website_release_size = Deskpageinfo::find(1)->web_release_size;
        $top_img = getenv('APP_BACKGROUND_IMG');
        $web_title = getenv('APP_NAME');
        $web_speak = getenv('APP_SPEAK_TITLE');
        $web_describe = getenv('APP_DESCRIBE_TITLE');
        $deskpageinfo = [
            'web_title' => $web_title,
            'top_image' => $top_img,
            'web_speak' => $web_speak,
            'web_describe' => $web_describe,
            'web_release_size' => $website_release_size
        ];

        if (is_null($deskpageinfo)){
            return response('信息获取失败！',500);
        }
        return response($deskpageinfo,200);
    }

    public function shotdownwebsite(Request $request){
        $website_release_size = $request->get('web_release_size');
        $websiteinfo = Deskpageinfo::find(1);
        $websiteinfo->web_release_size = $website_release_size;
        if($website_release_size ==0 && $websiteinfo->save()){
            return response('站点已经关闭',200);
        }
        if( $website_release_size ==1 && $websiteinfo->save()){
            return response('站点已经开启',200);
        }
    }

}
