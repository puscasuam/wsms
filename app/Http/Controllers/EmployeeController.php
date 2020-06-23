<?php


namespace App\Http\Controllers;

use App\Helper\EmployeeHelper;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    /**
     * @var EmployeeHelper
     */
    private $employeeHelper;

    public function __construct(EmployeeHelper $employeeHelper)
    {
        $this->middleware('auth');
        $this->employeeHelper = $employeeHelper;
    }


    /**
     * Prepare a form for add / view / update employee
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form()
    {
        return $this->employeeHelper->form();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(Request $request)
    {
        return $this->employeeHelper->post($request);
    }

    /**
     * @return Employee[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(Request $request){
        return $this->employeeHelper->all($request);
    }

}
