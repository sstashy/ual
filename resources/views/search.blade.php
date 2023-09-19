@extends('layouts.app')
@section('content')
<div class="row">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    {{ __('app.text_43') }}
                </div>
                <h2 class="page-title">
                    {{ __('app.text_60') }} <span class="strong">{{ $keywords }}</span>
                </h2>
            </div>
        </div>
    </div>
    
    @include('layouts.post')
    
</div>
@endsection