<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Medcine;
use Illuminate\Http\Request;
use App\Filters\MedcineFilter;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MedcineResource;
use App\Http\Resources\MedcineCollection;
use App\Http\Requests\StoreMedcineRequest;
use App\Http\Requests\UpdateMedcineRequest;

class MedcineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Medcine::class);
    
        $user = Auth::user();
        $filter=new MedcineFilter();
        $queryItems=$filter->transform($request);
        
        $filteredMedcines = Medcine::where($queryItems)
            ->where('user_id', $user->id)->get();

        $medcineCollection = $filteredMedcines->mapInto(MedcineResource::class);

        return MedcineResource::collection($medcineCollection);
    }
    /**
     * Display the specified resource.
     */
    public function show(Medcine $medcine)
    {
        $medcine->show=true;
        return new MedcineResource($medcine);    
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
    public function store(StoreMedcineRequest $request)
    {
       // dd(Auth::user());
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        $medcine = Medcine::create($validatedData);
        return new MedcineResource($medcine);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medcine $medcine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedcineRequest $request, Medcine $medcine)
    {
        $validated= $request->validated();
        $medcine->update($validated);
        return new MedcineResource($medcine);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medcine $medcine)
    {
        $medcine->delete();
        return response()->json([
            "message"=> "the medcine has been deleted successfully",
        ]);
    }
    //
    public function __construct()
{
    $this->authorizeResource(Medcine::class, 'medcine');
}
}
