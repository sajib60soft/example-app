<?php

/**
 * Member Repository (CRUD)
 */

namespace App\Repositories;

use App\Models\Member;
use App\Repositories\MemberInterface;

class MemberRepository implements MemberInterface
{
	public function all()
	{
		return Member::orderByDesc('id')
			->paginate(10);
	}

	public function getAll()
	{
		return Member::orderByDesc('id')
			->get();
	}

	public function store($request)
	{
		// code...
	}

	public function get($id)
	{
		// code...
	}

	public function update($request, $id)
	{
		// code...
	}

	public function delete($id)
	{
		// code...
	}
}
