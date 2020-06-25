<?php

namespace App\Helper;

use App\Employee;
use App\Mail\WelcomeMail;
use App\QueryFilters\employee\Email;
use App\QueryFilters\employee\Firstname;
use App\QueryFilters\employee\FirstnameSort;
use App\QueryFilters\employee\Lastname;
use App\QueryFilters\employee\LastnameSort;
use App\QueryFilters\employee\Mobile;
use App\QueryFilters\employee\Role;
use App\QueryFilters\employee\Username;
use App\QueryFilters\employee\UsernameSort;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pipeline\Pipeline;

class EmployeeHelper implements InterfaceHelper
{

    public function form($employee = null, $type = 'new')
    {
        if ($type == 'edit' || $type == 'view') {
            $employee->image = ImageHelper::pngToBase64('employee', $employee->image);
        }

        return view('/employee/new', [
            'employee' => $employee,
            'type' => $type,
        ]);
    }

    /**
     * Get an employee - used for editing the employee
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get(int $id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            return $this->form($employee, 'edit');
        }
    }

    /**
     * Get an employee - used for view a product
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(int $id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            return $this->form($employee, 'view');
        }
    }

    public function all(Request $request)
    {
        $employees = Employee::all();
        $users = User::all();

        if($request->isMethod('get')){
//            $employees = Employee::paginate(8);

            $pipeline = app(Pipeline::class)
                ->send(Employee::query())
                ->through([
                    Firstname::class,
                    Lastname::class,
                    Email::class,
                    Mobile::class,
                    Username::class,
                    Role::class,
                    FirstnameSort::class,
                    LastnameSort::class,
                    UsernameSort::class,
                ])
                ->thenReturn();

            $employees = $pipeline->paginate(8);
        }

        if ($request->isMethod('post')) {
            $pipeline = app(Pipeline::class)
                ->send(Employee::query())
                ->through([
                    Firstname::class,
                    Lastname::class,
                    Email::class,
                    Mobile::class,
                    Username::class,
                    Role::class,
                    FirstnameSort::class,
                    LastnameSort::class,
                    UsernameSort::class,
                ])
                ->thenReturn();

            $employees = $pipeline->paginate(8);
        }

        return view('employee/all', [
            'employees' => $employees,
            'users' => $users,
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
            'username'=> 'required',
            'firstName' => 'required | min:2',
            'lastName' => 'required | min:2',
            'mobile' => 'required | regex:/(0)[0-9]{9}/',
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => 'required',
            'image.*' => 'required | string',

        ]);

        // Create new employee
        $employee = new Employee();
        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->mobile = $request->mobile;
        $employee->admin = $request->role === "1" ? 1 : 0;
        $employee->image = $request->email . '.png';
        $employee->save();

        // Create new user for added employee
        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->employee_id = $employee->id;
        $user->save();

        // Save image in public/storage/employee
        ImageHelper::base64ToPng('employee', $request->image['body'], $employee->image);

        // Sending email for activate employee account
        Mail::to($user->email)->send(new WelcomeMail());

        return redirect()->route('employeesAll');
    }

    public function put(Request $request)
    {
        // TODO: Implement put() method.
    }

    public function delete(int $id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->delete();
        }
        return redirect()->back();
    }

}
