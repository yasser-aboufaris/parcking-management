<?php

namespace App\Http\Controllers;
use App\Models\Parking;
use Illuminate\Http\Request;

class parkingController extends Controller
{
    public function index(){
        $parkings = Parking::all();
        return response()->json($parkings);
    }

    public function add(Request $request)
{
    // Validate the request data
    $validated = $request->validate([
        'name' => 'required|max:20|string',
        'address' => 'required|string',
        'price' => 'nullable|numeric',
        'capacity' => 'required|numeric'
    ]);

    // dd($request);

    // $parking = new Parking();
    // $parking->name = $validated['name'];
    // $parking->address = $validated['address'];
    // $parking->price = $validated['price']; 
    // $parking->capacity = $validated['capacity'];
    
    // $parking->save();

    $parking = Parking::create($validated);

    return response()->json([
        'message' => 'Parking added successfully!',
        'data' => $parking
    ], 201);
}

public function update(Request $request,$id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:20',
        'address' => 'required|string',
        'price' => 'nullable|numeric|min:0',
        'capacity' => 'required|integer|min:1'
    ]);

    $parking = Parking::find($id);

    if (!$parking) {
        return response()->json([
            'message' => 'Parking not found.'
        ], 404);
    }

    $parking->update($validated);

    return response()->json([
        'message' => 'Parking updated successfully!',
        'data' => $parking
    ]);
}

public function delete($id){
    Parking::destroy($id);
    return response()->json([
        'message' => 'Parking delited successfully'
    ]);
}

}