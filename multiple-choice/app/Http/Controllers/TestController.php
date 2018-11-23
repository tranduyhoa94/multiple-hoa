<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Libraries\RemoteImageUploader\Factory;
use Validator;

class TestController extends Controller
{
    public function getUpload(){
    	return view('upload');
    }
    public function upload(Request $request){
    	$validator = Validator::make($request->all(), [
            'upload' => 'required',
        ]);
        if ($validator->fails()) {
            // gộp mảng errors thành chuỗi, cách nhau bởi dấu cách
            $message = implode(' ', $validator->errors()->all());
    
            return [
                'status' => false,
                'url' => '',
                'message' => 'Upload fail! ' . $message,
            ];
        }
        // try {
            // Thực hiện create và upload photo với config đã cài sẵn
            // dd($request->upload);
            $result = Factory::create(config('uploadphoto.host'), config('uploadphoto.auth'))
                ->upload($request->upload->path());
    
            return [
                'status' => true,
                'url' => $result,
                'message' => 'Upload successfull!',
            ];
        // } catch (\Exception $ex) {
        //     // Nếu bị Exception thì trả về message của Exception đó
        //     // Exception ở đây có thể là:
        //     // - host không hợp lệ
        //     // - api không hợp lệ
        //     // - xác thực auth không thành công
        //     // - không có quyền upload
        //     // - php không enable curl
        //     return [
        //         'status' => false,
        //         'url' => '',
        //         'message' => 'Upload fail! ' . $ex->getMessage(),
        //     ];
        // }
    }
}
