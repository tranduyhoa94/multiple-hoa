<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserDashAPIRequest;
use App\Http\Requests\API\UpdateUserDashAPIRequest;
use App\Models\UserDash;
use App\Repositories\UserDashRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/**
 * Class UserDashController
 * @package App\Http\Controllers\API
 */

class UserDashAPIController extends AppBaseController
{
    /** @var  UserDashRepository */
    private $userDashRepository;

    public function __construct(UserDashRepository $userDashRepo)
    {
        $this->userDashRepository = $userDashRepo;
    }

    /**
     * Display a listing of the UserDash.
     * GET|HEAD /userDashes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userDashRepository->pushCriteria(new RequestCriteria($request));
        $this->userDashRepository->pushCriteria(new LimitOffsetCriteria($request));
        $perPage = $request->input('per_page');
        $userDashes = $this->userDashRepository->paginate($perPage);

        return $this->sendResponse($userDashes->toArray(), 'User Dashes retrieved successfully');
    }

    /**
     * Store a newly created UserDash in storage.
     * POST /userDashes
     *
     * @param CreateUserDashAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserDashAPIRequest $request)
    {
        $input = $request->all();

        $userDashes = $this->userDashRepository->create($input);

        return $this->sendResponse($userDashes->toArray(), 'User Dash saved successfully');
    }

    /**
     * Display the specified UserDash.
     * GET|HEAD /userDashes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var UserDash $userDash */
        $userDash = $this->userDashRepository->findWithoutFail($id);

        if (empty($userDash)) {
            return $this->sendError('User Dash not found');
        }

        return $this->sendResponse($userDash->toArray(), 'User Dash retrieved successfully');
    }

    /**
     * Update the specified UserDash in storage.
     * PUT/PATCH /userDashes/{id}
     *
     * @param  int $id
     * @param UpdateUserDashAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserDashAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserDash $userDash */
        $userDash = $this->userDashRepository->findWithoutFail($id);

        if (empty($userDash)) {
            return $this->sendError('User Dash not found');
        }

        $userDash = $this->userDashRepository->update($input, $id);

        return $this->sendResponse($userDash->toArray(), 'UserDash updated successfully');
    }

    /**
     * Remove the specified UserDash from storage.
     * DELETE /userDashes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var UserDash $userDash */
        $userDash = $this->userDashRepository->findWithoutFail($id);

        if (empty($userDash)) {
            return $this->sendError('User Dash not found');
        }

        $userDash->delete();

        return $this->sendResponse($id, 'User Dash deleted successfully');
    }

    public function test(Request $request){

        // dd($request->all());
            // $filename = '1542594268.png';
            // // Tìm file và sử dụng ID (path) của nó để xóa
            // $dir = '/';
            // $recursive = false; //  Có lấy file trong các thư mục con không?
            // $contents = collect(Storage::cloud()->listContents($dir, $recursive));
            // $file = $contents
            //     ->where('type', '=', 'file')
            //     ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            //     ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            //     ->first(); // có thể bị trùng tên file với nhau!
            //     dd($file);

    //         $file = $request->file_name;
    //         if(!empty($file)) {
    //         $filename = time().'.'.$file->getClientOriginalExtension();
    //         $pathPublic = public_path().'/files/';
    //         if(\File::exists($pathPublic.$filename)){
    //             unlink($pathPublic.$filename);
                  
    //         }
    //         if(!\File::exists($pathPublic)) {
    //             \File::makeDirectory($pathPublic, $mode = 0777, true, true);
    //         }
    //         $file->move($pathPublic, $filename);
    //         $fileData = File::get($pathPublic.$filename);
    //         Storage::cloud()->put($filename, $fileData);
    // // return 'File was saved to Google Drive';
    //         unlink($pathPublic.$filename);

        // }
    }
}
