<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AppBaseController;

class PhotoController extends AppBaseController
{
   	public function createFolder(Request $request) {

   		$folder_name = $request['folder_name'];
   		
   		$newFolder = \Storage::cloud()->makeDirectory($folder_name);

		return \Response::json([
                        'success' => true,
                        'messenger' =>  'create folder success',
                    ]);
   	}

   	public function getListFolder(){
   		
   		$dir = '/';
    	$recursive = false; // Có lấy file trong các thư mục con không?
    	$contents = collect(\Storage::cloud()->listContents($dir, $recursive));
    	$reslut =  $contents->where('type', '=', 'dir');
   		return \Response::json([
                        'success' => true,
                        'messenger' =>  'create folder success',
                        'data' => $reslut
                    ]);
   	}
}
