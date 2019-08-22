<?php

/*!
 * UserController.php
 * Containing all the controller actions related to User
 * MIT Licensed
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Repositories\UserRepository;
use App\Services\FileService;
use App\Http\Requests\EditProfileRequest;


class UserController extends Controller
{

    private $userRepo;
    private $fileService;

	public function __construct(UserRepository $userRepo, FileService $fileService)
    {
        $this->userRepo = $userRepo;
        $this->fileService = $fileService;
    }

    /**
     * index action.
     * it list all users depending on conditions
     * default all users.
     *
     * @param Request $request
     * @return {err|json} 
     * @api public
     * @route GET
     */
    public function index(Request $request)
	{
        $userData = $this->userRepo->getSingleUserRecord(Auth::user()->id);

        return view('home',compact('userData'));
	}

    /**
     * addUser action.
     * add user data in DB
     *
     * @param RegistartionRequest $addUserRequest
     * @return {err|json} 
     * @api public
     * @route PUT
     */

    public function editProfile(EditProfileRequest $request, FileService $fileService)
    {
        try
        {
            $validated = $request->validated();

            if($this->userRepo->updateData('App\Models\User', ['name' => $request->name,'dob' => $request->dob], [['id', '=', Auth::user()->id]]))
            {
                $isUpdated = $this->userRepo->updateOrCreateData('App\Models\UserDetails', 
                     
                    [
                        'custom1' => $request->custom1,
                        'custom2' => $request->custom2,
                        'user_id' => Auth::user()->id,
                    ],
                    [
                        'user_id' =>  Auth::user()->id
                    ]);
            }
             $request->session()->flash('success', 'Data added successfully');

            if($isUpdated)
            {
                if ($request->hasFile('profile_image')) 
                {
                    if($this->fileService->uploadFile($request->file('profile_image'),'profile_image', Auth::user()->id, false))
                        $request->session()->flash('success', 'File uploaded successfully');
                    else
                        $request->session()->flash('error', 'File upload failed! Try again');
                }
                
            }
            else
            {
                $request->session()->flash('error', 'DB operation failed! Try again');
            }

            return redirect('/user/profile');
        }
        catch(\Exception $e)
        {
            die($e->getMessage());
        }
    }
}
?>