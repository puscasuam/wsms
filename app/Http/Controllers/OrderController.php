<?php


namespace App\Http\Controllers;


use App\Helper\OrderHelper;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * @var OrderHelper
     */
    private $orderHelper;

    public function __construct(OrderHelper $orderHelper)
    {
        $this->orderHelper = $orderHelper;
    }


    /**
     * Prepare a form for add / update order
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form()
    {
        return $this->orderHelper->form();
    }

    /**
     * @return Order[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(Request $request){
        return $this->orderHelper->all($request);
    }


    /**
     * Delete a order
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request){
        return $this->orderHelper->delete($request->id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(Request $request)
    {
        return $this->orderHelper->post($request);
    }

}
