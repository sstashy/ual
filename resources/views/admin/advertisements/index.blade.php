@extends('admin.layouts.app')
@section('content')
<!-- Page title -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <!-- Page pre-title -->
            <h2 class="page-title">
                Advertising
            </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ml-auto d-print-none">
            <a href="{{ url('admin/adv/add') }}" class="btn btn-primary btn-sm d-sm-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Add New ADV
            </a>
        </div>
    </div>
</div>
<div class="row row-deck row-cards">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Advertise list</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="w-1">ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($advertisements as $item)
                        <tr>
                            <td>
                                <span class="text-muted">
                                    {{ $item->id }}
                                </span>
                            </td>
                            <td class="strong">
                                {{ Str::limit($item->title, 22) }}
                            </td>
                            <td>
                                <span class="@if($item->status == 1)text-green @else text-danger @endif">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M5 12l5 5l10 -10"></path></svg>
                                </span>
                            </td>
                            <td>
                                {{$item->created_at}}
                            </td>
                            <td>
                                <div class="btn-list">
                                    <a href="{{ url('admin/adv/edit/'.$item->id) }}" class="btn btn-sm">Edit</a>
                                    <a href="{{ url('admin/adv/delete/'.$item->id) }}" 
                                       onclick="return confirm('This action is final, are you sure?');" 
                                       class="btn btn-danger btn-sm btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td>{{ __('admin.no_results') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">
                    Showing {{ $advertisements->currentPage() }} page of {{ $advertisements->total() }} entries
                </p>
                <ul class="pagination m-0 ml-auto">
                    {{ $advertisements->links() }} 
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection