<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionsCollection;
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
        return new TransactionsCollection(Transaction::all());
    }

    /**
     * Store a newly created transaction in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
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
            $validated = $validator->validated();
            $transaction = new Transaction;
            $transaction->text = $validated['text'];
            $transaction->amount = $validated['amount'];
            $transaction->save();
            return (new TransactionResource($transaction))
                ->response()
                ->setStatusCode(201);
        } else {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()
            ], 400);
        }
    }

    /**
     * Remove the specified transaction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {   
        Transaction::destroy($transaction->id);
        return response()->json([
            'success' => true,
            'data' => []
        ]);
    }
}
