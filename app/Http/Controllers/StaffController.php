<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\BrandStaff;
use App\Models\Brand;

class StaffController extends Controller
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
        $data['brandStaff'] = BrandStaff::with('user')->get();
        return view('staff.index', $data);
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
