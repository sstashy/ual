@extends('admin.layouts.app')
@section('content')
<!-- Page title -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
            <!-- Page pre-title -->
            <h2 class="page-title">
                Items
            </h2>
        </div>
    </div>
</div>
<div class="row row-deck row-cards">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Items list</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th class="w-1">ID</th>
                            <th>Title</th>
                            <th>User</th>
                            <th>Category</th>
                            <th>Views</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Created at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            <td>
                                <span class="text-muted">
                                    {{ $item->id }}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted strong">
                                    <a href="{{ url('admin/item/edit/'.$item->id) }}" data-toggle="tooltip" data-placement="bottom" title="View">
                                        {{ Str::limit($item->title, 25) }}
                                    </a>
                                </span>
                            </td>
                            <td>
                                {{ App\User::find($item->user_id)->name }}
                            </td>
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M9 4h3l2 2h5a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2"></path><path d="M17 17v2a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2h2"></path></svg> {{ App\Categories::find($item->categories)->name }}
                            </td>
                            <td>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="12" r="2"></circle><path d="M2 12l1.5 2a11 11 0 0 0 17 0l1.5 -2"></path><path d="M2 12l1.5 -2a11 11 0 0 1 17 0l1.5 2"></path></svg> {{ $item->views }}
                            </td>
                            <td>
                                <span class="text-muted strong">
                                    {{ App\Genders::find($item->gender)->gender_title }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-pill bg-teal">{{ $item->age }}</span>
                            </td>
                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                <span class="@if($item->status == 1)text-green @else text-danger @endif">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><path d="M5 12l5 5l10 -10"></path></svg>
                                </span>
                            </td>
                            <td>
                                <div class="btn-list">
                                    <a href="{{ url('admin/item/edit/'.$item->id) }}" class="btn btn-sm">Edit</a>
                                    <a href="{{ url('admin/item/delete/'.$item->id) }}" 
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
                    Showing {{ $items->currentPage() }} page of {{ $items->total() }} entries
                </p>
                <ul class="pagination m-0 ml-auto">
                    {{ $items->links() }} 
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection