<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


use App\Models\BrandStaff;
use App\Models\Brand;
use App\Models\User;

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
        $data['brandStaff'] = BrandStaff::with(['user.roles', 'user.branches'])->get();
        // dump($data['brandStaff'][19]);
        return view('staff.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles'] = Role::whereNotIn('name', ['admin', 'owner'])->get();
        return view('staff.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $notification = null;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => ['required', 'not_in:admin,owner'],
            'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
        ]);

        // Start the database transaction
        DB::beginTransaction();

        try {
            // Create a new user
            $newUser = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'created_at' => now(),
            ]);

            // Attach the role to the new user
            $role = Role::where('name', $request->input('role'))->first();

            if ($role) {
                $newUser->roles()->attach($role->id, ['model_type' => get_class($newUser)]);
            }

            // Get the current user's brand
            $ownerId = Auth::id();
            $brand = Brand::with('branches.manager')->where('user_id', $ownerId)->first();

            // Add the new user to BrandStaff
            $brandStaff = BrandStaff::create([
                'user_id' => $newUser->id,
                'brand_id' => $brand->id,
            ]);

            // Commit the transaction if all steps are successful
            DB::commit();

            $notification = [
                'message' => 'User added successfully',
                'alert-type' => 'success',
            ];
        } catch (\Exception $e) {
            // Rollback the transaction if any step fails
            DB::rollBack();
            dd($e->getMessage());
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ];
        }

        return redirect()->route('staff')->with($notification);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ...
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = (int)$id;
        $data['staff'] = BrandStaff::with(['user.roles', 'user.branches'])->where('user_id', $id)->first();

        if (!$data['staff']) {
            abort(404);
        }
        $data['roles'] = Role::whereNotIn('name', ['admin', 'owner'])->get();

        return view('staff.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = (int)$id;

        $notification = null;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => ['required', 'not_in:admin,owner'],
            'password' => 'nullable|min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
        ]);

        // Start the database transaction
        DB::beginTransaction();

        try {
            // Find the user and update the basic information
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);

            // Update the user's password if provided
            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->input('password')),
                ]);
            }

            // Update the user's role
            $role = Role::where('name', $request->input('role'))->first();

            if ($role) {
                $user->syncRoles([$role->id]);
            }

            // Commit the transaction if all steps are successful
            DB::commit();

            $notification = [
                'message' => 'User updated successfully',
                'alert-type' => 'success',
            ];
        } catch (\Exception $e) {
            // Rollback the transaction if any step fails
            DB::rollBack();
            dd($e->getMessage());
            $notification = [
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ];
        }

        return redirect()->route('staff.edit', $id)->with($notification);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd($id);
        // $user = User::findOrFail($id);
        // dd($user);
        // $user->delete();
        
        // $notification = [
        //     'message' => 'User deleted',
        //     'alert-type' => 'success',
        // ];
        // return redirect()->route('staff', $id)->with($notification);
    }
}
