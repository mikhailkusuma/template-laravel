@extends('layout')
@section('title', 'Dashboard')
@section('content')

    <div class="container-fluid mw-100">
        <div class="row">
            <div class="col-md-12">
                <div class="card w-100 border d-none">
                    <div class="card-header">
                        <div class="my-1 d-flex align-items-center">
                            <h5 class="mb-0 mx-auto">Peta Pengaduan Masyarakat</h5>
                        </div>
                    </div>
                    <div class="card-body border-top p-2" height="400px">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset(env('THEME_ASSETS_PATH') . '/libs/prismjs/themes/prism-okaidia.min.css') }}">
    <link rel="stylesheet" href="{{ asset(env('THEME_ASSETS_PATH') . '/libs/select2/dist/css/select2.min.css') }}">
    <!-- Owl Carousel  -->
    <link rel="stylesheet"
        href="{{ asset(env('THEME_ASSETS_PATH') . '/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" />
@endpush

@push('script')
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>

    @if ($message = Session::get('success'))
        <script type="text/javascript">
            toastr.success("{{ $message }}")
        </script>
    @endif
    @if ($message = Session::get('warning'))
        <script type="text/javascript">
            toastr.warning("{{ $message }}")
        </script>
    @endif
    @if ($message = Session::get('error'))
        <script type="text/javascript">
            toastr.error("{{ $message }}")
        </script>
    @endif
@endpush
