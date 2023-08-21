<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Member;
use App\Repositories\MemberInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $repository;
    public function __construct(MemberInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = $this->repository->all();
        return $members;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request)
    {
        Member::create($request->all());
        return 'success';
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(MemberUpdateRequest $request, Member $member)
    // {
    //     $member->update($request->all());
    //     return $request->all();
    // }
    public function update(MemberRequest $request, Member $member)
    {
        $member->update($request->all());
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}
