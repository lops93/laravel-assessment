<?php

namespace App\Http\Controllers;

use App\Models\Tours;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    //Return all tours
    public function index(Request $request) {
        $query = Tours::query();

        if ($request->has('priceeq')) {
            $query->where('price', $request->priceeq);
        }if ($request->has('pricelte')) {
            $query->where('price','<=', $request->pricelte);
        }if ($request->has('pricegte')) {
            $query->where('price','>=', $request->pricegte);
        }

        if ($request->has('starteq')) {
            $query->where('start', $request->starteq);
        }if ($request->has('startlte')) {
            $query->where('start','<=', $request->startlte);
        }if ($request->has('startgte')) {
            $query->where('start','>=', $request->startgte);
        }

        if ($request->has('endeq')) {
            $query->where('end', $request->endteq);
        }if ($request->has('endlte')) {
            $query->where('end','<=', $request->endlte);
        }if ($request->has('endgte')) {
            $query->where('end','>=', $request->endgte);
        }

        $limit = $request->input('limit', 20);
        $page = $request->input('page', 1);
        $total = $query->count();
        $result = $query->offset(($page -1) * $limit)->limit($limit)->get();

        return[
            'limit' => $limit,
            'data' => $result,
            'total' => $total,
            'page' =>$page,
        ];
    }
    
    //Return specific tours data
    public function getTour($id) {
        return Tours::where('id', $id)->get();
    }

    //Creates new tours
    public function create(Request $request) {
        $rules = [
            'start' => 'required|date_format:Y-m-d H:i:s|',
            'end' => 'required|date_format:Y-m-d H:i:s|',
            'price' => 'required|numeric|between:0,999.99|',
        ];
        $feedback = [
            'required' => 'the field :attribute cannot be empty',
            'date_format:Y-m-d H:i:s' => 'wrong format, please use Y-m-d H:i:s format',
            'numeric' => 'only numeric values',
            'between:0,999.99' => 'only values between 0 - 999.99'
        ];

        $request->validate($rules, $feedback);
        $tours = new Tours();
        $tours->start = $request->start;
        $tours->end = $request->end;
        $tours->price = $request->price;
        $tours->save();

        return response()->json([
            "message" => "Tour created"
        ], 201);
    }
    //Update specific tours data
    public function update(Request $request, $id) {
        if (Tours::where('id', $id)->exists()) {
            $tours = Tours::find($id);
            $tours->start = is_null($request->start) ? $tours->start : $request->start;
            $tours->end = is_null($request->end) ? $tours->end : $request->end;
            $tours->price = is_null($request->price) ? $tours->price : $request->price;
            $tours->save();
    
            return response()->json([
                "message" => "Tour Updated"
            ], 200);
            } else {
            return response()->json([
                "message" => "Tour not found"
            ], 404);
            
        }
    }
    //Delete tours data
    public function delete ($id) {
        if(Tours::where('id', $id)->exists()) {
            $tours = Tours::find($id);
            $tours->delete();
    
            return response()->json([
              "message" => "Tour deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Tour not found"
            ], 404);
          }
    } 
}
