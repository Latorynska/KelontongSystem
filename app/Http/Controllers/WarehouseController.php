<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use PDF;

use App\Models\Branch;
use App\Models\User;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $branch = User::with('branches')->findOrFail(Auth::id())->branches[0];
        $items = Item::where(["branch_id" => $branch->id])->get();
        // dd($user->branches[0]);

        $data['branch'] = $branch;
        $data['items'] = $items;
        return view('warehouse.index',$data);
    }

    public function data() {
        $user = auth()->user();
        $userRoles = $user->getRoleNames();
        $branches = null;
    
        if ($userRoles->contains('owner')) {
            // Assuming 'owner_id' is the correct foreign key in the Branch model
            $branches = Branch::where('owner_id', $user->id)->get();
        } elseif ($userRoles->contains('manager')) {
            // Use 'load' method to eager load the 'branches' relationship
            $user->load('branches');
            $branches = $user->branches;
        }
        $branches->load('manager');
        $data['branches'] = $branches;
        return view('warehouse.data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branch = User::with('branches')->findOrFail(Auth::id())->branches[0];
        $data['branch'] = $branch;
        return view('warehouse.item.create',$data);
    }

    public function transactionIndex()
    {
        
        $branch = User::with('branches')->findOrFail(Auth::id())->branches[0];
        $items = Item::where(["branch_id" => $branch->id])->get();
        
        $data['branch'] = $branch;
        $data['items'] = $items;
        return view('warehouse.transaction',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "branch_id" => "required",
            "kode_barang" => "required|unique:items",
            "name" => "required",
            // "stock" => "required|numeric|gt:0",
            "price" => "required|numeric|gt:0",
            "discount" => "required|numeric|gte:0|lte:100",
        ]);
        DB::beginTransaction();

        try {
            $item = Item::create([
                'branch_id' => $validated['branch_id'],
                'kode_barang' => $validated['kode_barang'],
                'name' => $validated['name'],
                'stock' => 0,
                'price' => $validated['price'],
                'discount' => $validated['discount'],
            ]);
            DB::commit();
            $notification = [
                'message' => 'Item created successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('warehouse')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            $notification = [
                'message' => 'Failed to create item',
                'alert-type' => 'error',
            ];

            return redirect()->route('warehouse.create')->withInput()->with($notification);
        }
    }

    public function transactionStore(Request $request)
    {
        $user_id = Auth::id();

        $validated = $request->validate([
            'branch_id' => 'required|numeric',
            'tanggal' => 'required|date',
            'item_id.*' => 'required|numeric',
            'price_at.*' => 'required|numeric|gt:0',
            'quantity.*' => 'required|numeric|gt:0',
            'item_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (empty($value)) {
                        $fail('At least one item_id is required.');
                    }
                },
            ],
        ]);

        try {
            DB::beginTransaction();

            $transaction = Transaction::create([
                'user_id' => $user_id,
                'branch_id' => $request->branch_id,
                'tanggal' => $request->tanggal,
                'type' => 'in',
            ]);

            foreach ($request->item_id as $index => $item_id) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $item_id,
                    'quantity' => $request->quantity[$index],
                    'price_at' => $request->price_at[$index],
                ]);

                $item = Item::find($item_id);

                if ($item) {
                    $item->update([
                        'stock' => $item->stock + $request->quantity[$index],
                    ]);
                }
            }

            DB::commit();
            
            $notification = [
                'message' => 'Transaksi Berhasil',
                'alert-type' => 'success',
            ];
            return redirect()->route('warehouse')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function branchData(string $id)
    {
        $branch = Branch::with('items')->findOrFail($id);
        $data['branch'] = $branch;
        // dd($data);
        return view ('warehouse.dataView', $data);
    }

    public function printBranchData(string $id){
        $branch = Branch::with('items')->findOrFail($id);
        $data['branch'] = $branch;
        // dd($data);
        $pdf = PDF::loadView('warehouse.print', $data);
        return $pdf->stream("item_stock_report_branch_".$branch->name.".pdf");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::findOrFail($id);
        $branch = User::with('branches')->findOrFail(Auth::id())->branches[0];
        $data['branch'] = $branch;
        $data['item'] = $item;
        // dd($data['item']);
        
        return view('warehouse.item.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            "branch_id" => "required",
            "name" => "required",
            "price" => "required|numeric|gt:0",
            "discount" => "required|numeric|gte:0|lte:100",
        ]);

        DB::beginTransaction();

        try {
            $item = Item::findOrFail($id);
            $item->update([
                'branch_id' => $validated['branch_id'],
                'name' => $validated['name'],
                'price' => $validated['price'],
                'discount' => $validated['discount'],
            ]);

            DB::commit();

            $notification = [
                'message' => 'Item updated successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('warehouse')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());

            $notification = [
                'message' => 'Failed to update item',
                'alert-type' => 'error',
            ];

            return redirect()->route('warehouse.edit', $id)->withInput()->with($notification);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
