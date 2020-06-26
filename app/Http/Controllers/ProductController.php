<?php

namespace App\Http\Controllers;

use App\Helper\ProductHelper;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductHelper
     */
    private $productHelper;

    public function __construct(ProductHelper $productHelper)
    {
        $this->middleware('auth');
        $this->productHelper = $productHelper;
    }


    /**
     * Prepare a form for add / view / update product
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form()
    {
        return $this->productHelper->form();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function post(Request $request)
    {
        $this->authorize('isAuthorized', Product::class);
        return $this->productHelper->post($request);
    }


    /**
     * Delete a product
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $this->authorize('isAuthorized', Product::class);
        return $this->productHelper->delete($request->id);
    }

    /**
     * Get a product by id
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get(Request $request)
    {
        return $this->productHelper->get($request->id);
    }

    public function view(Request $request)
    {
        return $this->productHelper->view($request->id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all(Request $request)
    {
        return $this->productHelper->all($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $this->authorize('isAuthorized', Product::class);
        return $this->productHelper->put($request);
    }

    public function detailsJson(Request $request)
    {
        $id = null;
        if (isset($_POST['product_id'])) {
            $id = $_POST['product_id'];
        }

        /** @var Product $product */
        $product = Product::find($id);

        $productArray = [
            'stock' => $product->stock,
            'price' => $product->price,
        ];

        return json_encode($productArray);
    }
}
