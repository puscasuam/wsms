@extends('layouts.includes.main')


@section('content')

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <input type="hidden" id="product-form-type" value="{{$type}}"/>

            @if ($type == 'new')
                <h6 class="m-0 font-weight-bold text-primary">Add new employee</h6>
            @elseif ($type == 'edit')
                <h6 class="m-0 font-weight-bold text-primary">Edit employee</h6>
            @else ()
                <h6 class="m-0 font-weight-bold text-primary">View employee</h6>
            @endif

        </div>
        <div class="card-body">
            <form id="employee-form" action="/employee" method="post" class="form-horizontal row-fluid">
                @csrf

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">
                        <div class="form-row form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="username" name="username"
                                       {{--                                       value="{{ isset($product->name) ? $product->name : '' }}"--}}
                                       placeholder="Enter username" autocomplete="off">
                                <div class="validation">@error('username') {{$message}} @enderror </div>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="firstName" class="col-sm-2 col-form-label">First name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="firstName" name="firstName"
                                       {{--                                       value="{{ isset($product->name) ? $product->name : '' }}"--}}
                                       placeholder="Enter first name" autocomplete="off">
                                <div class="validation">@error('firstName') {{$message}} @enderror </div>
                            </div>
                        </div>


                        <div class="form-row form-group row">
                            <label for="lastName" class="col-sm-2 col-form-label">Last name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="lastName" name="lastName"
                                       {{--                                       value="{{ isset($product->name) ? $product->name : '' }}"--}}
                                       placeholder="Enter last name" autocomplete="off">
                                <div class="validation">@error('lastName') {{$message}} @enderror </div>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                       {{--                                       value="{{ isset($product->name) ? $product->name : '' }}"--}}
                                       placeholder="Enter mobile phone" autocomplete="off">
                                <div class="validation">@error('mobile') {{$message}} @enderror </div>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="email" name="email"
                                       {{--                                       value="{{ isset($product->name) ? $product->name : '' }}"--}}
                                       placeholder="Enter email" autocomplete="off">
                                <div class="validation">@error('email') {{$message}} @enderror </div>
                            </div>
                        </div>


                        <div class="form-row form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password"
                                       {{--                                       value="{{ isset($product->name) ? $product->name : '' }}"--}}
                                       placeholder="Enter password" autocomplete="off">
                                <div class="validation">@error('password') {{$message}} @enderror </div>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="confirm-password" class="col-sm-2 col-form-label">Confirm password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password-confirmation"
                                       name="password_confirmation"
                                                                              value="{{ isset($product->name) ? $product->name : '' }}"
                                       placeholder="Confirm password" autocomplete="off">
                                <div class="validation">@error('confirm-password') {{$message}} @enderror </div>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="role" class="col-sm-2 col-form-label">Is admin</label>
                            <div class="col-sm-8">
                                <select id="role" name="role" class="form-control">
                                    <option selected></option>
                                    <option value="true">Yes</option>
                                    <option value="false">No</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="wrapper">
                            <div class="box" id="box-image">
                                @if ($type == 'edit' || $type == 'view')
                                    <div class="js--image-preview js--no-default"
                                         style="background-image: url({{ $product->image }})"></div>
                                @else
                                    <div class="js--image-preview"></div>
                                @endif
                                <div class="upload-options">
                                    <label>
                                        <input type="file" class="image-upload" name="image[name]" accept="image/*"/>
                                        <input type="hidden" id="image-body" name="image[body]" value=""/>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-1"></div>
                </div>

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col">
                        @if ($type == 'new')
                            <button type="submit" class="btn btn-primary">Add employee</button>
                        @elseif($type == 'edit')
                            <button type="submit" class="btn btn-primary">Edit employee</button>
                        @endif
                        <a href="{{ URL::route('productsAll') }}" class="btn btn-secondary float-right">Back</a>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </form>
        </div>
    </div>

@endsection
