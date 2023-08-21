<?php 

/**
 * Member Interface (CRUD)
 */
namespace App\Repositories;

interface MemberInterface
{
	public function all();
    public function getAll();
    public function store($request);
    public function get($id);
    public function update($request, $id);
    public function delete($id);
}
