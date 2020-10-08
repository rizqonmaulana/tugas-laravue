<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
use App\Http\Resources\FoodResource;

class FoodController extends Controller
{
    public function index(){
        $foods = Food::orderBy('created_at', 'desc')->get();

        return FoodResource::collection($foods);
    }

    public function store(Request $request)
    {
        $food = Food::create([
            'name' => $request->name,
            'country' => $request->country
        ]);

        return new FoodResource($food);
    }

    public function delete($id){
        Food::destroy($id);
        return 'Deleted';
    }

    public function edit(Request $request, $id){
        $food = Food::find($id);
        $food->update([
            'name' => $request->name,
            'country' => $request->country
        ]);

        return new FoodResource($food);
    }
}
