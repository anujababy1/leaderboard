<?php

namespace App\Http\Controllers;

use App\Models\Competitor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompetitorRequest;
use App\Http\Requests\UpdateCompetitorRequest;

class CompetitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         try {
            $per_page       = $request->per_page??10;
            $search_name    = $request->search_name??'';
            $order_by        = $request->order_by??'points-desc';  
            $competitors =  Competitor::query();

            /* search section */
            if($search_name){
                $competitors = $competitors->where('name', 'like', '%' . $search_name . '%');
            }

            /* sorting section */
           
            if($order_by){
                list($field, $type) = explode('-', $order_by);
                $valid_fields = ['name', 'points'];
                $valid_types = ['asc', 'desc'];
                if (in_array($field, $valid_fields) && in_array($type, $valid_types)) {
                   $competitors =  $competitors->orderBy($field, $type);
                }
            }
            $competitors = $competitors->paginate($per_page);
             return response($competitors , 200);
        } catch (\Exception $ex) { 
            return response('Internal Server Error', 500);
        }
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompetitorRequest $request)
    {
        try {
            $data       = $request->validated();
            $competitor = Competitor::create($data);
            return response($competitor , 201);
        } catch (\Exception $ex) { 
            return response('Internal Server Error', 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Competitor $competitor)
    {
        try {
            return response($competitor , 200);
        } catch (\Exception $ex) { 
            return response('Internal Server Error', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompetitorRequest $request, Competitor $competitor)
    {
       try {
            $data       = $request->validated();
            \Log::info($data);
            $competitor->update($data);
            return response($competitor , 201);
        } catch (\Exception $ex) { 
            return response('Internal Server Error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competitor $competitor)
    {
        try {
            $competitor->delete();
            return response("", 204);
        } catch (\Exception $ex) { 
            return response('Internal Server Error', 500);
        }
    }
}
