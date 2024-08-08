<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Section;

class ProductService
{
    /**
     * Get all sections.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllSections()
    {
        return Section::all();
    }

    /**
     * Get all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProducts()
    {
        return Product::all();
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * @return \App\Models\Product
     */
    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Update a product.
     *
     * @param int $productId
     * @param array $data
     * @return \App\Models\Product
     */
    public function updateProduct(int $productId, array $data): Product
    {
        $product = Product::find($productId);
        $product->update($data);

        return $product;
    }

    /**
     * Delete a product.
     *
     * @param int $productId
     * @return void
     */
    public function deleteProduct(int $productId): void
    {
        $product = Product::find($productId);
        $product->delete();
    }

    /**
     * Get section ID by section name.
     *
     * @param string $sectionName
     * @return int
     */
    public function getSectionIdByName(string $sectionName): int
    {
        return Section::where('section_name', $sectionName)->first()->id;
    }
}
