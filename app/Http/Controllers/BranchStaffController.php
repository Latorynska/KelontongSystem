<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;


use App\Models\Branch;
use App\Models\BranchStaff;
use App\Models\BrandStaff;
use App\Models\User;

class BranchStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $manager_id = Auth::id();
        $branches = Branch::whereHas('manager', function ($query) use ($manager_id) {
            $query->where('users.id', $manager_id);
        })->withCount('staff')->get();
        
        $data['branches'] = $branches;
        return view('branch.manager.index', $data);
    }
    public function branch(string $id)
    {
        //
        $branch = Branch::findOrFail($id);

        $branch->load([
            'branchStaff' => function ($query) {
                $query->whereDoesntHave('user.roles', function ($roleQuery) {
                    $roleQuery->whereIn('name', ['Manager']);
                });
            }
        ]);
    
        $data['branch'] = $branch;
    
        
        $brandId = BrandStaff::where('user_id', Auth::id())->value('brand_id');

        $data['brandStaff'] = BrandStaff::where('brand_id', $brandId)
        ->whereDoesntHave('user.roles', function ($roleQuery) {
            $roleQuery->whereIn('name', ['Manager', 'Owner']);
        })
        ->whereDoesntHave('user.branches', function ($branchQuery) use ($id) {
            $branchQuery->where('branch_id', $id);
        })
        ->with('user.roles')
        ->get()
        ->pluck('user');

        return view('branch.manager.staff', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $data['branch'] = Branch::findOrFail($id);
        $data['roles'] = Role::whereNotIn('name', ['admin', 'owner','manager'])->get();

        return view('branch.manager.create', $data);
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
            'role' => ['required', 'not_in:admin,owner,manager'],
            'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*\d).+$/',
        ]);
        // dd($brand);
        // Start the database transaction
        DB::beginTransaction();

        try {
            // Get the current user's brand using the relation in BrandStaff
            $brandStaff = BrandStaff::where('user_id', Auth::id())->first();

            if (!$brandStaff) {
                throw new \Exception('User does not have associated BrandStaff.');
            }

            // Get the brand from BrandStaff
            $brand_id = $brandStaff->brand_id;

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

            // Add the new user to BrandStaff
            $brandStaff = BrandStaff::create([
                'user_id' => $newUser->id,
                'brand_id' => $brand_id,
            ]);

            $branchStaff = BranchStaff::create([
                "branch_id" => $request->branch_id,
                "user_id" => $newUser->id,
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

        return redirect()->route('branchstaff')->with($notification);
    }


    public function assign(Request $request, string $branchId){
        $newBranchStaff = BranchStaff::create([
            'user_id' => $request->user_id,
            'branch_id' => $branchId,
        ]);
        
        $notification = [
            'message' => 'User added successfully',
            'alert-type' => 'success',
        ];
        
        return redirect()->route('branchstaff.branch',['id'=>$branchId])->with($notification);
    }

    public function remove(string $id){
        // dd($id);
        $branchStaff = BranchStaff::findOrFail($id);
        $branchStaff->delete();
        $notification = [
            'message' => 'Staff removed successfully',
            'alert-type' => 'success',
        ];
        
        return back()->with($notification);
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
        $id = (int)$id;
        $data['staff'] = BrandStaff::with(['user.roles', 'user.branches'])->where('user_id', $id)->first();

        if (!$data['staff']) {
            abort(404);
        }
        $data['roles'] = Role::whereNotIn('name', ['admin', 'owner','manager'])->get();

        return view('branch.manager.edit', $data);
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
            'role' => ['required', 'not_in:admin,owner,manager'],
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

        return redirect()->route('branchstaff')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
