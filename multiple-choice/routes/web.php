<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{any}', function () {
   return view('index');
})->where(['any' => '.*']);

// Route::get('test','LoginController@test');

// Route::get('program', function(){
// 	// $googleDisk = \Storage::disk('google');
// 	// dd($googleDisk);

// 	// Storage::cloud()->put('test.txt', 'Hello World');
//  //    return 'File was saved to Google Drive';
//     //  $filePath = public_path('/images/integra.png');
//     // $fileData = File::get($filePath);
//     // Storage::cloud()->put('image', $fileData);
//     // // return 'File was saved to Google Drive';
//     //   $dir = '/';
//     // $recursive = false; // Có lấy file trong các thư mục con không?
//     // $contents = collect(Storage::cloud()->listContents($dir, $recursive));
//     // $reslut =  $contents->where('type', '=', 'file');
//     // dd($reslut);
// });


// Route::get('delete', function() {
//    $filename = 'image';
//     // Tìm file và sử dụng ID (path) của nó để xóa
//     $dir = '/';
//     $recursive = false; //  Có lấy file trong các thư mục con không?
//     $contents = collect(Storage::cloud()->listContents($dir, $recursive));
//     $file = $contents
//         ->where('type', '=', 'file')
//         ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
//         ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
//         ->first(); // có thể bị trùng tên file với nhau!
//         dd($file);
//     // Storage::cloud()->delete($file['path']);
//     return 'File was deleted from Google Drive';
// });