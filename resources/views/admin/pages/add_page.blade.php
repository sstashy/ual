@extends('admin.layouts.app')
@section('content')
<!-- Page title -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <!-- Page pre-title -->
            <h2 class="page-title">
                Add Page
            </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ml-auto d-print-none">
            <a href="{{ url('admin/pages') }}" class="btn btn-primary btn-sm d-sm-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path></svg>
                Return
            </a>
        </div>
    </div>
</div>
<div class="row row-deck row-cards">
    <div class="col-lg-12">
        <div class="card">
            <form method="post" action="{{ url('admin/page/add') }}">
                <div class="card-body">
                    @csrf
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Title</label>
                        <div class="col">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" name="title">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="form-label">
                            Body Text
                            <span class="form-label-description" id="charNum"></span>
                        </label>
                        <div class="col">
                            <textarea class="form-control @error('body') is-invalid @enderror" name="body" rows="15">{{old('body')}}</textarea>
                            
                            @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                    </div>
                    
                    <div class="hr-text">Other information</div>
                    
                    <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Status</label>
                        <div class="col">

                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="1" checked>
                                <span class="form-check-label">Active</span>
                            </label>
                            
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="2">
                                <span class="form-check-label">Disabled</span>
                            </label>
                            
                            @error('status')
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