<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\ActivationCategoryRequest;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\DeleteCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @OA\ Get(
     *     path="/category",
     *     summary="Get category data",
     *     tags={"Category"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="To get sepesific category by ID",
     *         required=false,
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="To get paginated data per page",
     *         required=false,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": true,
     *                  "message": "Get category successfull",
     *                  "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "Validation errors",
     *                  "error_code": 422,
     *                  "data": {
     *                      "errors": {
     *                          "email": "<Error Messages>"
     *                      }
     *                  }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated Request",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                 "success": false,
     *                 "message": "Unauthenticated",
     *                 "error_code": 401,
     *                 "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "<Error Messages>",
     *                  "error_code": 500,
     *                  "data": {}
     *             }
     *         )
     *     ),
     * )
     */
    // Get category data
    public function get(Request $request)
    {
        try {
            $data = [];
            if ($request->id) {
                $data['category'] = Category::where('active', true)->where('id', $request->id)->first();
            } else if ($request->page) {
                $data['category'] = Category::where('active', true)->paginate(1);
            } else {
                $data['categories'] = Category::where('active', true)->orderBy('name')->get();
            }
        } catch (\Throwable $e) {
            return $this->failedResponse($e->getMessage(), $e->getCode());
        }
        // Success response
        return $this->successResponse("Get category successfull", $data);
    }

    /**
     * @OA\ Post(
     *     path="/category",
     *     summary="Create new category",
     *     tags={"Category"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *				@OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 )
     *             ),
     *				example={
     *					"name": "Food"
     *				}
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": true,
     *                  "message": "Create category successfull",
     *                  "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "Validation errors",
     *                  "error_code": 422,
     *                  "data": {
     *                      "errors": {
     *                          "email": "<Error Messages>"
     *                      }
     *                  }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated Request",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                 "success": false,
     *                 "message": "Unauthenticated",
     *                 "error_code": 401,
     *                 "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "<Error Messages>",
     *                  "error_code": 500,
     *                  "data": {}
     *             }
     *         )
     *     ),
     * )
     */
    // Create new category
    public function create(CreateCategoryRequest $request)
    {
        try {
            $category = Category::create($request->only('name'));
        } catch (\Throwable $e) {
            return $this->failedResponse($e->getMessage(), $e->getCode());
        }
        // Success response
        return $this->successResponse("Create category successfull", [
            "category" => $category
        ]);
    }

    /**
     * @OA\ Put(
     *     path="/category",
     *     summary="Update category by id",
     *     tags={"Category"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *				@OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 )
     *             ),
     *				example={
     *					"id": 1,
     *					"name": "Category 1",
     *				}
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": true,
     *                  "message": "Update category successfull",
     *                  "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "Validation errors",
     *                  "error_code": 422,
     *                  "data": {
     *                      "errors": {
     *                          "email": "<Error Messages>"
     *                      }
     *                  }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated Request",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                 "success": false,
     *                 "message": "Unauthenticated",
     *                 "error_code": 401,
     *                 "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "<Error Messages>",
     *                  "error_code": 500,
     *                  "data": {}
     *             }
     *         )
     *     ),
     * )
     */
    // Update category
    public function update(UpdateCategoryRequest $request)
    {
        try {
            $category = Category::find($request->id);
            $category->update($request->only('name'));
        } catch (\Throwable $e) {
            return $this->failedResponse($e->getMessage());
        }
        // Success response
        return $this->successResponse("Update category successfull", [
            "category" => $category
        ]);
    }

    /**
     * @OA\ Delete(
     *     path="/category",
     *     summary="Delete category",
     *     tags={"Category"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *				@OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 )
     *             ),
     *				example={
     *					"id": 1
     *				}
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": true,
     *                  "message": "Category deleted successfully",
     *                  "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "Validation errors",
     *                  "error_code": 422,
     *                  "data": {
     *                      "errors": {
     *                          "email": "<Error Messages>"
     *                      }
     *                  }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated Request",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                 "success": false,
     *                 "message": "Unauthenticated",
     *                 "error_code": 401,
     *                 "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "<Error Messages>",
     *                  "error_code": 500,
     *                  "data": {}
     *             }
     *         )
     *     ),
     * )
     */
    // Delete category
    public function delete(DeleteCategoryRequest $request)
    {
        try {
            $category = Category::find($request->id);
            $category->delete();
        } catch (\Throwable $e) {
            return $this->failedResponse($e->getMessage(), $e->getCode());
        }
        // Success response
        return $this->successResponse("Category deleted successfully", [
            'category' => $category
        ]);
    }

    /**
     * @OA\ Patch(
     *     path="/category/activate",
     *     summary="Activate category",
     *     tags={"Category"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *				@OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 )
     *             ),
     *				example={
     *					"id": 1
     *				}
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": true,
     *                  "message": "Product activated successfully",
     *                  "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "Validation errors",
     *                  "error_code": 422,
     *                  "data": {
     *                      "errors": {
     *                          "email": "<Error Messages>"
     *                      }
     *                  }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated Request",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                 "success": false,
     *                 "message": "Unauthenticated",
     *                 "error_code": 401,
     *                 "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "<Error Messages>",
     *                  "error_code": 500,
     *                  "data": {}
     *             }
     *         )
     *     ),
     * )
     */
    // Activate category
    public function activate(ActivationCategoryRequest $request)
    {
        try {
            $category = Category::find($request->id);
            $category->update(['active' => true]);
        } catch (\Throwable $e) {
            return $this->failedResponse($e->getMessage(), $e->getCode());
        }
        // Success response
        return $this->successResponse("Category activated successfully", [
            'category' => $category
        ]);
    }

    /**
     * @OA\ Patch(
     *     path="/category/deactivate",
     *     summary="Deactivate category",
     *     tags={"Category"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *				@OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 )
     *             ),
     *				example={
     *					"id": 1
     *				}
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": true,
     *                  "message": "Category deactivated successfully",
     *                  "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "Validation errors",
     *                  "error_code": 422,
     *                  "data": {
     *                      "errors": {
     *                          "email": "<Error Messages>"
     *                      }
     *                  }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated Request",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                 "success": false,
     *                 "message": "Unauthenticated",
     *                 "error_code": 401,
     *                 "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "<Error Messages>",
     *                  "error_code": 500,
     *                  "data": {}
     *             }
     *         )
     *     ),
     * )
     */
    // Dectivate category
    public function deactivate(ActivationCategoryRequest $request)
    {
        try {
            $category = Category::find($request->id);
            $category->update(['active' => false]);
        } catch (\Throwable $e) {
            return $this->failedResponse($e->getMessage(), $e->getCode());
        }
        // Success response
        return $this->successResponse("Category deactivated successfully", [
            'category' => $category
        ]);
    }
}
