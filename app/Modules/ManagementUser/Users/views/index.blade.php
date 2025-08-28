@extends('layout')
@section('title', 'Management Pengguna: Pengguna')
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
        @generate_navbar(h='/',t='Management Pengguna';h='#',t="Management Pengguna",tt="Pengguna")
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
                                <h5 class="card-title fw-semibold">Master Pengguna</h5>
                            </div>
                        </div>
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                            <div class="mb-3 mb-sm-1">
                                <a id="addBtn"
                                    class="btn bg-info-subtle text-info  btn-md btn-icon btn-icon-start ms-1 mb-1">
                                    <i class="ti ti-plus"></i>
                                    Tambah Pengguna
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
                                            <th>Email</th>
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
                            <label class="form-label">Nama
                                <span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="hidden" name="_id" id="_id">
                                <input type="text" name="name" id="name" class="form-control" required />
                            </div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">Email</label>
                            <div class="controls">
                                <input type="email" name="email" id="email" class="form-control" required />
                            </div>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">Password</label>
                            <div class="controls">
                                <input type="password" name="password" id="password" class="form-control" required />
                            </div>
                        </div>
                        <div class="mb-0 form-group">
                            <label class="form-label">Role</label>
                            <div class="controls">
                                <select name="role_id[]" id="role_id" class="form-control has-select2" multiple="multiple"
                                    required>
                                    @foreach ($roles as $_role)
                                        <option value="{{ $_role->id }}"
                                            {{ old('role_id') == $_role->id ? 'selected' : '' }}>
                                            {{ $_role->name }}</option>
                                    @endforeach
                                </select>
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

    <script>
        $(document).ready(function() {
            $(".has-select2").select2({
                placeholder: " *** Pilih Role Pengguna",
                allowClear: true,
                dropdownParent: $('#modalData')
            })
        });
    </script>

    <script type="text/javascript">
        // bautkan data table dengan id datatable
        $(document).ready(function() {
            // Add Button
            $('#addBtn').on('click', function() {
                $('#_id').val('').removeClass('is-invalid'); // Clear _id
                $('#name').val('').removeClass('is-invalid'); // Clear name
                $('#email').val('').removeClass('is-invalid'); // Clear email
                $('#password').val('').removeClass('is-invalid'); // Clear email
                $('#role_id').val([]).trigger('change').removeClass('is-invalid');
                // Show the modal
                $('#modalDataTitle').text('Tambah Pengguna');
                $('#modalData').modal('show');

                document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            });

            // Datatables
            datatable = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: "{{ route('management_user.users.datatable') }}",
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
                        data: 'email',
                        name: 'email'
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
                            return `<button class="editBtn btn bg-info-subtle text-info btn-md btn-icon btn-icon-start ms-1 mb-1" data-id="${row.id}">
                                        <i class="ti ti-edit"></i>
                                        Edit
                                    </button>
                                    <button class="deleteBtn btn bg-danger-subtle text-danger btn-md btn-icon btn-icon-start ms-1 mb-1" data-id="${row.id}">
                                        <i class="ti ti-trash"></i>
                                        Hapus
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
                document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
                $.ajax({
                    url: `/management_user/users/${id}`,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            $('#_id').val(response.data.id).removeClass('is-invalid');
                            $('#name').val(response.data.name).removeClass('is-invalid');
                            $('#email').val(response.data.email).removeClass('is-invalid');
                            $('#password').val('').removeClass('is-invalid');
                            if (Array.isArray(response.data.roles)) {
                                let roleIds = response.data.roles.map(role => role
                                    .id); // Extract role IDs
                                console.log(roleIds)
                                $('#role_id').val(roleIds).trigger('change').removeClass(
                                    'is-invalid');
                            }
                            $('#modalDataTitle').text('Edit Pengguna');
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
                let email = $('#email').val();
                let password = $('#password').val();
                let role_id = $('#role_id').val();
                let token = '{{ csrf_token() }}';

                // Check if this is an update or add request
                let url = _id ? `/management_user/users/${_id}` :
                    `/management_user/users`; // If _id exists, it's an update
                let method = _id ? "PUT" : "POST"; // PUT for update, POST for create

                // Ajax request
                $.ajax({
                    url: url,
                    type: method,
                    cache: false,
                    data: {
                        "name": name,
                        "email": email,
                        "password": password,
                        "role_id": role_id,
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
                                url: `/management_user/users/${id}`,
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
