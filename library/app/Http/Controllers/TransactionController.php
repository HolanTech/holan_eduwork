<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transactions = Transaction::with('member');

        // filter by status
        $transactions->when($request->status, function ($query, $status) {
            return $query->where('status', $status);
        });

        // filter by date
        $transactions->when($request->date, function ($query, $date) {
            return $query->where('date_start', '>=', $date);
        });

        $transactions = $transactions->get();

        return view('admin.transaction.index', compact('transactions'));
    }


    public function api()
    {
        $transactions = Transaction::select(
            'transactions.id as transaction_id',
            'members.name',
            'transactions.date_start',
            'transactions.date_end',
            'transactions.status',
            TransactionDetail::raw('count(transaction_details.transaction_id) as total_book'),
            TransactionDetail::raw('(count(transaction_details.transaction_id) * 2000) as total_price')
        )
            ->leftJoin('members', 'transactions.member_id', '=', 'members.id')
            ->leftJoin('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->groupBy('transactions.id', 'members.name', 'transactions.date_start', 'transactions.date_end', 'transactions.status')
            ->get();

        $datatables = datatables()->of($transactions)
            ->addColumn('period', function ($transaction) {
                $startTimeStamp = strtotime($transaction->date_start);
                $endTimeStamp = strtotime($transaction->date_end);

                $timeDiff = abs($endTimeStamp - $startTimeStamp);

                $numberDays = $timeDiff / 86400;  // 86400 seconds in one day

                // and you might want to convert to integer
                $numberDays = intval($numberDays);

                return $numberDays;
            })
            ->addColumn('status_transaction', function ($transaction) {
                $status_validate = validate_boolean($transaction->status);

                $status_transaction = validate_transactionStatus($status_validate);
                return $status_transaction;
            })
            ->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();
        $books = Book::where('qty', '>', '0')->get();
        return view('admin.transaction.create', compact('members', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'member_id' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'book_id' => 'required|array|min:1',
            'book_id.*' => 'required|distinct',
        ]);

        try {
            DB::beginTransaction();

            $transaction = new Transaction;
            $transaction->member_id = $validatedData['member_id'];
            $transaction->date_start = $validatedData['date_start'];
            $transaction->date_end = $validatedData['date_end'];
            $transaction->save();

            $total_book = count($validatedData['book_id']);

            if ($total_book > 0) {
                foreach ($validatedData['book_id'] as $item => $value) {
                    $book = Book::find($value);

                    if ($book->qty > 0) {
                        $transactionDetail = new TransactionDetail;
                        $transactionDetail->transaction_id = $transaction->id;
                        $transactionDetail->book_id = $value;
                        $transactionDetail->qty = 1; // set default qty to 1
                        $transactionDetail->save();

                        $book->qty = $book->qty - 1;
                        $book->save();
                    }
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to create transaction. ' . $th->getMessage());
        }

        return redirect('transactions')->with('status', 'Transaction created successfully!');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {

        $transactionDetails = Transaction::with('member', 'transaction_details')->where('id', $transaction->id)->first();
        $books = TransactionDetail::select('books.title')
            ->leftJoin('books', 'transaction_details.book_id', '=', 'books.id')
            ->where('transaction_id', $transaction->id)->get();

        //return $books;
        return view('admin.transaction.detail', compact('transactionDetails', 'transaction', 'books'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $members = Member::all();
        $books = Book::where('qty', '>', '0')->get();

        $transaction_id = $transaction->id;

        $select = TransactionDetail::select('*')->where('transaction_id', '=', $transaction_id)->pluck('book_id');
        $select_books = json_decode(json_encode($select), true);

        $transactionDetail = new TransactionDetail(); // create a new instance of TransactionDetail
        $transactionDetail->qty = 1; // set default qty to 1

        return view('admin.transaction.edit', compact('transaction', 'members', 'books', 'select_books', 'transactionDetail'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->all();

        $updated = validate_boolean($data['status'] != $transaction->status);
        TransactionDetail::where('transaction_id', $transaction->id)->delete();

        try {
            \DB::beginTransaction();

            $transaction->update([
                'member_id' => $data['member_id'],
                'date_start' => $data['date_start'],
                'date_end' => $data['date_end'],
                'status' => $data['status'],
            ]);

            $status = $transaction->status;
            $newStatus = $transaction->status;
            $status1 = validate_boolean($status);
            $total_book = count($data['book_id']);

            if ($total_book > 0) {
                foreach ($data['book_id'] as $item => $value) {
                    $data2 = array(
                        'transaction_id' => $transaction->id,
                        'book_id' => $data['book_id'][$item],
                    );

                    if ($updated == true) {
                        $qty = Book::select('qty')->where('id', '=', $data['book_id'][$item])->pluck('qty');
                        $newQty = update_stock1($qty, $status1);
                        Book::where('id', '=', $data['book_id'][$item])->update(['qty' => $newQty]);
                    }

                    // calculate the total qty of books for this transaction detail
                    $total_qty = 0;
                    foreach ($data['book_id'] as $book_id) {
                        if ($book_id == $data2['book_id']) {
                            $total_qty += 1;
                        }
                    }
                    $data2['qty'] = $total_qty;

                    TransactionDetail::create($data2);
                }
            }

            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            return redirect('transactions')->with('error', $th->getMessage());
        }

        return redirect('transactions')->with('status', 'Transaction created successfully!');
    }


    public function destroy(Transaction $transaction)
    {
        $transactionDetails = TransactionDetail::where('transaction_id', $transaction->id)->get();

        try {
            DB::beginTransaction();

            foreach ($transactionDetails as $detail) {
                $book = Book::find($detail->book_id);

                if ($transaction->status == 'returned') {
                    // jika status sudah dikembalikan, tidak mengubah qty buku
                    $book->qty += 0;
                } else {
                    $book->qty += $detail->qty;
                }

                $book->save();

                $detail->delete();
            }

            $transaction->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to delete transaction. ' . $th->getMessage());
        }

        return redirect('transactions')->with('status', 'Transaction deleted successfully!');
    }
}
