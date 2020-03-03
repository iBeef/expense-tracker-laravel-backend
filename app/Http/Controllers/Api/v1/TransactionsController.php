<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Transaction;

// use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the transactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if($transactions = Transaction::all()) {
        //     $count = count($transactions);
        //     return response()->json([
        //         'success' => true,
        //         'count' => $count,
        //         'data' => $transactions
        //     ]);
        // } else {
        //     response()->json([
        //         'success' => false,
        //         'error' => 'Server Error'
        //     ], 500);
        // }
        return TransactionResource::collection(Transaction::all());

    }

    /**
     * Store a newly created transaction in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        try {
            $rules = [
                'text' => 'required|max:255',
                'amount' => 'required|numeric'
            ];
            $customMessages = [
                'text.required' => "Please add some text",
                'amount.required' => "Please add a positive or negative number",
            ];
            $validator = Validator::make($request->all(), $rules, $customMessages);

            if(!$validator->fails()) {
                $transaction = new Transaction;
                $transaction->text = $validator->validated()['text'];
                $transaction->amount = $validator->validated()['amount'];
                $transaction->save();
                return response()->json([
                    'success' => true,
                    'data' => $transaction->toArray()
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'error' => $validator->errors()
                ], 400);
            }
        } catch(Exception $e) {
            response()->json([
                'success' => false,
                'error' => 'Server Error'
            ], 500);
        }
    }

    /**
     * Remove the specified transaction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $id = 1;
        $transaction = Transaction::find($id);
        if($transaction) {
            return "found";
        } else {
            return "not found";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    public function show(Transaction $transaction)
    {
        // var_dump($transaction);
        // return new TransactionResource(Transaction::findOrFail($id));
        return new TransactionResource($transaction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    
}
