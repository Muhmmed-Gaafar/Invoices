<?php

namespace App\Services;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchService
{
    /**
     * Get all branches.
     */
    public function getAllBranches()
    {
        return Branch::all();
    }

    /**
     * Create a new branch.
     */
    public function createBranch(array $data)
    {
        return Branch::create($data);
    }

    /**
     * Update an existing branch.
     */
    public function updateBranch(array $data)
    {
        $branch = Branch::where('id', $id)->first();
        return $branch->update($data);
    }

    /**
     * Delete a branch.
     */
    public function deleteBranch( Request $request )
    {
        $branch = Branch::find($request->id);
        return $branch->delete();
    }
}
