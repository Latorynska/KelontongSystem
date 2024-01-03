<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owner_id = Auth::user()->id;

        $data['brand'] = Brand::with(['user', 'branches', 'branchStaff', 'brandStaff'])
            ->withCount(['branches as branches_count', 'branchStaff as branch_staff_count', 'brandStaff as brand_staff_count'])
            ->where('user_id', $owner_id)
            ->get();

        return view('brand.index', $data);
    }




    public function admin()
    {
        return view('brand.admin');
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
