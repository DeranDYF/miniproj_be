@extends('template/layout')
@section('content')
<div class="toolbar bg-transparent pt-6 mb-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex flex-column align-items-start me-3 mb-5 mb-lg-0">
            <h1 class="d-flex text-dark fw-bolder fs-3 flex-column mb-0">jadwal Mata Kuliah
            </h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

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
                        <table id="tb_jadwalmatakul" class="table table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                    <th class="text-start">Kelas</th>
                                    <th class="text-start">Mata Kuliah</th>
                                    <th class="text-start">Hari</th>
                                    <th class="text-start">Jam Mulai</th>
                                    <th class="text-start">Jam Selesai</th>
                                    <th>Ruangan</th>
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

<!-- Modal Setting jadwalmatakul Edit -->
<div class="modal fade" id="modal-jadwalmatakul-edit" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center mx-4 mt-4">
                <h4 class="card-title fw-semibold">Edit Jadwal Mata Kuliah</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="post" class="mx-4" id="form-jadwalmatakul-edit" entype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="fallback">
                        <p class="card-subtitle mb-4">Untuk mengedit data jadwal mata kuliah dapat dilakukan disini.</p>
                        <div class="row">
                            <div class="mb-4">
                                <label for="hari" class="form-label fw-semibold">Hari</label>
                                <input type="hidden" id="jadwalmatakul-edit-id" name="jadwalmatakul-edit-id">
                                <select class="form-select" name="jadwalmatakul-edit-id-hari" id="jadwalmatakul-edit-id-hari">
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="jam" class="form-label fw-semibold">Jam Mulai</label>
                                <input type="text" class="form-control" id="jadwalmatakul-edit-jam-mulai" name="jadwalmatakul-edit-jam-mulai" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="ruang" class="form-label fw-semibold">Ruangan</label>
                            <div class="mb-4">
                                <input type="text" class="form-control" id="jadwalmatakul-edit-ruangan" name="jadwalmatakul-edit-ruangan" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer mx-4 mb-4">
                <button type="submit" class="btn btn-primary font-medium waves-effect" id="btn-jadwalmatakul-edit">
                    Edit
                </button>
                <button type="button" class="btn btn-light-danger text-danger font-medium waves-effect" data-bs-dismiss="modal" id="cancel-jadwalmatakul-edit">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Setting jadwalmatakul Edit -->

<script>
    $(document).ready(function() {
        var tb_jadwalmatakul = $("#tb_jadwalmatakul").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_"
            },
            ajax: {
                url: "{{ route('get_all_jadwal_mata_kuliah')}}",
                type: "GET",
                dataSrc: "",
            },
            columns: [{
                    data: "nama_kelas",
                    render: function(data, type, row) {
                        if (data === null || typeof data === 'undefined') {
                            return '<p class="text-muted"></p>';
                        } else {
                            return '<p class="text-muted">' + data + '</p>';
                        }
                    }
                },
                {
                    data: "nama_mata_kuliah",
                    render: function(data, type, row) {
                        if (data === null || typeof data === 'undefined') {
                            return '<p class="text-muted"></p>';
                        } else {
                            return '<p class="text-muted">' + data + '</p>';
                        }
                    }
                },
                {
                    data: "hari",
                    render: function(data, type, row) {
                        if (data === null || typeof data === 'undefined') {
                            return '<p class="text-muted"></p>';
                        } else {
                            return '<p class="text-muted">' + data + '</p>';
                        }
                    }
                },
                {
                    data: "jam_mulai",
                    render: function(data, type, row) {
                        if (data === null || typeof data === 'undefined') {
                            return '<p class="text-muted"></p>';
                        } else {
                            return '<p class="text-muted">' + data + '</p>';
                        }
                    }
                },
                {
                    data: "jam_selesai",
                    render: function(data, type, row) {
                        if (data === null || typeof data === 'undefined') {
                            return '<p class="text-muted"></p>';
                        } else {
                            return '<p class="text-muted">' + data + '</p>';
                        }
                    }
                },
                {
                    data: "ruangan",
                    render: function(data, type, row) {
                        if (data === null || typeof data === 'undefined') {
                            return '<p class="text-muted"></p>';
                        } else {
                            return '<p class="text-muted">' + data + '</p>';
                        }
                    }
                },
                {
                    render: function(data, type, row) {
                        var btn =
                            '<button data-id="' + row.id +
                            '"class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#modal-jadwalmatakul-edit">' +
                            '<span class="svg-icon svg-icon-3">' +
                            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
                            '<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />' +
                            '<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />' +
                            '</svg>' +
                            '</span>' +
                            '</button>' +
                            '<button data-id="' + row.id +
                            '"class="btn btn-icon btn-active-light-primary w-30px h-30px btn-delete-jadwalmatakul" data-kt-permissions-table-filter="delete_row">' +
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

        $('#modal-jadwalmatakul-edit').on('show.bs.modal', function(e) {
            let id = $(e.relatedTarget).data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('get_jadwal_mata_kuliah_by_id') }}" + '/' + id,
                dataType: "JSON",
                success: function(response) {
                    $('#jadwalmatakul-edit-id').val(response.id);
                    $('#jadwalmatakul-edit-jam-mulai').val(response.jam_mulai);
                    $('#jadwalmatakul-edit-ruangan').val(response.ruangan);
                    $.ajax({
                        url: "{{ route('get_all_hari')}}",
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
                                        .hari
                                    );
                                if (value.id ==
                                    response
                                    .id_hari) {
                                    option.attr(
                                        "selected",
                                        "selected"
                                    );
                                }
                                $('#jadwalmatakul-edit-id-hari')
                                    .append(
                                        option);
                            });
                        }
                    });

                }
            });

        });


        $("#jadwalmatakul-edit-jam-mulai").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });

        $('#modal-jadwalmatakul-edit').on('hide.bs.modal', function(e) {
            $('#form-jadwalmatakul-edit')[0].reset();
            $('#jadwalmatakul-edit-id-hari').empty();

        });
        $('#btn-jadwalmatakul-edit').click(function() {
            let button = $(this);
            button.prop('disabled', true);
            button.html(
                "<span class='spinner-border spinner-border-sm me-1' role='status' aria-hidden='true'></span> Please wait..."
            );

            let valid = true;
            let msg = '';

            $('#form-jadwalmatakul-edit :input[required]').each(function(index,
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
                    url: "{{ url('edit_jadwal_mata_kuliah') }}",
                    data: $('#form-jadwalmatakul-edit').serializeArray(),
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.msg,
                                "Success", {
                                    progressBar: true
                                });
                            button.prop('disabled', false);
                            button.text('Edit');
                            $('#modal-jadwalmatakul-edit').modal(
                                'hide');
                            tb_jadwalmatakul.ajax.reload();
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

        $('body').on('click', '.btn-delete-jadwalmatakul', function() {
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
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: "POST",
                        url: "{{ url('delete_jadwal_mata_kuliah') }}" + '/' + id,
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
                                tb_jadwalmatakul.ajax.reload();
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
    });
</script>


@endsection