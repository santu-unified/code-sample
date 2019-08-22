<?php

namespace App\Services;

use App\Repositories\FileRepository;
use Image;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileService
{

	protected $fileRepo;
	protected $picturePath;
	protected $pictureThumbPath;
	protected $imageName;

	public function __construct(FileRepository $fileRepo)
	{
		$this->fileRepo = $fileRepo;
	}

	public function uploadFile($file = NULL, $type = NULL, $userId, $unique = true)
	{
		try
            {

            	if(!empty($file))
            	{
            		$this->getUploadDirectoryName($type);

            		$imagePrefix = rand(10000, 99999).'_'.time();
            		$original_filename = $file->getClientOriginalName();
            		$this->imageName = $imagePrefix.'.'.$file->getClientOriginalExtension();
            		$img = Image::make($file->getRealPath());
            		if(Storage::putFileAs($this->picturePath, $file, $this->imageName))
            		{
            			$medImage = $img->resize(728, 441, 
                                    function ($constraint) {
                                        $constraint->aspectRatio();
                                    }
                                )->stream();

            			if(Storage::put($this->pictureThumbPath.$this->imageName, $img))
	            			return $this->addOrUpdateData($userId, $type, $unique);
	            		else
	            			return false;
            		}
            		else
            		{
            			return false;
            		}
            		
            		
            		
            	}
            }
            catch(\Exception $e)
            {
            	die($e->getMessage());
                // $request->session()->flash('exception', $e->getMessage());
            }  
	}

	protected function getUploadDirectoryName($type = NULL)
	{
		try
        {
			switch ($type) {
				case 'profile_image':
					$this->picturePath = '/public/'.config('constants.profile_path');
	                $this->pictureThumbPath = '/public/'.config('constants.profile_thumb_path');

					break;
				
				default:
					# code...
					break;
			}

			return true;
		}
		catch(\Exception $e)
        {
        	die($e->getMessage());
            // $request->session()->flash('exception', $e->getMessage());
        }  
	}

	protected function addOrUpdateData($userId = NULL, $type = NULL, $unique = true)
	{
		try
        {
			$data = ["file_name" => $this->imageName, "user_id" => $userId, "type" => $type];

			if($unique)
				return $this->fileRepo->createOrUpdateData("App\Models\Files", $data, ["user_id" => $userId]);
			else
				return $this->fileRepo->saveData("App\Models\Files", $data);
		}
		catch(\Exception $e)
        {
        	die($e->getMessage());
            // $request->session()->flash('exception', $e->getMessage());
        }  
	}

	public function getFiles($userId = NULL)
	{
		try
        {
			if($userId)
				return $this->fileRepo->listAllData("App\Models\Files", [['user_id', '=', $userId]],[['id','DESC']]);
			else
				return $this->fileRepo->listAllData("App\Models\Files");
		}
		catch(\Exception $e)
        {
        	die($e->getMessage());
            // $request->session()->flash('exception', $e->getMessage());
        }  
	}

	public function deleteFile($conditions = [])
	{
		try
        {
			return $this->fileRepo->deleteData("\CNrepo\FileManagement\Models\Files", $conditions);
		}
		catch(\Exception $e)
        {
        	die($e->getMessage());
            // $request->session()->flash('exception', $e->getMessage());
        } 
	}
    
}
