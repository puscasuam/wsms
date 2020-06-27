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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all(Request $request){

        return $this->transactionHelper->all($request);
    }

    public function get(Request $request){
        return $this->transactionHelper->get($request->id);
    }

    public function view(Request $request){
        $this->authorize('isAuthorized', Transaction::class);
        return $this->transactionHelper->view($request->id);
    }


    public function update(Request $request){
        $this->authorize('isAuthorized', Transaction::class);
        return $this->transactionHelper->put($request);
    }

    public function paid(Request $request)
    {
        $this->authorize('isAuthorized', Transaction::class);
        return $this->transactionHelper->paid($request->id);
    }

    public function canceled(Request $request)
    {
        $this->authorize('isAuthorized', Transaction::class);
        return $this->transactionHelper->canceled($request->id);
    }
}
