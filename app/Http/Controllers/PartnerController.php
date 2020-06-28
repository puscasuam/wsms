<?php


namespace App\Http\Controllers;

use App\Helper\PartnerHelper;
use App\Partner;
use Illuminate\Http\Request;


class PartnerController extends Controller
{

    private $partnerHelper;

    public function __construct(PartnerHelper $partnerHelper)
    {
        $this->middleware('auth');
        $this->partnerHelper = $partnerHelper;
    }

    public function form()
    {
        return $this->partnerHelper->form();
    }

    public function get(Request $request)
    {
        return $this->partnerHelper->get($request->id);
    }

    public function view(Request $request)
    {
        return $this->partnerHelper->view($request->id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function post(Request $request)
    {
        $this->authorize('isAuthorized', Partner::class);
        return $this->partnerHelper->post($request);
    }

    /**
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(Request $request)
    {
        return $this->partnerHelper->all($request);
    }

    /**
     * Delete a partner
     *
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Request $request)
    {
        $this->authorize('isAuthorized', Partner::class);
        return $this->partnerHelper->delete($request->id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request)
    {
        $this->authorize('isAuthorized', Partner::class);
        return $this->partnerHelper->put($request);
    }

    public function checkUniquePartnerCif(Request $request)
    {
        return json_encode($this->partnerHelper->checkUniquePartnerCif($request->partner_cif));
    }

}
