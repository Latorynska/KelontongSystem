<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use App\Models\Branch;
use App\Models\BranchStaff;
use App\Models\Brand;

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
        $data['managers'] = $brand->managers->pluck('user');

        return view('branch.create', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'location' => 'required',
                'manager_id' => 'required',
            ]);

            // Begin a database transaction
            DB::beginTransaction();

            // Get data brand based on user id owner brand
            $brand = Brand::where('user_id', $request->owner_id)->first();

            // Rearrange data
            $data = [
                'brand_id' => $brand->id,
                'owner_id' => $request->owner_id,
                'name' => $request->name,
                'location' => $request->location,
            ];

            // Create branch
            $newBranch = Branch::create($data);

            // Create manager after obtaining branch id
            $assignManager = BranchStaff::create([
                'branch_id' => $newBranch->id,
                'user_id' => $request->manager_id,
            ]);

            // Commit the database transaction if all is successful
            DB::commit();

            $notification = [
                'message' => 'Data buku berhasil ditambahkan',
                'alert-type' => 'success'
            ];
            return redirect()->route('branch')->with($notification);
        } catch (ValidationException $e) {
            // If validation fails, rollback the transaction
            DB::rollBack();

            // Flash input data and validation errors
            return back()->withErrors($e->validator)->withInput();

        } catch (\Exception $e) {
            // If any other exception occurs, rollback the transaction
            DB::rollBack();

            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ];
        }

        // Redirect back with notification
        return back()->with($notification);
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required',
    //         'location' => 'required',
    //         'manager_id' => 'required',
    //     ]);
    //     $brand = Brand::where('user_id', $request->owner_id)->first();
    //     $data = [
    //         'brand_id' => $brand->id,
    //         'owner_id' => $request->owner_id,
    //         'name' => $request->name,
    //         'location' => $request->location,
    //     ];
    //     $newBranch = Branch::create($data);
    //     $assignManager = BranchStaff::create([
    //         'branch_id' => $newBranch->id,
    //         'user_id' => $request->owner_id,
    //     ]);
    //     $notification = array(
    //         'message' => 'Data buku berhasil ditambahkan',
    //         'alert-type' => 'success'
    //     );
    //     return redirect()->route('branch')->with($notification);
    // }


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
        $branch = Branch::findOrFail($id)->first();
        dump($branch);
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
