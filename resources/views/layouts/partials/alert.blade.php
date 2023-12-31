@if (session()->has('success-message') || session()->has('error-message'))
    @if (session()->has('success-message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        {{session()->get('success-message')}}
    </div>
    @endif
    
    @if (session()->has('error-message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        {{session()->get('error-message')}}
    </div>
    @endif
@endif