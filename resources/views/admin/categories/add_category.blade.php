@extends('admin.layouts.app')
@section('content')
<!-- Page title -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <!-- Page pre-title -->
            <h2 class="page-title">
                Add Type
            </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ml-auto d-print-none">
            <a href="{{ url('admin/categories') }}" class="btn btn-primary btn-sm d-sm-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path></svg>
                Return
            </a>
        </div>
    </div>
</div>
<div class="row row-deck row-cards">
    <div class="col-lg-12">
        <div class="card">
            <form method="post" action="{{ url('admin/category/add') }}">
                <div class="card-body">
                    @csrf
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Name</label>
                        <div class="col">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" name="name" placeholder="Name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Description</label>
                        <div class="col">
                            <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}" name="description" placeholder="Description">

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
        
    </div>
</div>

@endsection