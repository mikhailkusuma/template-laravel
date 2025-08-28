@extends("layout")

@section('content')
<div class="container-fluid">
    <div class="mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kesalahan</h4>
            </div>
            <div class="card-body">
                {!!$pesanError!!}
            </div>
        </div>
    </div>
</div>
@endsection
