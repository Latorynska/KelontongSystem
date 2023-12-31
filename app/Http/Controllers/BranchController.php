<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the current user's ID
        $ownerId = Auth::id();

        // Get the user's brand with manager information and staff count
        $brand = Brand::with([
            'branches.manager',
            'branches' => function ($query) {
                $query->withCount('staff');
            }
        ])->where('user_id', $ownerId)->first();

        $data['brand'] = $brand;

        // Access branches and their managers
        $branches = $brand->branches;
        $data['branches'] = $branches;

        // Return the data to the view
        return view('branch.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ownerId = Auth::id();
        $brand = Brand::with('branches')->where('user_id', $ownerId)->first();
        
        // Access managers through the relationship
        $managers = $brand->managers;

        return view('branch.create', compact('managers'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
