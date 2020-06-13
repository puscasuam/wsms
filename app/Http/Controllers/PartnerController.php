<?php


namespace App\Http\Controllers;

use App\Helper\PartnerHelper;
use Illuminate\Http\Request;


class PartnerController extends Controller
{

    private $partnerHelper;

    public function __construct(PartnerHelper $partnerHelper)
    {
        $this->partnerHelper = $partnerHelper;
    }

    public function form()
    {
        return $this->partnerHelper->form();
    }

    public function get(Request $request){
        return $this->partnerHelper->get($request->id);
    }

    public function view(Request $request){
        return $this->partnerHelper->view($request->id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(Request $request)
    {
        return $this->partnerHelper->post($request);
    }

    /**
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(Request $request){
        return $this->partnerHelper->all($request);
    }

    /**
     * Delete a partner
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request){
        return $this->partnerHelper->delete($request->id);
    }
}