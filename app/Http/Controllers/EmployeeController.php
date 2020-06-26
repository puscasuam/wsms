<?php


namespace App\Http\Controllers;

use App\Employee;
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
        $this->authorize('create', Employee::class);
        return $this->employeeHelper->post($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all(Request $request){
        return $this->employeeHelper->all($request);
    }

    /**
     * Delete an employee
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request){
        $this->authorize('delete', $request);
        return $this->employeeHelper->delete($request->id);
    }

    /**
     * Get an employee by id
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get(Request $request){
        return $this->employeeHelper->get($request->id);
    }

    public function view(Request $request){
        return $this->employeeHelper->view($request->id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        $this->authorize('update', $request);
        return $this->employeeHelper->put($request);
    }
}
