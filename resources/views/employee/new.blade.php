@extends('layouts.includes.main')


@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <input type="hidden" id="employee-form-type" value="{{$type}}"/>

            @if ($type == 'new')
                <h6 class="m-0 font-weight-bold text-dark">Add new employee</h6>
            @elseif ($type == 'edit')
                <h6 class="m-0 font-weight-bold text-dark">Edit employee</h6>
            @else ()
                <h6 class="m-0 font-weight-bold text-dark">View employee</h6>
            @endif

        </div>
        <div class="card-body">
            <form id="employee-form" action="/employee" method="post" class="form-horizontal row-fluid">
                @csrf

                @if ($type == 'edit')
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{ $employee->id }}">
                @endif

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">
                        <div class="form-row form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                       id="username" name="username"
                                       value="{{ isset($employee->user->name) ? $employee->user->name : '' }}"
                                       placeholder="Enter username" autocomplete="off">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="firstName" class="col-sm-2 col-form-label">First name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('firstName') is-invalid @enderror"
                                       id="firstName" name="firstName"
                                       value="{{ isset($employee->firstname) ? $employee->firstname : '' }}"
                                       placeholder="Enter first name" autocomplete="off">
                                @error('firstName')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row form-group row">
                            <label for="lastName" class="col-sm-2 col-form-label">Last name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                                       id="lastName" name="lastName"
                                       value="{{ isset($employee->lastname) ? $employee->lastname : '' }}"
                                       placeholder="Enter last name" autocomplete="off">
                                @error('lastName')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                       id="mobile" name="mobile"
                                       value="{{ isset($employee->mobile) ? $employee->mobile : '' }}"
                                       placeholder="Enter mobile phone" autocomplete="off">
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if ($type == 'new')
                            <div class="form-row form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email"
                                           value="{{ isset($employee->user->email) ? $employee->user->email : '' }}"
                                           placeholder="Enter email" autocomplete="off"
                                           onchange="check_unique_user_email($(this))">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password" name="password"
                                           placeholder="Enter password" autocomplete="off">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row form-group row">
                                <label for="confirm-password" class="col-sm-2 col-form-label">Confirm password</label>
                                <div class="col-sm-8">
                                    <input type="password"
                                           class="form-control @error('confirm-password') is-invalid @enderror"
                                           id="password-confirmation"
                                           name="password_confirmation"
                                           placeholder="Confirm password" autocomplete="off">
                                    @error('confirm-password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="form-row form-group row">
                            <label for="role" class="col-sm-2 col-form-label">Is admin</label>
                            <div class="col-sm-8">
                                <select style="width: 100%;" id="role" class="form-control" name="role">
                                    <option value=""></option>
                                    <option value="1"
                                            @if (isset($employee->admin) && $employee->admin === 1)
                                            selected="selected"
                                        @endif
                                    >Admin
                                    </option>
                                    <option value="0"
                                            @if (isset($employee->admin) && $employee->admin === 0)
                                            selected="selected"
                                        @endif
                                    >Regular
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="wrapper">
                            <div class="box" id="box-image">
                                @if ($type == 'edit' || $type == 'view')
                                    <div class="js--image-preview js--no-default"
                                         style="background-image: url({{ $employee->image }})"></div>
                                @else
                                    <div class="js--image-preview"></div>
                                @endif
                                <div class="upload-options">
                                    <label>
                                        @if ($type == 'edit')
                                            <input type="file" class="image-upload" name="image[name]" accept="image/*"
                                                   value="{{ $employee->user->email . '.png' }}"/>
                                            <input type="hidden" id="image-body" name="image[body]"
                                                   value="{{ $employee->image }}"/>
                                        @else
                                            <input type="file" class="image-upload" name="image[name]"
                                                   accept="image/*"/>
                                            <input type="hidden" id="image-body" name="image[body]" value=""/>
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div class="validation"
                                 style="margin-left: 10px;">@error('image[name]') {{$message}} @enderror </div>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col">
                        @if ($type == 'new')
                            <button type="submit" class="btn btn-dark">Add employee</button>
                        @elseif($type == 'edit')
                            <button type="submit" class="btn btn-dark">Edit employee</button>
                        @endif
                        <a href="{{ URL::route('employeesAll') }}" class="btn btn-secondary float-right">Back</a>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </form>
        </div>
    </div>

@endsection
