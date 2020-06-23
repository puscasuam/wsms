<?php


namespace App\Http\Controllers;


use App\Helper\TransactionHelper;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * @var TransactionHelper
     */
    private $transactionHelper;

    public function __construct(TransactionHelper $transactionHelper)
    {
        $this->middleware('auth');
        $this->transactionHelper = $transactionHelper;
    }

    /**
     * @return Transaction[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(Request $request){

        return $this->transactionHelper->all($request);
    }
}
