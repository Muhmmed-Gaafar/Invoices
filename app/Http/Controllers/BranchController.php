<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Services\BranchService;
use App\Http\Requests\BranchRequest;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    protected $branchService;
    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = $this->branchService->getAllBranches();
        return view('branch', ['branches' => $branches]);
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
    public function store(BranchRequest $request)
    {
        $this->branchService->createBranch($request->validated());
        return responce('Add', 'تم اضافه الفرع بنجاح' , '/branch');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchRequest $request)
    {
        $this->branchService->updateBranch(data:$request->validated());
        return responce('edit', 'تم تعديل الفرع بنجاح' , '/branch');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BranchRequest $request)
    {
        $this->branchService->deleteBranch($request);
        return responce('delete', 'تم حذف الفرع بنجاح' , '/branch');

    }
}


