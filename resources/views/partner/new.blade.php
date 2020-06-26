@extends('layouts.includes.main')

@section('content')

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <input type="hidden" id="product-form-type" value="{{$type}}"/>

            @if ($type == 'new')
                <h6 class="m-0 font-weight-bold text-dark">Add new partner</h6>
            @elseif ($type == 'edit')
                <h6 class="m-0 font-weight-bold text-dark">Edit partner</h6>
            @endif

        </div>
        <div class="card-body">
            <form id="product-form" action="/partner" method="post" class="form-horizontal row-fluid">
                @csrf

                @if ($type == 'edit')
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{ $partner->id }}">
                @endif

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-6">
                        <div class="form-row form-group row">
                            <label for="cif" class="col-sm-2 col-form-label">CIF</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="cif" name="cif"
                                       value="{{ isset($partner->cif) ? $partner->cif : '' }}"
                                       placeholder="Enter partner CIF" autocomplete="off">
                                <div class="validation">@error('cif') {{$message}} @enderror </div>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ isset($partner->name) ? $partner->name : '' }}"
                                       placeholder="Enter partner name">
                                <div class="validation"> @error('name') {{$message}}@enderror </div>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ isset($partner->email) ? $partner->email : '' }}"
                                       placeholder="Enter partner email">
                                <div class="validation"> @error('email') {{$message}}@enderror </div>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="text" class="col-sm-2 col-form-label">Mobile</label>
                            <div class="col-sm-8">
                                <input type="mobile" class="form-control" id="mobile" name="mobile"
                                       value="{{ isset($partner->mobile) ? $partner->mobile : '' }}"
                                       placeholder="Enter partner mobile">
                                <div class="validation"> @error('mobile') {{$message}}@enderror </div>
                            </div>
                        </div>

                        <div class="form-row form-group row">
                            <label for="text" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <input type="address" class="form-control" id="address" name="address"
                                       value="{{ isset($partner->address) ? $partner->address : '' }}"
                                       placeholder="Enter partner address">
                                <div class="validation"> @error('address') {{$message}}@enderror </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4"></div>
                    <div class="col-sm-1"></div>
                </div>

                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col">
                        @if ($type == 'new')
                            <button type="submit" class="btn btn-dark">Add partner</button>
                        @elseif($type == 'edit')
                            <button type="submit" class="btn btn-dark">Edit partner</button>
                        @endif
                        <a href="{{ URL::route('home') }}" class="btn btn-secondary float-right">Back</a>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </form>
        </div>
    </div>

@endsection
