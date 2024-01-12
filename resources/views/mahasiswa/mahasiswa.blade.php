@extends('template/layout')
@section('content')
<div class="toolbar bg-transparent pt-6 mb-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex flex-column align-items-start me-3 mb-5 mb-lg-0">
            <h1 class="d-flex text-dark fw-bolder fs-3 flex-column mb-0">Mahasiswa
            </h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-mahasiswa-add">Tambah
                Mahasiwa</a>
        </div>
    </div>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="row g-5">
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center h-md-50 mb-5 mb-xl-10">
                <div class="card-header pt-5">
                    <div class="card-title d-flex flex-column">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tb_mahasiswa" class="table table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                    <th class="text-start">NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Setting mahasiswa Add -->
<div class="modal fade" id="modal-mahasiswa-add" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center mx-4 mt-4">
                <h4 class="card-title fw-semibold">Tambah mahasiswa</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="post" class="mx-4" id="form-mahasiswa-add" entype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="fallback">
                        <p class="card-subtitle mb-4">Untuk menambah data mahasiswa dapat dilakukan disini.</p>
                        <div class="row">
                            <div class="mb-4">
                                <label for="kode" class="form-label fw-semibold">NIM </label>
                                <input type="text" class="form-control" name="mahasiswa-add-nim-mahasiswa" id="mahasiswa-add-nim-mahasiswa" required>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Email Mahasiswa</label>
                                <input type="email" class="form-control" name="mahasiswa-add-email-mahasiswa" id="mahasiswa-add-email-mahasiswa" required>
                            </div>
                            <div class="mb-4">
                                <label for="nama" class="form-label fw-semibold">Nama Mahasiswa</label>
                                <input type="text" class="form-control" name="mahasiswa-add-nama-mahasiswa" id="mahasiswa-add-nama-mahasiswa" required>
                            </div>
                            <div class="mb-4">
                                <label for="nama" class="form-label fw-semibold">Kelas</label>
                                <select class="form-select" name="mahasiswa-add-id-kelas" id="mahasiswa-add-id-kelas" required>
                                </select>
                                <input type="hidden" class="form-control" id="created" value="{{ Auth::user()->username }}" name="created" required>
                            </div>
                        </div>
                        <p class="card-subtitle mb-4 mt-3 text-muted fw-bold">User Account Register.</p>
                        <div class="row">
                            <div class="mb-4">
                                <label for="username" class="form-label fw-semibold">Username </label>
                                <input type="text" class="form-control" name="mahasiswa-add-username-mahasiswa" id="mahasiswa-add-nim-mahasiswa" required>
                            </div>
                            <div class="mb-4">
                                <label for="pw" class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control" name="mahasiswa-add-password-mahasiswa" id="mahasiswa-add-password-mahasiswa" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer mx-4 mb-4">
                <button type="submit" class="btn btn-primary font-medium waves-effect" id="btn-mahasiswa-save">
                    Tambah
                </button>
                <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect" data-bs-dismiss="modal" id="cancel-mahasiswa-add">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Setting mahasiswa Add -->

<!-- Modal Setting mahasiswa Edit -->
<div class="modal fade" id="modal-mahasiswa-edit" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center mx-4 mt-4">
                <h4 class="card-title fw-semibold">Edit mahasiswa</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="post" class="mx-4" id="form-mahasiswa-edit" entype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="fallback">
                        <p class="card-subtitle mb-4">Untuk mengedit data mahasiswa dapat dilakukan disini.</p>
                        <div class="row">
                            <div class="mb-4">
                                <label for="kode" class="form-label fw-semibold">NIM </label>
                                <input type="hidden" id="mahasiswa-edit-id" name="mahasiswa-edit-id">
                                <input type="hidden" id="mahasiswa-edit-id-user" name="mahasiswa-edit-id-user">
                                <input type="text" class="form-control" name="mahasiswa-edit-nim-mahasiswa" id="mahasiswa-edit-nim-mahasiswa" required readonly>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Email Mahasiswa</label>
                                <input type="email" class="form-control" name="mahasiswa-edit-email-mahasiswa" id="mahasiswa-edit-email-mahasiswa" required>
                            </div>
                            <div class="mb-4">
                                <label for="nama" class="form-label fw-semibold">Nama Mahasiswa</label>
                                <input type="text" class="form-control" name="mahasiswa-edit-nama-mahasiswa" id="mahasiswa-edit-nama-mahasiswa" required>
                            </div>
                            <div class="mb-4">
                                <label for="nama" class="form-label fw-semibold">Kelas</label>
                                <select class="form-select" name="mahasiswa-edit-id-kelas" id="mahasiswa-edit-id-kelas" required>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer mx-4 mb-4">
                <button type="submit" class="btn btn-primary font-medium waves-effect" id="btn-mahasiswa-edit">
                    Edit
                </button>
                <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect" data-bs-dismiss="modal" id="cancel-mahasiswa-edit">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Setting mahasiswa Edit -->

<script>
    $(document).ready(function() {
        var tb_mahasiswa = $("#tb_mahasiswa").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_"
            },
            ajax: {
                url: "{{ route('get_all_mahasiswa')}}",
                type: "GET",
                dataSrc: "",
            },
            columns: [{
                    data: "nim",
                    render: function(data, type, row) {
                        return '<p class="text-muted">' + data + '</p>';
                    }
                },
                {
                    data: "nama",
                    render: function(data, type, row) {
                        return '<p class="text-muted">' + data + '</p>';
                    }
                },
                {
                    data: "kelas",
                    render: function(data, type, row) {
                        return '<p class="text-muted">' + data + '</p>';
                    }
                },
                {
                    data: "jurusan",
                    render: function(data, type, row) {
                        return '<p class="text-muted">' + data + '</p>';
                    }
                },
                {
                    render: function(data, type, row) {
                        var btn =
                            '<button data-id="' + row.id +
                            '"class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#modal-mahasiswa-edit">' +
                            '<span class="svg-icon svg-icon-3">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
                            '<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />' +
                            '<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />' +
                            '</svg>' +
                            '</span>' +
                            '</button>' +
                            '<button data-id="' + row.id +
                            '"class="btn btn-icon btn-active-light-primary w-30px h-30px btn-delete-mahasiswa" data-kt-permissions-table-filter="delete_row">' +
                            '<span class="svg-icon svg-icon-3">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
                            '<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />' +
                            '<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />' +
                            '<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />' +
                            '</svg>' +
                            '</span>' +
                            '</button>';



                        return btn;
                    },
                    className: 'text-center',
                    sortable: false
                }
            ],
            // autoWidth: true,
            lengthChange: false,
            "searching": true,
            "dom": "<'row'" +
                "<'col-sm-12 d-flex align-items-center justify-content-start'l>" +
                "<'col-sm-12 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "<'table-responsive'tr>" +
                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });

        $('#modal-mahasiswa-edit').on('show.bs.modal', function(e) {
            let id = $(e.relatedTarget).data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('get_mahasiswa_by_id') }}" + '/' + id,
                dataType: "JSON",
                success: function(response) {
                    $('#mahasiswa-edit-id').val(response.id);
                    $('#mahasiswa-edit-id-user').val(response.id_users);
                    $('#mahasiswa-edit-nim-mahasiswa').val(response.nim);
                    $('#mahasiswa-edit-nama-mahasiswa').val(response.nama);
                    $('#mahasiswa-edit-email-mahasiswa').val(response.email);
                    $.ajax({
                        url: "{{ route('get_all_kelas')}}",
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key,
                                value) {
                                var option = $(
                                        "<option></option>"
                                    )
                                    .attr(
                                        "value",
                                        value.id
                                    )
                                    .text(value
                                        .kelas
                                    );
                                if (value.id ==
                                    response
                                    .id_kelas) {
                                    option.attr(
                                        "selected",
                                        "selected"
                                    );
                                }
                                $('#mahasiswa-edit-id-kelas')
                                    .append(
                                        option);
                            });
                        }
                    });
                }
            });
        });

        $('#modal-mahasiswa-edit').on('hide.bs.modal', function(e) {
            $('#form-mahasiswa-edit')[0].reset();
            $('#mahasiswa-edit-id-kelas').empty();
        });

        $('#btn-mahasiswa-edit').click(function() {
            let button = $(this);
            button.prop('disabled', true);
            button.html(
                "<span class='spinner-border spinner-border-sm me-1' role='status' aria-hidden='true'></span> Please wait..."
            );

            let valid = true;
            let msg = '';

            $('#form-mahasiswa-edit :input[required]').each(function(index,
                element) {
                $(this).removeClass('is-invalid');
                $(this).next('span').removeClass('is-invalid');
                if ($(this).val() == '') {
                    $(this).addClass('is-invalid');
                    $(this).next('span').addClass('is-invalid');
                    msg = 'Please complete the data';
                    valid = false;
                }
            });
            if (valid) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('edit_mahasiswa') }}",
                    data: $('#form-mahasiswa-edit').serializeArray(),
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.msg,
                                "Success", {
                                    progressBar: true
                                });
                            button.prop('disabled', false);
                            button.text('Edit');
                            $('#modal-mahasiswa-edit').modal(
                                'hide');
                            tb_mahasiswa.ajax.reload();
                        } else {
                            toastr.error(response.msg, "Failed", {
                                progressBar: true
                            });
                            button.prop('disabled', false);
                            button.text('Edit');
                        }
                    }
                });
            } else {
                toastr.warning(msg, "Warning", {
                    progressBar: true
                });
                button.prop('disabled', false);
                button.text('Edit');
            }
        });

        $('body').on('click', '.btn-delete-mahasiswa', function() {
            let id = $(this).data('id');
            console.log(id);
            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Data yang dihapus tidak dapat kembali!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
            }).then((result) => {
                if (result.isConfirmed) {

                    let button = $(this);
                    button.prop('disabled', true);
                    button.text('Please wait...');

                    // Mendapatkan CSRF token dari tag meta
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: "POST",
                        url: "{{ url('delete_mahasiswa') }}" + '/' + id,
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.msg,
                                    "Success", {
                                        progressBar: true
                                    });
                                tb_mahasiswa.ajax.reload();
                            } else {
                                toastr.error(response.msg,
                                    "Failed", {
                                        progressBar: true
                                    });
                                button.prop('disabled',
                                    false);
                                button.text('Reset');
                            }
                        }
                    });
                }
            });
        });

        $('#modal-mahasiswa-add').on('show.bs.modal', function(e) {
            $('#form-mahasiswa-add')[0].reset();
            $.ajax({
                url: "{{ route('get_all_kelas')}}",
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key,
                        value) {
                        var option = $(
                                "<option></option>"
                            )
                            .attr(
                                "value",
                                value.id
                            )
                            .text(value
                                .kelas
                            );
                        $('#mahasiswa-add-id-kelas')
                            .append(
                                option);
                    });
                }
            });
        });

        $('#modal-mahasiswa-add').on('hide.bs.modal', function(e) {
            $('#form-mahasiswa-add')[0].reset();
            $('#mahasiswa-add-id-kelas').empty();
        });

        $('#btn-mahasiswa-save').click(function() {
            let button = $(this);
            button.prop('disabled', true);
            button.html(
                "<span class='spinner-border spinner-border-sm me-1' role='status' aria-hidden='true'></span> Please wait..."
            );
            let valid = true;
            let msg = '';
            $('#form-mahasiswa-add :input[required]').each(function(index, element) {
                $(this).removeClass('is-invalid');
                $(this).next('span').removeClass('is-invalid');
                if ($(this).val() == '') {
                    $(this).addClass('is-invalid');
                    $(this).next('span').addClass('is-invalid');
                    msg = 'Please complete the data';
                    valid = false;
                }
            });

            if (valid) {
                let form_data = new FormData($('#form-mahasiswa-add')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('add_mahasiswa')}}",
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            console.log(response);
                            toastr.success(response.msg, "Success", {
                                progressBar: true
                            });
                            button.prop('disabled', false);
                            button.text('Tambah');
                            $('#modal-mahasiswa-add').modal(
                                'hide');
                            tb_mahasiswa.ajax.reload();
                        } else {
                            console.log(response);
                            toastr.error(response.msg, "Failed", {
                                progressBar: true
                            });
                            button.prop('disabled', false);
                            button.text('Tambah');
                        }
                    }
                });
            } else {
                toastr.warning(msg, "Warning", {
                    progressBar: true
                });

                button.prop('disabled', false);
                button.text('Tambah');
            }
        });




    });
</script>


@endsection