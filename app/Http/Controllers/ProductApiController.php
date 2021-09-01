<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Spatie\QueryBuilder\QueryBuilder;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $products = Product::with('subCategory')->orderBy('created_at', 'desc')->paginate($request->input('per_page', 90));

        // if ($request->has('search')) {
        //     $products = Product::with('subCategory')->where('title', 'LIKE', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate($request->input('per_page', 90));
        // } else {
        //     $products = Product::with('subCategory')->orderBy('created_at', 'desc')->paginate($request->input('per_page', 90));
        // }

        // $products = QueryBuilder::for(Product::class)->allowedFilters('sub_category', 'title')->with('subCategory')->orderBy('created_at', 'desc')->paginate($request->input('per_page', 90));
        // ->where('title', 'LIKE', '%' . $request->has('title') . '%')
        // return new ProductCollection($productsPaginate);

        $products = Product::with('subCategory')->where('sub_category_id', 'LIKE', '%' . $request->input('sub') . '%')->where('title', 'LIKE', '%' . $request->input('title') . '%')->orderBy('created_at', 'desc');

        $productsTotal = $products->count();
        $productsPaginate = $products->paginate($request->input('per_page', 90));

        return collect([
            'pagination' => [
                'page' => $request->query->get('page'),
                'per_page' => $request->query->get('per_page'),
                'total' => $productsTotal,
            ],
            'data' => ProductResource::collection($productsPaginate),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $products = Product::create($request->all());
        return response()->json(['message' => 'Product created', 'data' => $products], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json(['message' => 'Detail of product resource', 'data' => $product], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $product->update($request->all());
        return response()->json(['message' => 'Product updated', 'data' => $product], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted', 'data' => $product], Response::HTTP_OK);
    }
}
