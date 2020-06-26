@extends('layouts.includes.main')

@section('content')

    <!-- view -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-dark">View partner {{ isset($partner->name) ? $partner->name : '' }}</h6>

        </div>
        <div class="card-body">

            <div class="card mb-12" style="width: 100%;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="wrapper">
                            <div class="box">
                                <img src="{{asset('storage/partner/partner.jpg')}}" alt="partner">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold text-dark">{{ isset($partner->name) ? $partner->name : '' }}</h5>

                            <p class="card-text">
                                CIF: {{ isset($partner->cif) ? $partner->cif : '' }}<br/>
                                Email: {{ isset($partner->email) ? $partner->email : '' }}<br/>
                                Mobile: {{ isset($partner->mobile) ? $partner->mobile : '' }}<br/>
                                Address: {{ isset($partner->address) ? $partner->address : '' }}<br/>
                            <p class="card-text">

                            </p>
                            <p class="card-text"><small class="text-muted">
                                    Added at {{ isset($partner->created_at) ? $partner->created_at : '' }}
                                </small></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-1"></div>
                <div class="col">
                    @can('isAuthorized', \App\Partner::class)
                    <a href="{{ URL('/partner/'.$partner->id )}}"class="btn btn-dark">
                        Edit</a>
                    @endcan
                    <a href="{{ URL::route('partnersAll') }}" class="btn btn-secondary float-right">Back</a>
                </div>
                <div class="col-sm-1"></div>
            </div>

        </div>
    </div>

@endsection
