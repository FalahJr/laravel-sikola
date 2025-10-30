@if ($errors->any())
    <div class="container-fluid mt-3 px-0">
        <div class="alert alert-danger mb-0" role="alert">
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@foreach (['success', 'error', 'warning', 'info'] as $msg)
    @if (session()->has($msg))
        @php $alertClass = $msg === 'success' ? 'alert-success' : ($msg === 'error' ? 'alert-danger' : ($msg === 'warning' ? 'alert-warning' : 'alert-info')); @endphp
        <div class="container-fluid mt-3 px-0">
            <div class="alert {{ $alertClass }} alert-dismissible fade show mb-0" role="alert">
                {{ session()->get($msg) }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
@endforeach
