@extends('layouts')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>

                <div class="card-body">
                    1
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-header">{{ __('Books') }}</div>

                <div class="card-body">
                    1
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
