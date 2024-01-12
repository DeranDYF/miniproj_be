@extends('template/layout')
@section('content')
<div class="toolbar bg-transparent pt-6 mb-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex flex-column align-items-start me-3 mb-5 mb-lg-0">
            <h1 class="d-flex text-dark fw-bolder fs-3 flex-column mb-0">Mata Kuliah
            </h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#modal-mata-kuliah-add">Tambah
                Mata Kuliah</a>
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
                        <table id="tb_mata_kuliah" class="table table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                    <th class="text-start">Kode Matkul</th>
                                    <th class="text-start">Nama Matkul</th>
                                    <th>SKS</th>
                                    <th>Dosen</th>
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

<!-- Modal Setting mata-kuliah Add -->
<div class="modal fade" id="modal-mata-kuliah-add" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center mx-4 mt-4">
                <h4 class="card-title fw-semibold">Tambah Mata Kuliah</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="post" class="mx-4" id="form-mata-kuliah-add" entype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="fallback">
                        <p class="card-subtitle mb-4">Untuk menambah data mata kuliah dapat dilakukan disini.</p>
                        <div class="row">
                            <div class="mb-4">
                                <label for="kode" class="form-label fw-semibold">kode Mata Kuliah</label>
                                <input type="text" class="form-control" name="mata-kuliah-add-kode-mata-kuliah"
                                    id="mata-kuliah-add-nama-mata-kuliah" required>
                            </div>
                            <div class="mb-4">
                                <label for="nama" class="form-label fw-semibold">nama Mata Kuliah</label>
                                <input type="text" class="form-control" name="mata-kuliah-add-nama-mata-kuliah"
                                    id="mata-kuliah-add-nama-mata-kuliah" required>
                            </div>
                            <div class="mb-4">
                                <label for="sks" class="form-label fw-semibold">Jumlah SKS</label>
                                <input type="text" class="form-control" name="mata-kuliah-add-sks-mata-kuliah"
                                    id="mata-kuliah-add-sks-mata-kuliah" required>
                            </div>
                            <div class="mb-4">
                                <label for="dosen" class="form-label fw-semibold">Dosen Pengampu</label>
                                <select class="form-select" name="mata-kuliah-add-id-dosen-mata-kuliah"
                                    id="mata-kuliah-add-id-dosen-mata-kuliah" required>
                                </select>
                                <input type="hidden" class="form-control" id="created"
                                    value="{{ Auth::user()->username }}" name="created" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer mx-4 mb-4">
                <button type="submit" class="btn btn-primary font-medium waves-effect" id="btn-mata-kuliah-save">
                    Tambah
                </button>
                <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect"
                    data-bs-dismiss="modal" id="cancel-mata-kuliah-add">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Setting mata-kuliah Add -->

<!-- Modal Setting mata-kuliah Edit -->
<div class="modal fade" id="modal-mata-kuliah-edit" tabindex="-1" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center mx-4 mt-4">
                <h4 class="card-title fw-semibold">Edit mata-kuliah</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="post" class="mx-4" id="form-mata-kuliah-edit" entype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="fallback">
                        <p class="card-subtitle mb-4">Untuk mengedit data mata-kuliah dapat dilakukan disini.</p>
                        <div class="row">
                            <div class="mb-4">
                                <label for="kode" class="form-label fw-semibold">kode Mata Kuliah</label>
                                <input type="hidden" class="form-control" name="mata-kuliah-edit-id"
                                    id="mata-kuliah-edit-id" readonly required>
                                <input type="text" class="form-control" name="mata-kuliah-edit-kode-mata-kuliah"
                                    id="mata-kuliah-edit-kode-mata-kuliah" readonly required>
                            </div>
                            <div class="mb-4">
                                <label for="nama" class="form-label fw-semibold">nama Mata Kuliah</label>
                                <input type="text" class="form-control" name="mata-kuliah-edit-nama-mata-kuliah"
                                    id="mata-kuliah-edit-nama-mata-kuliah" required>
                            </div>
                            <div class="mb-4">
                                <label for="sks" class="form-label fw-semibold">Jumlah SKS</label>
                                <input type="text" class="form-control" name="mata-kuliah-edit-sks-mata-kuliah"
                                    id="mata-kuliah-edit-sks-mata-kuliah" required>
                            </div>
                            <div class="mb-4">
                                <label for="dosen" class="form-label fw-semibold">Dosen Pengampu</label>
                                <select class="form-select" name="mata-kuliah-edit-id-dosen-mata-kuliah"
                                    id="mata-kuliah-edit-id-dosen-mata-kuliah" required>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer mx-4 mb-4">
                <button type="submit" class="btn btn-primary font-medium waves-effect" id="btn-mata-kuliah-edit">
                    Edit
                </button>
                <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect"
                    data-bs-dismiss="modal" id="cancel-mata-kuliah-edit">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Setting mata-kuliah Edit -->

<script>
$(document).ready(function() {
    var tb_mata_kuliah = $("#tb_mata_kuliah").DataTable({
        "language": {
            "lengthMenu": "Show _MENU_"
        },
        ajax: {
            url: "{{ route('get_all_mata_kuliah')}}",
            type: "GET",
            dataSrc: "",
        },
        columns: [{
                data: "kode_mata_kuliah",
                render: function(data, type, row) {
                    return '<p class="text-muted">' + data + '</p>';
                }
            },
            {
                data: "nama_mata_kuliah",
                render: function(data, type, row) {
                    return '<p class="text-muted">' + data + '</p>';
                }
            },
            {
                data: "sks",
                render: function(data, type, row) {
                    return '<p class="text-muted">' + data + '</p>';
                }
            },
            {
                data: "nama_dosen",
                render: function(data, type, row) {
                    return '<p class="text-muted">' + data + '</p>';
                }
            },
            {
                render: function(data, type, row) {
                    var btn =
                        '<button data-id="' + row.id +
                        '"class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#modal-mata-kuliah-edit">' +
                        '<span class="svg-icon svg-icon-3">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
                        '<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />' +
                        '<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />' +
                        '</svg>' +
                        '</span>' +
                        '</button>' +
                        '<button data-id="' + row.id +
                        '"class="btn btn-icon btn-active-light-primary w-30px h-30px btn-delete-mata-kuliah" data-kt-permissions-table-filter="delete_row">' +
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

    $('#modal-mata-kuliah-edit').on('show.bs.modal', function(e) {
        let id = $(e.relatedTarget).data('id');
        $.ajax({
            type: "GET",
            url: "{{ url('get_mata_kuliah_by_id') }}" + '/' + id,
            dataType: "JSON",
            success: function(response) {
                $('#mata-kuliah-edit-id').val(response.id);
                $('#mata-kuliah-edit-kode-mata-kuliah').val(response.kode_mata_kuliah);
                $('#mata-kuliah-edit-nama-mata-kuliah').val(response.nama_mata_kuliah);
                $('#mata-kuliah-edit-sks-mata-kuliah').val(response.sks);
                $.ajax({
                    url: "{{ route('get_all_dosen')}}",
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
                                    .nama
                                );
                            if (value.id ==
                                response
                                .id_dosen) {
                                option.attr(
                                    "selected",
                                    "selected"
                                );
                            }
                            $('#mata-kuliah-edit-id-dosen-mata-kuliah')
                                .append(
                                    option);
                        });
                    }
                });
            }
        });
    });

    $('#modal-mata-kuliah-edit').on('hide.bs.modal', function(e) {
        $('#form-mata-kuliah-edit')[0].reset();
        $('#mata-kuliah-edit-id-dosen-mata-kuliah').empty();
    });

    $('#btn-mata-kuliah-edit').click(function() {
        let button = $(this);
        button.prop('disabled', true);
        button.html(
            "<span class='spinner-border spinner-border-sm me-1' role='status' aria-hidden='true'></span> Please wait..."
        );

        let valid = true;
        let msg = '';

        $('#form-mata-kuliah-edit :input[required]').each(function(index,
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
                url: "{{ url('edit_mata_kuliah') }}",
                data: $('#form-mata-kuliah-edit').serializeArray(),
                dataType: "JSON",
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.msg,
                            "Success", {
                                progressBar: true
                            });
                        button.prop('disabled', false);
                        button.text('Edit');
                        $('#modal-mata-kuliah-edit').modal(
                            'hide');
                        tb_mata_kuliah.ajax.reload();
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

    $('body').on('click', '.btn-delete-mata-kuliah', function() {
        let id = $(this).data('id');
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
                    url: "{{ url('delete_mata_kuliah') }}" + '/' + id,
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
                            tb_mata_kuliah.ajax.reload();
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

    $('#modal-mata-kuliah-add').on('show.bs.modal', function(e) {
        $('#form-mata-kuliah-add')[0].reset();
        $.ajax({
            url: "{{ route('get_all_dosen')}}",
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
                            .nama
                        );
                    $('#mata-kuliah-add-id-dosen-mata-kuliah')
                        .append(
                            option);
                });
            }
        });
    });

    $('#modal-mata-kuliah-add').on('hide.bs.modal', function(e) {
        $('#form-mata-kuliah-add')[0].reset();
        $('#mata-kuliah-add-id-dosen-mata-kuliah').empty();
    });

    $('#btn-mata-kuliah-save').click(function() {
        let button = $(this);
        button.prop('disabled', true);
        button.html(
            "<span class='spinner-border spinner-border-sm me-1' role='status' aria-hidden='true'></span> Please wait..."
        );
        let valid = true;
        let msg = '';
        $('#form-mata-kuliah-add :input[required]').each(function(index, element) {
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
            let form_data = new FormData($('#form-mata-kuliah-add')[0]);

            $.ajax({
                type: "POST",
                url: "{{ route('add_mata_kuliah')}}",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.msg, "Success", {
                            progressBar: true
                        });
                        button.prop('disabled', false);
                        button.text('Tambah');
                        $('#modal-mata-kuliah-add').modal(
                            'hide');
                        tb_mata_kuliah.ajax.reload();
                    } else {
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