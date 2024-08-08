<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SectionService;
use App\Http\Requests\SectionsRequest;
use App\Models\Section;
use Illuminate\Support\Facades\File;


class SectionsController extends Controller
{
    protected $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    public function index()
    {
        $branches = $this->sectionService->getAllBranches();
        $sections = $this->sectionService->getAllSections();
        return view('sections.sections', compact('sections','branches'));
    }

    public function create()
    {

    }

    public function store(SectionsRequest $request)
    {
        $this->sectionService->createSection($request);
        return responce('Add', 'تم ا ضافه القسم بنجاح' , '/sections');

    }


    public function update(SectionsRequest $request )
    {
        $this->sectionService->updateSection( data:$request->validated() );
        return  responce('edit', 'تم تعديل القسم بنجاح' , '/sections');
    }

    public function show( Section $section)
    {

    }

    public function edit(string $id)
    {
        // Return the view for editing the specified section if needed
    }


    public function destroy (Request $request )
    {
        $data = $request->only('id');
        $this->sectionService->deleteSection($data );
        return responce('delete', 'تم حذف القسم بنجاح' ,'/sections');

    }
}

