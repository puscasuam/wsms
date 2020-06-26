<?php


namespace App\Http\Controllers;


use App\Helper\OrderHelper;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * @var OrderHelper
     */
    private $orderHelper;

    public function __construct(OrderHelper $orderHelper)
    {
        $this->middleware('auth');
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
    public function all(Request $request)
    {
        return $this->orderHelper->all($request);
    }


    /**
     * Delete a order
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $this->authorize('isAuthorized', Order::class);
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

    /**
     * Get a product by id
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get(Request $request)
    {
        return $this->orderHelper->get($request->id);
    }

    /**
     * @param Request $request
     */
    public function view(Request $request)
    {
        return $this->orderHelper->view($request->id);
    }

}
