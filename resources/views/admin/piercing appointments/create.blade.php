@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->


    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session()->has('success'))
    <div class="alert alert-success text-center">
         {{ session()->get('success') }}
    </div>
@endif

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('create piercing appointment') }}</h1>
                    <a href="{{ route('admin.piercing_appointments.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.piercing_appointments.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="piercing-body-part">{{ __('piercing body part') }}</label>
                        <select class="form-control" name="piercing_id" >
                            @foreach($piercing_bodyparts as $id => $piercing_bodypart)
                                <option value="{{ $id }}"> {{ $piercing_bodypart }}</option>
                            @endforeach
                        </select>
                    </div>

                     {{-- client name start --}}
                     <div class="form-group">
                        <label for="name">{{ __('Client name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="First Name Last Name" value="{{ old('name') }}" />
                    </div>
                    {{-- client name end --}}

                    {{-- client email start --}}
                    <div class="form-group">
                        <label for="email">{{ __('Client email') }}</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                    </div>
                    {{-- client email end --}}

                    {{-- client phone start --}}
                    <div class="form-group">
                        <label for="phone">{{ __('Client phone number') }}</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" />
                    </div>
                    {{-- client phone end --}}

                    <div class="form-group">
                        <label for="start_time">{{ __('Start Time') }}</label>
                        <input type="text" class="form-control datetimepicker" id="start_time" name="start_time" value="{{ old('start_time') }}" />
                    </div>

                    <div class="form-group">
                        <label for="service">{{ __('piercing service') }}</label>
                        <select class="form-control" name="services_piercings" >
                            @foreach($piercing_services as $id => $piercing_service)
                                <option value="{{ $id }}"> {{ $piercing_service }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
                </form>
            </div>
        </div>


    <!-- Content Row -->

</div>
@endsection


@push('style-alt')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
@endpush

@push('script-alt')
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            locale: 'en',
            sideBySide: true,
            icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
            },
            stepping: 10
        });
    </script>
@endpush
