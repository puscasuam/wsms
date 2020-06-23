<?php


namespace App\Helper;


use App\Partner;
use App\QueryFilters\Partner\Address;
use App\QueryFilters\Partner\Cif;
use App\QueryFilters\Partner\Email;
use App\QueryFilters\Partner\Mobile;
use App\QueryFilters\Partner\Name;
use App\QueryFilters\Partner\Type;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Http\Request;

class PartnerHelper implements InterfaceHelper
{

    public function form($partner = null, $type = 'new')
    {
        $partner = Partner::all();

        return view('/partner/new', [
            'partner' => $partner,
            'type' => $type,
        ]);
    }

    /**
     * Get a product - used for editing the product
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get(int $id)
    {
        $partner = Partner::find($id);
        if ($partner) {
            return $this->form($partner, 'edit');
        }
    }

    /**
     * Get a product - used for view a partner
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(int $id)
    {
        $partner = Partner::find($id);
        if ($partner) {
            return $this->form($partner, 'view');
        }
    }


    public function all(Request $request)
    {

        if($request->isMethod('get')){
            $partners = Partner::paginate(6);

//            $pipeline = app(Pipeline::class)
//                ->send(Product::query())
//                ->through([
//                    NameSort::class,
//                    BrandSort::class,
//                    PriceSort::class,
//                    StockSort::class,
//                ])
//                ->thenReturn();
//
//            $products = $pipeline->paginate(5);
        }


        if ($request->isMethod('post')) {
            $pipeline = app(Pipeline::class)
                ->send(Partner::query())
                ->through([
                    Address::class,
                    Cif::class,
                    Email::class,
                    Mobile::class,
                    Name::class,
                    Type::class,

                ])
                ->thenReturn();

            $partners = $pipeline->paginate(5);
        }

        return view('partner/all', [
            'partners' => $partners,
        ]);

    }

    /**
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(Request $request)
    {
        $data = $request->validate([
            'cif' => 'required | max:8',
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        $partner= new Partner();
        $partner->cif = $request->cif;
        $partner->name = $request->name;
        $partner->email = $request->email;
        $partner->mobile = $request->mobile;
        $partner->address = $request->address;
        $partner->save();

        return redirect()->route('partnersAll');
    }

    public function put(Request $request)
    {
        // TODO: Implement put() method.
    }

    public function delete(int $id)
    {
        $partner = Partner::find($id);
        if ($partner) {
            $partner->delete();
        }
        return redirect()->back();
    }
}
