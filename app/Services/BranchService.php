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
    public function updateBranch($id ,  $data)
    {
        $branch = Branch::where('id', $id)->first();
        return $branch->update($data);
    }

    /**
     * Delete a branch.
     */
    public function deleteBranch( $id , $request )
    {
        $branch = Branch::where('id', $id)->first();
        return $branch->delete();
    }
}
