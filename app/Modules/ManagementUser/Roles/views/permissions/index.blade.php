@extends('layout')
@section('title', 'Manajemen Pengguna: Roles Add Permissions')
@push('style')
    <link rel="stylesheet" href="{{ asset(env('THEME_ASSETS_PATH') . '/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset(env('THEME_ASSETS_PATH') . '/libs/prismjs/themes/prism-okaidia.min.css') }}">
    <link rel="stylesheet" href="{{ asset(env('THEME_ASSETS_PATH') . '/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset(env('THEME_ASSETS_PATH') . '/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" />
    <style>
        .dt-center-content {
            align-content: center;
        }

        .entri-nonaktif {
            background-color: #b7b7b7 !important;
            --bs-table-striped-bg: #b7b7b7 !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        @generate_navbar(h='/',t='Manajemen Pengguna';h='#',t="Roles",tt="Roles Add Permissions")

        <form class="form-horizontal r-separator"
            action="{{ route('management_user.roles.set_permissions.store', $role->id) }}" method="post">
            @csrf
            <div class="row" style="display: flex;justify-content: center;">
                <div class="col-lg-12 d-flex align-items-strech">
                    <div class="card w-100 position-relative overflow-hidden">
                        <div class="card-header border-bottom">
                            <div class="d-sm-flex d-block align-items-center justify-content-between">
                                <div class="mb-2 mb-sm-0">
                                    <h5 class="card-title fw-semibold">Roles: {{ $role->name }}</h5>
                                </div>
                                <div>
                                    <button type="submit" class="btn bg-primary-subtle text-primary rounded px-4">
                                        Simpan
                                    </button>
                                    <a href="{{ route('management_user.roles.index') }}"
                                        class="btn bg-danger-subtle text-danger rounded px-4 ms-2">
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 row">
                                @php
                                    $name = '';
                                @endphp

                                @foreach ($permissions as $_permission)
                                    @php
                                        $parts = explode('.', $_permission->name);
                                        $group = $parts[0];
                                    @endphp

                                    @if ($name != $group)
                                        @if ($name != '')
                            </div>
                            @endif
                            <div class="mb-2 col-md-4">
                                <h5>{{ strtoupper(implode(' ', explode('_', $group))) }}</h5>
                                @endif

                                <div class="form-check py-2 ms-1">
                                    <input class="form-check-input" type="checkbox" value="{{ $_permission->id }}"
                                        name="permission_id[]" id="permission_id_{{ $_permission->id }}"
                                        {{ in_array($_permission->id, $permission_active->toArray()) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission_id_{{ $_permission->id }}">
                                        {{ $_permission->name }}
                                    </label>
                                </div>

                                @php $name = $group; @endphp
                                @endforeach

                                @if ($name != '')
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer border-top text-center">
                        <button type="submit" class="btn bg-primary-subtle text-primary rounded px-4">
                            Simpan
                        </button>
                        <a href="{{ route('management_user.roles.index') }}"
                            class="btn bg-danger-subtle text-danger rounded px-4 ms-2">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
    </div>
    </form>
    <!-- row -->
    </div>
@endsection

@push('script')
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/extra-libs/jqbootstrapvalidation/validation.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/js/forms/custom-validation-init.js') }}"></script>
    <script src="{{ asset(env('THEME_ASSETS_PATH') . '/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>

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
