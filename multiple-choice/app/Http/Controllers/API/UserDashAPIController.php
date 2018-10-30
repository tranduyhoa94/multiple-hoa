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
}
