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

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('edit appointment')}}</h1>
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('put')

                    {{-- tattoo start --}}
                    <div class="form-group">
                        <label for="tattoo">{{ __('tattoo') }}</label>
                        <select class="form-control" name="tattoo_id" >
                            @foreach($tattoos as $id => $tattoo)
                                <option {{ $id == $appointment->tattoo->id ? 'selected' : null }} value="{{ $id }}"> {{ $tattoo }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- tattoo end --}}


                    {{-- time start --}}
                    <div class="form-group">
                        <label for="start_time">{{ __('Start Time') }}</label>
                        <input type="text" class="form-control datetimepicker" id="start_time" name="start_time" value="{{ old('start_time', $appointment->start_time) }}" />
                    </div>
                    {{-- time end --}}

                    <div class="form-group">
                        <label for="name">{{ __('name') }}</label>
                        <input type="text" class="form-control" id="name" placeholder="{{ __('name') }}" name="name" value="{{ old('name', $appointment->name) }}" />
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('email') }}</label>
                        <input type="email" class="form-control" id="email" placeholder="{{ __('email') }}" name="email" value="{{ old('email', $appointment->email) }}" />
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ __('phone') }}</label>
                        <input type="text" class="form-control" id="phone" placeholder="{{ __('phone') }}" name="phone" value="{{ old('phone', $appointment->phone) }}" />
                    </div>

                    <div class="form-group">
                        <label for="service">{{ __('service') }}</label>
                        <select class="form-control" name="services[]" >
                            <option selected disabled>Which Tattoo Service</option>
                            @foreach($services as $id => $service)
                                <option {{ (in_array($id, old('services', [])) || isset($appointment) && $appointment->services->contains($id)) ? 'selected' : '' }} value="{{ $id }}"> {{ $service }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">{{ __('description') }}</label>
                        <textarea class="form-control" id="description" placeholder="{{ __('description') }}" name="description" >
                            {{ old('description', $appointment->description) }}
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
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
