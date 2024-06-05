<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Classes\ApiResponseClass;
use App\Http\Resources\ProductResource;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepositoryInterface;
    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    public function getListProducts()
    {
        $data = $this->productRepositoryInterface->index();
        return ApiResponseClass::set200Response(ProductResource::collection($data), 200);
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
    public function createProduct(StoreProductRequest $request)
    {
        $detail = [
            'name' => $request->name,
        ];
        DB::beginTransaction();
        try {
            $product = $this->productRepositoryInterface->store($detail);
            DB::commit();
            return ApiResponseClass::set200Response(new ProductResource($product), 200);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProduct(UpdateProductRequest $request)
    {
        $updateDetails = [
            'name' => $request->name
        ];
        DB::beginTransaction();
        try {
            $product = $this->productRepositoryInterface->update($updateDetails, $request->id);

            DB::commit();
            return ApiResponseClass::set200Response(null, 201);

        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
