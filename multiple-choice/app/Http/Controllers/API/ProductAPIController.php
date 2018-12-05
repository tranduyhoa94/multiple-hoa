<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProductAPIRequest;
use App\Http\Requests\API\UpdateProductAPIRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/**
 * Class ProductController
 * @package App\Http\Controllers\API
 */

class ProductAPIController extends AppBaseController
{
    /** @var  ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the Product.
     * GET|HEAD /products
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productRepository->pushCriteria(new RequestCriteria($request));
        $this->productRepository->pushCriteria(new LimitOffsetCriteria($request));
        

        $products = $this->productRepository->all();

        return $this->sendResponse($products->toArray(), 'Products retrieved successfully');
    }

    /**
     * Store a newly created Product in storage.
     * POST /products
     *
     * @param CreateProductAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProductAPIRequest $request)
    {
        
        $input = $request->all();
        // dd($input);
        $file = $request->image;
        
        if(!empty($file)) {

            $filename = time().'.'.$file->getClientOriginalExtension();
            $pathPublic = public_path().'/files/';
            if(\File::exists($pathPublic.$filename)){
                unlink($pathPublic.$filename);
            }
            if(!\File::exists($pathPublic)) {
                \File::makeDirectory($pathPublic, $mode = 0777, true, true);
            }
            $file->move($pathPublic, $filename);

            $input['image'] = $filename;
        }

        $products = $this->productRepository->create($input);

        return $this->sendResponse($products->toArray(), 'Product saved successfully');
    }

    /**
     * Display the specified Product.
     * GET|HEAD /products/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Product $product */
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            return $this->sendError('Product not found');
        }

        return $this->sendResponse($product->toArray(), 'Product retrieved successfully');
    }

    /**
     * Update the specified Product in storage.
     * PUT/PATCH /products/{id}
     *
     * @param  int $id
     * @param UpdateProductAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductAPIRequest $request)
    {
        $input = $request->all();

        /** @var Product $product */
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            return $this->sendError('Product not found');
        }

        $product = $this->productRepository->update($input, $id);

        return $this->sendResponse($product->toArray(), 'Product updated successfully');
    }

    /**
     * Remove the specified Product from storage.
     * DELETE /products/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Product $product */
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product)) {
            return $this->sendError('Product not found');
        }

        $product->delete();

        return $this->sendResponse($id, 'Product deleted successfully');
    }

    public function uploadImage(Request $request){

            $file = $request->image;
    

            if(!empty($file)) {

             $filename = time().'.'.$file->getClientOriginalExtension();
             $pathPublic = public_path().'/files/';

            if(\File::exists($pathPublic.$filename)){
                unlink($pathPublic.$filename);
                  
            }
            if(!\File::exists($pathPublic)) {
                \File::makeDirectory($pathPublic, $mode = 0777, true, true);
            }

            $file->move($pathPublic, $filename);

            $dir = '/';
            $recursive = false; // Get subdirectories also?
            $contents = collect(Storage::cloud()->listContents($dir, $recursive));
            $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', $request->path)
                ->first(); // There could be duplicate directory names!
            if ( ! $dir) {
                return 'Directory does not exist!';
            }


            $fileData = File::get($pathPublic.$filename);
            Storage::cloud()->put($dir['path'].'/'.$filename, $fileData);
            // return 'File was saved to Google Drive';
            unlink($pathPublic.$filename);

            $file_name = $this->callbackUrl($request->path,$filename);
            
            $data = explode('/', $file_name['path']);

            return \Response::json([
                        'status' => true,
                        'link' =>  'https://drive.google.com/uc?id='.$data[1],
                    ]);
        }
    }

    public function callbackUrl($file_folder,$file_name){

        // $filename = '1542594268.png';
        // Tìm file và sử dụng ID (path) của nó để xóa

        $folder = $file_folder;
        // Get root directory contents...
        $contents = collect(Storage::cloud()->listContents('/', false));
        // Find the folder you are looking for...
        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $folder)
            ->first(); // There could be duplicate directory names!
        if ( ! $dir) {
            return 'No such folder!';
        }
        // Get the files inside the folder...
        $files = collect(Storage::cloud()->listContents($dir['path'], false))
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($file_name, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($file_name, PATHINFO_EXTENSION))
            ->first(); // có thể bị trùng tên file với nhau!

        return $files;


        // $dir = '/';
        // $recursive = false; //  Có lấy file trong các thư mục con không?
        // $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        // $file = $contents
        //     ->where('type', '=', 'file')
        //     ->where('filename', '=', pathinfo($file_name, PATHINFO_FILENAME))
        //     ->where('extension', '=', pathinfo($file_name, PATHINFO_EXTENSION))
        //     ->first(); // có thể bị trùng tên file với nhau!
        
        // return $file;

    }
}
