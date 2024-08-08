<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductsController extends Controller
{
    protected $productService;

    /**
     * ProductsController constructor.
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = $this->productService->getAllSections();
        $products = $this->productService->getAllProducts();
        return view('products.products', compact('sections', 'products'));
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
    public function store(Request $request)
    {
        $this->productService->createProduct($request->all());
        return responce('Add', 'تم اضافة المنتج بنجاح' ,'/products');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $this->productService->getSectionIdByName($request->section_name);

        $this->productService->updateProduct($request->pro_id, [
            'Product_name' => $request->Product_name,
            'description' => $request->description,
            'section_id' => $id,
        ]);
        return responce('Edit', 'تم تعديل المنتج بنجاح' ,'/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->productService->deleteProduct($request->pro_id);
        return responce('delete', 'تم حذف المنتج بنجاح' ,'/products');
    }
}

