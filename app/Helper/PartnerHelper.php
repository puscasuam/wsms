<?php


namespace App\Helper;


use App\Partner;
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
        $partners = Partner::paginate(6);
//        dd($partners);

//        if ($request->isMethod('post')) {
//            $pipeline = app(Pipeline::class)
//                ->send(Product::query())
//                ->through([
//                    Name::class,
//                    PriceFrom::class,
//                    PriceTo::class,
//                    StockFrom::class,
//                    StockTo::class,
//                    \App\QueryFilters\Product\Brand::class,
//                    \App\QueryFilters\Product\Gemstone::class,
//                    \App\QueryFilters\Product\Material::class,
//                    \App\QueryFilters\Product\Category::class,
//                    Location::class,
//
//                ])
//                ->thenReturn();
//
//            $products = $pipeline->get();
//        }

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
