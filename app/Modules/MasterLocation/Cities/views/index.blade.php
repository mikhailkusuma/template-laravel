@extends('layout')
@section('title', 'Master Lokasi: Kabupaten')
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
        @generate_navbar(h='/',t='Master Lokasi';h='#',t="Master Lokasi Kabupaten",tt="Kabupaten")
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @else
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
        @endif

        <div class="row" style="display: flex;justify-content: center;">
            <div class="col-lg-12 d-flex align-items-strech">
                <div class="card w-100 position-relative overflow-hidden">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                            <div class="mb-2 mb-sm-0">
                                <h5 class="card-title fw-semibold">Master Kabupaten</h5>
                            </div>
                        </div>
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                            <div class="mb-3 mb-sm-1">
                                <a href="#" {{-- onclick="window.location.reload();" --}}
                                    class="refreshBtn btn bg-warning-subtle text-warning btn-md btn-icon btn-icon-start ms-1 mb-1">
                                    <i class="ti ti-refresh"></i>
                                    Refresh Data
                                </a>
                            </div>
                        </div>
                        <div class="datatables">
                            <div class="table-responsive" style="height: 100%">
                                <table class="datatable table text-nowrap table-bordered align-middle mb-0"
                                    style="width: 100%">
                                    <thead class="table-primary">
                                        <tr class="text-muted fw-semibold">
                                            <th width="20px">&nbsp;&nbsp;No</th>
                                            <th>Provinsi</th>
                                            <th>Nama</th>
                                            <th>Koordinat</th>
                                            <th width="160px">Tanggal Aduan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-top">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <script type="text/javascript">
        // bautkan data table dengan id datatable
        $(document).ready(function() {

            // Datatables
            datatable = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{{ route('master_location.cities.datatable') }}",
                    type: 'GET',
                    // error: function(xhr, error, thrown) {
                    //     console.log("Error:", xhr.responseText); // Logs the error response
                    //     alert("Error: " + xhr.responseText); // Alerts the error for visibility
                    // }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css({
                                'width': '20px',
                                'text-align': 'center'
                            });
                        }
                    },
                    {
                        data: 'province_name',
                        name: 'province_name'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'coordinate',
                        name: 'coordinate'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            let date = new Date(row.created_at);
                            let hours = String(date.getHours()).padStart(2, '0');
                            let minutes = String(date.getMinutes()).padStart(2, '0');
                            let day = date.getDate();
                            let month = date.toLocaleString('id-ID', {
                                month: 'long'
                            });
                            let year = date.getFullYear();

                            return `${month} ${day}, ${year} ${hours}:${minutes}`;
                        }
                    },
                ],
                // add tooltip to NA column
                drawCallback: function() {
                    $('[data-bs-toggle="tooltip"]').tooltip();
                },
                language: {
                    url: `{{ asset(env('THEME_ASSETS_PATH') . '/js/datatable-id.json') }}`,
                    emptyTable: 'Tidak ada data yang tersedia',
                    searchPlaceholder: 'Masukkan kata kunci pencarian, dapat diisi dengan nama',
                },
                initComplete: function() {
                    $('.dataTables_filter input[type="search"]').css({
                        'width': '360px',
                        'max-width': '400px',
                        'display': 'inline-block',
                        'padding': '.5rem .5rem'
                    });
                    $('.dataTables_info').css({
                        'padding': '0.75rem 1.25rem',
                        'margin-top': '0.5rem'
                    });
                }
            });

            $('.ordered').on('click', function() {
                // loading animation
                $('.datatable').addClass('table-loading');
            });


            $(document).on("click", ".refreshBtn", function() {
                datatable.ajax.reload();
            });
        });
    </script>
@endpush
