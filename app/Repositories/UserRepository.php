<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\AbstactRepository;

class UserRepository extends AbstactRepository
{

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function getSingleUserRecord($id)
	{
		return $this->user->with(['userDetails','profileImage'])->find($id);
	}

}
