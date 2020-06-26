@extends('layouts.includes.main')

@section('content')

    <!-- Data tables for Employees -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Employees</h6>
        </div>
        <div class="card-body">

            <div class="card mb-4">

                <a class="nav-link collapsed card-header m-0 text-balck" href="#" data-toggle="collapse"
                   data-target="#collapseFilters"
                   aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa fas fa-filter"></i>
                    <span>Filters</span>
                </a>
                <div id="collapseFilters" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <form action="/employees" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-sm-6 pl-5">

                                    <!-- Filter Firstname -->
                                    <div class="form-row form-group row">
                                        <label for="firstname" class="col-sm-2 col-form-label">First name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="firstname" name="firstname"
                                                   value="{{ isset($filters->firstname) ? $filters->firstname : '' }}">
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn" id="firstname_sort_button"
                                                    name="firstname_sort_button"
                                                    onclick="change_sort_direction($(this), '#firstname_sort')">
                                                <i class="fa fa-sort" aria-hidden="true"></i>
                                            </button>
                                            <input type="hidden" id="firstname_sort" name="firstname_sort" value="">
                                        </div>
                                    </div>

                                    <!-- Filter Lastname -->
                                    <div class="form-row form-group row">
                                        <label for="lastname" class="col-sm-2 col-form-label">Last name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="lastname" name="lastname"
                                                   value="{{ isset($filters->lastname) ? $filters->lastname : '' }}">
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn" id="lastname_sort_button"
                                                    name="lastname_sort_button"
                                                    onclick="change_sort_direction($(this), '#lastname_sort')">
                                                <i class="fa fa-sort" aria-hidden="true"></i>
                                            </button>
                                            <input type="hidden" id="lastname_sort" name="lastname_sort" value="">
                                        </div>
                                    </div>

                                    <!-- Filter username -->
                                    <div class="form-row form-group row">
                                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="username" name="username"
                                                   value="{{ isset($filters->username) ? $filters->username : '' }}">
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn" id="username_sort_button"
                                                    name="username_sort_button"
                                                    onclick="change_sort_direction($(this), '#username_sort')">
                                                <i class="fa fa-sort" aria-hidden="true"></i>
                                            </button>
                                            <input type="hidden" id="username_sort" name="username_sort" value="">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-6 pl-5">

                                    <!-- Filter Email -->
                                    <div class="form-row form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="email" name="email"
                                                   value="{{ isset($filters->email) ? $filters->email : '' }}">
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>

                                    <!-- Filter Mobile -->
                                    <div class="form-row form-group row">
                                        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="mobile" name="mobile"
                                                   value="{{ isset($filters->mobile) ? $filters->mobile : '' }}">
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>

                                    <!-- Filter role -->
                                    <div class="form-row form-group row">
                                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                                        <div class="col-sm-8">
                                            <select style="width: 100%;" id="role" class="form-control" name="role">
                                                <option value=""></option>
                                                <option value="1"
                                                        @if (isset($filters->role) && $filters->role === "1")
                                                        selected="selected"
                                                    @endif
                                                >Admin
                                                </option>
                                                <option value="0"
                                                        @if (isset($filters->role) && $filters->role === "0")
                                                        selected="selected"
                                                    @endif
                                                >Regular
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-sm-1"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-sm-12 pl-5">
                                    <button type="submit" class="btn btn-dark">Apply</button>
                                    <a class="btn btn-secondary" href="{{ route('employeesAll') }}">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="card-header">
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td> {{$employee->firstname}} </td>
                            <td> {{$employee->lastname}} </td>
                            <td> {{$employee->user->email}} </td>
                            <td> {{$employee->mobile}} </td>
                            <td> {{$employee->user->name}} </td>
                            <td> {{ ($employee->admin) ? "Admin" : "Regular"}} </td>
                            <td>
                                <div class="open">
                                    <button role="button" type="button" class="btn" data-toggle="dropdown">
                                        <i class="fa fa-bars"></i>
                                    </button>

                                    <ul class="dropdown-menu" style="text-align: left; padding-left: 20px">
                                        <li><a href="{{ URL('/employee/'. $employee->id . '/view')}}"><i
                                                    class="fa fa-eye"></i> View</a></li>
                                        @can('update', $employee)
                                            <li><a href="{{ URL('/employee/'.$employee->id )}}"><i
                                                        class="fa fa-cog"></i>
                                                    Edit</a>
                                            </li>
                                        @endcan
                                        @can('delete', $employee)
                                            <li>
                                                <a href="#" aria-label="Delete" data-toggle="modal"
                                                   data-target="#deleteEmployeeModal-{{ $employee->id}}">
                                                    <i class="fa fa-eraser"></i> Delete
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>

                                <!-- Delete Employee Modal-->
                                <div class="modal fade" id="deleteEmployeeModal-{{ $employee->id }}" tabindex="-1"
                                     role="dialog"
                                     aria-labelledby="exampleModalLabel-{{ $employee->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel-{{ $employee->id }}">
                                                    Are you sure you want to delete the employee?
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Select "Delete" below if you are ready to delete your selected employee.
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <a class="btn btn-primary"
                                                   href="{{ URL('/employee/' . $employee->id )}}"
                                                   onclick="event.preventDefault(); document.getElementById('delete-employee-form-{{ $employee->id }}').submit();">Delete</a>
                                                <form id="delete-employee-form-{{ $employee->id }}"
                                                      action="{{ URL('/employee/' . $employee->id )}}"
                                                      method="post" style="display: none;">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                {{ $employees->appends(request()->input())->links()}}
            </div>
        </div>
    </div>

@endsection
