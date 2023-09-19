@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="12" r="9"></circle><path d="M9 12l2 2l4 -4"></path></svg>
    {{ $message }}
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>
@endif

@if ($message = Session::get('danger'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="12" r="9"></circle><path d="M10 10l4 4m0 -4l-4 4"></path></svg>
    {{ $message }}
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
    {{ $message }}
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissible" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
    {{ $message }}
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>
@endif