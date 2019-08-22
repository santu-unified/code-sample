<?php

namespace App\Repositories;

use App\Models\Files;
use App\Repositories\AbstactRepository;

class FileRepository extends AbstactRepository
{

	protected $files;

	public function __construct(Files $files)
	{
		$this->files = $files;
	}

}
