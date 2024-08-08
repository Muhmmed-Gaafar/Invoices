<?php

namespace App\Services;

use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\File;

class SectionService
{
    public function createSection(Request $request): Section
    {
        $data = [
            'section_name' => $request->section_name,
            'branch_id'=> $request->branch_id,
            'description' => $request->description,
            'status' => $request->status,
            'Created_by' => Auth::user()->name,
        ];

        $section = Section::create($data);

        if ($request->hasFile('pic')) {
            $section->addMediaFromRequest('pic')->toMediaCollection('media');
        }

        return $section;
    }

    public function updateSection(array $data)
    {

        $section = Section::find($data['id']);
         $section->update($data);

        if (isset($data['pic']) && $data['pic']->isValid()) {
            $section->clearMediaCollection('media');
            $section->addMedia($data['pic'])->toMediaCollection('media');
        }
        return $section;
    }

    public function getAllSections()
    {
        return Section::all();
    }


    public function getAllBranches()
    {
        return Branch::all();
    }

    public function getSectionById(int $id): Section
    {
        return Section::findOrFail($id);
    }

    public function deleteSection(array $data)
    {
        $section = Section::find($data['id']);
        $pic_path = public_path('pic/' . $section->pic);

        File::delete($pic_path);
        $section->delete();

    }
}




