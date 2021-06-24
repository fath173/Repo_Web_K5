<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product as allProduct;

class Product extends Controller
{


    public function index()
    {
        $product = allProduct::all();
        return response()->json([
            'message' => 'success',
            'data' => $product,
        ]);
    }

    public function detailProduct($id)
    {
        $details = allProduct::where('id', $id)->get();
        $variasi = $details[0]->variasi;
        $stok = 0;

        foreach ($details[0]->variasi as $detail) {
            $stok += $detail->stok;
        }

        return response()->json([
            'message' => 'success',
            'data' => $variasi,
            'totalStok' => $stok,
        ]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
