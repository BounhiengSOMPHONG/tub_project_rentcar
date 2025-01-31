<?php

namespace App\Http\Controllers;

use App\Models\tbl_cars;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;



class TblCarsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'car_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|string|max:255',
            'car_type_id' => 'required|integer|exists:tbl_cars_types,car_type_id',
            'car_status' => 'required|string|in:available,sold',
        ]);
    
        // Raw SQL query
        $sql = "INSERT INTO tbl_cars (car_name, description, quantity, image, car_type_id, car_status, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        DB::statement($sql, [
            $request->car_name,
            $request->description,
            $request->quantity,
            $request->image,
            $request->car_type_id,
            $request->car_status,
            now(),
            now(),
        ]);
    
        return response()->json([
            'message' => 'Car added successfully',
        ], 201);
    }
    
    

    /**
     * Display a listing of cars.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function getAll(Request $request)
     {
         $query = DB::table('tbl_cars')
             ->leftJoin('tbl_cars_types', 'tbl_cars.car_type_id', '=', 'tbl_cars_types.car_type_id')
             ->select('tbl_cars.*', 'tbl_cars_types.car_type_name');
     
         if ($request->has('status')) {
             $query->where('tbl_cars.car_status', $request->status);
         }
     
         if ($request->has('type_id')) {
             $query->where('tbl_cars.car_type_id', $request->type_id);
         }
     
         $cars = $query->get();
     
         return response()->json([
             'message' => 'Cars retrieved successfully',
             'data' => $cars,
         ], 200);
     }
}
