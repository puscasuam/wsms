<?php


namespace App\Helper;


use App\Partner;
use App\QueryFilters\Partner\Address;
use App\QueryFilters\Partner\Cif;
use App\QueryFilters\Partner\Email;
use App\QueryFilters\Partner\Mobile;
use App\QueryFilters\Partner\Name;
use App\QueryFilters\Partner\NameSort;
use App\QueryFilters\Partner\Type;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Http\Request;

class PartnerHelper implements InterfaceHelper
{

    public function form($partner = null, $type = 'new')
    {
        return view('/partner/new', [
            'partner' => $partner,
            'type' => $type,
        ]);
    }

    /**
     * Get a partner - used for editing the partner
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
     * Get a partner - used for view a partner
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(int $id)
    {
        $partner = Partner::find($id);

        return view('/partner/view', [
            'partner' => $partner,
        ]);


        $partner = Partner::find($id);
        if ($partner) {
            return $this->form($partner, 'view');
        }
    }


    public function all(Request $request)
    {
        if($request->isMethod('get')){

            $pipeline = app(Pipeline::class)
                ->send(Partner::query())
                ->through([
                    Address::class,
                    Cif::class,
                    Email::class,
                    Mobile::class,
                    Name::class,
                    Type::class,
                    NameSort::class,
                ])
                ->thenReturn();

            $partners = $pipeline->paginate(5);
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
                    NameSort::class,

                ])
                ->thenReturn();

            $partners = $pipeline->paginate(5);
        }

        return view('partner/all', [
            'partners' => $partners,
            'filters' => $request,
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
            'mobile' => 'required | regex:/(0)[0-9]{9}/',
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
        $dataValidation = $request->validate([
            'cif' => 'required | max:8',
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required | regex:/(0)[0-9]{9}/',
            'address' => 'required',
        ]);

        //Update employee
        $partner = Partner::find($request->id);
        $partner->cif = $request->cif;
        $partner->name = $request->name;
        $partner->email = $request->email;
        $partner->mobile = $request->mobile;
        $partner->address = $request->address;
        $partner->save();

        return redirect()->route('partnersAll');
    }

    public function delete(int $id)
    {
        $partner = Partner::find($id);
        if ($partner) {
            $partner->delete();
        }
        return redirect()->back();
    }


    /**
     * Check if CIF is unique
     *
     * @param string $partnerCif
     * @return bool
     */
    public function checkUniquePartnerCif(string $partnerCif)
    {
        // Get Partner with specified cif
        $partners = Partner::withTrashed()
            ->where('cif', $partnerCif)
            ->get();

        if ($partners->count() > 0) {
            return true;
        }

        return false;
    }
}
