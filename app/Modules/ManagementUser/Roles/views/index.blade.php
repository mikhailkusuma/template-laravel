@extends('layout')
@section('title', 'Manajemen Pengguna: Roles')
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
        @generate_navbar(h='/',t='Manajemen Pengguna';h='#',t="Roles",tt="Roles")
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
                                <h5 class="card-title fw-semibold">Master Roles</h5>
                            </div>
                        </div>
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                            <div class="mb-3 mb-sm-1">
                                <a id="addBtn"
                                    class="btn bg-info-subtle text-info  btn-md btn-icon btn-icon-start ms-1 mb-1">
                                    <i class="ti ti-plus"></i>
                                    Tambah Roles
                                </a>
                                <a href="javascript:void(0)" {{-- onclick="window.location.reload();" --}}
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
                                            <th>Nama</th>
                                            <th>Guard</th>
                                            <th width="160px">Tanggal Buat</th>
                                            <th>Action</th>
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

    <div class="modal fade" id="modalData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center border-bottom">
                    <h4 class="modal-title" id="modalDataTitle">
                        Data
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form novalidate id="formData" method="post">
                    <div class="modal-body">
                        <div class="mb-2 form-group">
                            <label class="form-label">Nama Roles
                                <span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="hidden" name="_id" id="_id">
                                <input type="text" name="name" id="name" class="form-control" required
                                    data-validation-required-message="Nama wajib diisi." />
                            </div>
                        </div>
                        <div class="mb-0 form-group">
                            <label class="form-label">Guard</label>
                            <div class="controls">
                                <input type="text" name="guard_name" id="guard_name" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top justify-content-start">
                        <div class="d-flex flex-wrap gap-6">
                            <button type="submit" id="save" class="btn btn-primary">
                                Simpan
                            </button>
                            <button type="button" class="btn bg-danger-subtle text-danger  waves-effect text-start"
                                data-bs-dismiss="modal">
                                Batal
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
            // Add Button
            $('#addBtn').on('click', function() {
                $('#_id').val(''); // Clear _id
                $('#name').val(''); // Clear name
                $('#guard_name').val(''); // Clear name
                // Show the modal
                $('#modalDataTitle').text('Tambah Roles');
                $('#modalData').modal('show');
            });

            // Datatables
            datatable = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{{ route('management_user.roles.datatable') }}",
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'guard_name',
                        name: 'guard_name'
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
                    {
                        // Action
                        data: null,
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `<a class="btn bg-info-subtle text-info btn-md btn-icon btn-icon-start ms-1 mb-1" href="/management_user/roles/set_permissions/${row.id}">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <button class="editBtn btn bg-warning-subtle text-warning btn-md btn-icon btn-icon-start ms-1 mb-1" data-id="${row.id}">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button class="deleteBtn btn bg-danger-subtle text-danger btn-md btn-icon btn-icon-start ms-1 mb-1" data-id="${row.id}">
                                        <i class="ti ti-trash"></i>
                                    </button>`;
                        },
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css({
                                'width': '50px',
                                'text-align': 'center'
                            });
                        }
                    }
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

            // Btn Edit
            $(document).on('click', '.editBtn', function() {
                const id = $(this).data('id'); // Get ID from clicked button
                $.ajax({
                    url: `/management_user/roles/${id}`,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            $('#_id').val(response.data.id);
                            $('#name').val(response.data.name);
                            $('#guard_name').val(response.data.guard_name);
                            $('#modalDataTitle').text('Edit Roles');
                            $('#modalData').modal('show');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: xhr.responseJSON?.message ||
                                'Terjadi kesalahan saat mengambil data!'
                        });
                    }
                });
            });

            // Save like add and update data
            $('#save').click(function(e) {
                e.preventDefault();
                $(this).prop('disabled', true).text('Loading...');

                // Define variables
                let _id = $('#_id').val(); // This will be null or a valid ID for updates
                let name = $('#name').val();
                let guard_name = $('#guard_name').val();
                let token = '{{ csrf_token() }}';

                // Check if this is an update or add request
                let url = _id ? `/management_user/roles/${_id}` :
                    `/management_user/roles`; // If _id exists, it's an update
                let method = _id ? "PUT" : "POST"; // PUT for update, POST for create

                // Ajax request
                $.ajax({
                    url: url,
                    type: method,
                    cache: false,
                    data: {
                        "name": name,
                        "guard_name": guard_name,
                        "_token": token
                    },
                    success: function(response) {
                        // Close modal
                        $('#modalData').modal('hide');
                        $('#save').prop('disabled', false).text('Simpan');

                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: `${response.message}`,
                            // showConfirmButton: true,
                            timer: 3000
                        });

                        // Reload the DataTable after the success message
                        $('.datatable').DataTable().ajax.reload();
                    },
                    error: function(error) {
                        $('#save').prop('disabled', false).text('Simpan'); // Re-enable button

                        if (error.status === 422) { // Validation error
                            let errors = error.responseJSON.errors; // Get validation errors

                            // Clear previous error messages
                            $('.invalid-feedback').remove();
                            $('.is-invalid').removeClass('is-invalid');

                            // Loop through errors and display them under corresponding fields
                            $.each(errors, function(field, messages) {
                                let inputField = $(`[name="${field}"]`);
                                inputField.addClass(
                                    'is-invalid'); // Add Bootstrap invalid class

                                // Append error message below the input
                                inputField.after(
                                    `<div class="invalid-feedback">${messages[0]}</div>`
                                );
                            });
                        } else {
                            // Generic error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Silakan coba lagi nanti.',
                                timer: 3000
                            });
                        }
                    }
                })
            });

            // Delete Data
            $(document).on("click", ".deleteBtn", function() {
                const id = $(this).data("id");
                Swal.fire({
                        title: "Konfirmasi",
                        text: "Apakah anda ingin menghapus data ini? Tindakan tidak dapat diurungkan",
                        showCancelButton: true,
                        icon: "question",
                        cancelButtonText: "Batalkan",
                        confirmButtonText: "Ya"
                    })
                    .then((res) => {
                        if (res.isConfirmed) {
                            $.ajax({
                                url: `/management_user/roles/${id}`,
                                method: "DELETE",
                                data: {
                                    'id': id,
                                    '_token': '{{ csrf_token() }}',
                                },
                                success: function(data, text, jqxhr) {
                                    toastr.success("Berhasil menghapus data", "Berhasil");
                                    datatable.ajax.reload();
                                },
                                error: function(jq, text, err) {
                                    toastr.error("Gagal menghapus data", "Gagal");
                                }
                            });
                        }
                    });
            });
        });
    </script>
@endpush
