@extends('layouts.includes.main')

@section('content')

    <!-- Data tables for Products -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Partners</h6>
        </div>
        <div class="card-body">

            <div class="card mb-4">

                <a class="nav-link collapsed card-header m-0 text-primary" href="#" data-toggle="collapse"
                   data-target="#collapseFilters"
                   aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa fas fa-filter"></i>
                    <span>Filters</span>
                </a>
                <div id="collapseFilters" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <form action="/partners" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-sm-6 pl-5">

                                    <!-- Filter CIF -->
                                    <div class="form-row form-group row">
                                        <label for="cif" class="col-sm-2 col-form-label">CIF</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="cif" name="cif"
                                                   value="{{ isset($filters->cif) ? $filters->cif : '' }}">
                                        </div>
                                    </div>

                                    <!-- Filter name -->
                                    <div class="form-row form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" name="name"
                                                   value="{{ isset($filters->name) ? $filters->name : '' }}">
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="button" class="btn" id="name_sort_button"
                                                    name="name_sort_button"
                                                    onclick="change_sort_direction($(this), '#name_sort')">
                                                <i class="fa fa-sort" aria-hidden="true"></i>
                                            </button>
                                            <input type="hidden" id="name_sort" name="name_sort" value="">
                                        </div>
                                    </div>

                                    <!-- Filter email -->
                                    <div class="form-row form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="email" name="email"
                                                   value="{{ isset($filters->email) ? $filters->email : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 pl-5">

                                    <!-- Filter mobile -->
                                    <div class="form-row form-group row">
                                        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="mobile" name="mobile"
                                                   value="{{ isset($filters->mobile) ? $filters->mobile : '' }}">
                                        </div>
                                    </div>


                                    <!-- Filter address -->
                                    <div class="form-row form-group row">
                                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="address" name="address"
                                                   value="{{ isset($filters->address) ? $filters->address : '' }}">
                                        </div>
                                    </div>

                                    <!-- Filter partner type -->
                                    <div class="form-row form-group row">
                                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                                        <div class="col-sm-8">
                                            <select style="width: 100%;" id="type" class="form-control" name="type">
                                                <option value="" ></option>
                                                <option value="1"
                                                        @if (isset($filters->type) && $filters->type === "1")
                                                        selected="selected"
                                                    @endif
                                                >Vendor</option>
                                                <option value="2"
                                                        @if (isset($filters->type) && $filters->type === "2")
                                                        selected="selected"
                                                    @endif
                                                >Customer</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col col-sm-12 pl-5">
                                    <button type="submit" class="btn btn-dark">Apply</button>
                                    <a class="btn btn-secondary" href="{{ route('partnersAll') }}">Reset</a>
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
                        <th>CIF</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($partners as $partner)
                        <tr>
                            <td> {{$partner->cif}} </td>
                            <td> {{$partner->name}} </td>
                            <td> {{$partner->email}} </td>
                            <td> {{$partner->mobile}} </td>
                            <td> {{$partner->address}} </td>
                            <td>
                                <div class="open">
                                    <button role="button" type="button" class="btn" data-toggle="dropdown">
                                        <i class="fa fa-bars"></i>
                                    </button>

                                    <ul class="dropdown-menu" style="text-align: left; padding-left: 20px">
                                        <li><a href="{{ URL('/partner/'. $partner->id . '/view')}}"><i
                                                    class="fa fa-eye"></i> View</a></li>
                                        <li><a href="{{ URL('/partner/'.$partner->id )}}"><i class="fa fa-cog"></i> Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" aria-label="Delete" data-toggle="modal" data-target="#deletePartnerModal-{{ $partner->id }}">
                                                <i class="fa fa-eraser"></i> Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Delete Partner Modal-->
                                <div class="modal fade" id="deletePartnerModal-{{ $partner->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel-{{ $partner->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel-{{ $partner->id }}">
                                                    Are you sure you want to delete the partner?
                                                </h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Select "Delete" below if you are ready to delete your selected partner.
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <a class="btn btn-primary" href="{{ URL('/partner/' . $partner->id )}}"
                                                   onclick="event.preventDefault(); document.getElementById('delete-partner-form-{{ $partner->id }}').submit();">Delete</a>
                                                <form id="delete-partner-form-{{ $partner->id }}" action="{{ URL('/partner/' . $partner->id )}}"
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
                {{$partners->links()}}

            </div>
        </div>
    </div>

@endsection

