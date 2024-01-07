<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use App\Models\Branch;
use App\Models\User;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branch = User::with('branches')->findOrFail(Auth::id())->branches[0];
        $items = Item::where(["branch_id" => $branch->id])->get();
        // dd($user->branches[0]);

        $data['branch'] = $branch;
        $data['items'] = $items;
        return view('transaction.index',$data);
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
        return view('transaction.data',$data);
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
        $request->merge([
            'transactionItems' => json_decode($request->input('transactionItems'), true),
        ]);
        // dd($request->transactionItems);
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'transactionItems' => 'required|array',
            'transactionItems.*.id' => 'required|exists:items,id',
            'transactionItems.*.quantity' => 'required|integer|min:1',
            'tanggal' => 'required|date_format:Y-m-d\TH:i',
        ]);
        DB::beginTransaction();

        try {
            $user_id = Auth::id();
            $transaction = Transaction::create([
                'user_id' => $user_id,
                'branch_id' => $request->branch_id,
                'tanggal' => $request->tanggal,
                'type' => 'out',
            ]);

            foreach ($request->transactionItems as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price_at' => $item['price_at'],
                ]);

                $itemModel = Item::find($item['id']);
                if ($itemModel) {
                    $itemModel->update([
                        'stock' => $itemModel->stock - $item['quantity'],
                    ]);
                }
            }

            DB::commit();
            $notification = [
                'message' => 'Transaction created successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('transaction')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            $notification = [
                'message' => 'Failed to create transaction',
                'alert-type' => 'error',
            ];

            return redirect()->route('transaction')->withInput()->with($notification);
        }
    }



    /**
     * Display the specified resource.
     */

    public function branchData(string $id){
        $branch = Branch::with('transactions')->findOrFail($id);
        $branch->transactions->each(function ($transaction) {
            $transaction->totalPrice = $transaction->totalPrice();
            $transaction->userName = $transaction->user->name;
        });
        $data['branch'] = $branch;
        // dd($data);
        return view ('transaction.dataView', $data);
    }

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
