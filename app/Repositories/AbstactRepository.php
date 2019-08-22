<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstactRepository
{


	public function saveData($model = NULL, $data = [])
	{
		if(is_array($data))
		{
			$res = $model::create($data);
			if(!empty($res))
				return $res->id;
			else
				return fasle;
		}
		else
		{
			return false;
		}
		
	}

	/*
	 *
	 *
	*/
	public function updateData($model = NULL, $data = [], $conditions = [])
	{
		$query = $model::query();

		if($conditions)
		{
			foreach ($conditions as $condition) {
				$query = $query->where($condition[0],$condition[1],$condition[2]);
			}
		}

		if(is_array($data))
		{
			if($query->update($data))
				return true;
			else
				return false;
		}
		return false;
	}

	/*
	 *
	 *
	*/
	public function updateOrCreateData($model = NULL, $data = [], $conditions = [])
	{
		$query = $model::query();

		// if($conditions)
		// {
		// 	foreach ($conditions as $condition) {
		// 		$query = $query->where($condition[0],$condition[1],$condition[2]);
		// 	}
		// }

		if(is_array($data))
		{
			if($query->updateOrCreate($conditions, $data))
				return true;
			else
				return false;
		}
		return false;
	}

	public function deleteData($model = NULL, $conditions = [])
	{
		return $model::where($conditions)->delete();
	}

	public function listAllData($model = NULL, $conditions = [], $orderBy = [], $limit = NULL, $offset = 0)
	{
		$query = $model::query();
		if($conditions)
		{
			foreach ($conditions as $condition) {
				$query = $query->where($condition[0],$condition[1],$condition[2]);
			}
			
		}
		if($orderBy)
		{
			foreach ($orderBy as $order) {
				$query = $query->orderBy($order[0],$order[1]);
			}	
		}

		if($limit)
			$query = $query->offset($offset)->limit($limit);

		return $query->get();
	}

	public function getSingleRecord($model = NULL, $id = NULL)
	{
		return $model::find($id);
	}

	public function createOrUpdateData($model = NULL, $data = [], $conditions = [])
	{
		if($model::updateOrCreate($conditions, $data))
			return true;
		else
			return false;
	}

}
