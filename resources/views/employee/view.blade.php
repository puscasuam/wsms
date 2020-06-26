@extends('layouts.includes.main')


@section('content')

    <!-- view -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-dark">View employee {{ isset($employee->user->name) ? $employee->user->name : '' }}</h6>

        </div>
        <div class="card-body">

            <div class="card mb-12" style="width: 100%;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="wrapper">
                            <div class="box">
                                <div class="js--image-preview js--no-default"
                                     style="background-image: url({{ $employee->image }}); height: 300px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold text-dark">{{ isset($employee->user->name) ? $employee->user->name : '' }}</h5>

                            <p class="card-text">
                                First name:   {{ isset($employee->firstname) ? $employee->firstname : '' }}<br/>
                                Last name:   {{ isset($employee->lastname) ? $employee->lastname : '' }}<br/>
                                Email: {{ isset($employee->user->email) ? $employee->user->email : '' }}<br/>
                                Mobile: {{ isset($employee->mobile) ? $employee->mobile : '' }}<br/>
                                Role: {{( isset($employee->admin) && $employee->admin === 1) ? 'Admin' : 'Regular' }}
                            <p class="card-text">

                            </p>
                            <p class="card-text"><small class="text-muted">
                                    Added at {{ isset($employee->created_at) ? $employee->created_at : '' }}
                                </small></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-1"></div>
                <div class="col">
                    <a href="{{ URL('/employee/'.$employee->id )}}"class="btn btn-dark">
                        Edit</a>
                    <a href="{{ URL::route('employeesAll') }}" class="btn btn-secondary float-right">Back</a>
                </div>
                <div class="col-sm-1"></div>
            </div>

        </div>
    </div>

@endsection

