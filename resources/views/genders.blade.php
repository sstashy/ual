@extends('layouts.app')
@section('content')
<div class="row">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <h2 class="page-title">
                    {{ $gender->gender_title }}
                </h2>
            </div>
        </div>
    </div>

    @include('layouts.sidebar')
    
    <div class="col-lg-9">
        @include('layouts.post')
    </div>
    
</div>
@endsection