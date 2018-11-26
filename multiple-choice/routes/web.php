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

//     $filename = 'image';
//     $dir = '/';
//     $recursive = false; // Có lấy file trong các thư mục con không?
//     $contents = collect(Storage::cloud()->listContents($dir, $recursive));
//     $file = $contents
//         ->where('type', '=', 'file')
//         ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
//         ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
//         ->first(); // có thể bị trùng tên file với nhau!
//     //return $file; // array with file info
//     $rawData = Storage::cloud()->get($file['path']);
//     return response($rawData, 200)
//         ->header('Content-Type', $file['mimetype'])
//         ->header('Content-Disposition', "attachment; filename='$filename'");
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

// Router upload image fickr
// Route::get('get-upload','TestController@getUpload');
// Route::post('/upload','TestController@upload')->name('upload');
// // end Router

// // Test send mail
// Route::get('send-mail',function(){

// 	// dd(env('MAIL_HOST'));
// 	$data = [
// 		'name' => 'Hoa Tran' 
// 	];
// 	\Mail::to('tranduyhoa94@gmail.com')->send(new \App\Mail\sendEmail($data));  
// });

// Route::get('send/mail/callback','TestController@confirmMail');
