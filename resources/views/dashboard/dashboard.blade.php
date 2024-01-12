@extends('template/layout')
@section('content')
<div class="toolbar bg-transparent pt-6 mb-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex flex-column align-items-start me-3 mb-5 mb-lg-0">
            <h1 class="d-flex text-dark fw-bolder fs-3 flex-column mb-0">Dashboard
                <span class="text-muted fs-7 fw-bold mt-2">Selamat Datang
                    <span class="text-primary fw-bolder">{{ Auth::user()->name }}</span></span>
            </h1>
        </div>
    </div>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="row">
            @if (Auth::user()->level == 'admin')
            <div class="col-xxl-6">
                <div class="card h-md-100" style="background: linear-gradient(112.14deg, #00D2FF 0%, #3A7BD5 100%)">
                    <div class="card-body">
                        <div class="row align-items-center h-100">
                            <div class="col-7 ps-xl-13">
                                <div class="text-white mb-6 pt-6">
                                    <span class="fs-4 fw-bold me-2 d-block lh-1 pb-2 opacity-75">Selamat Datang</span>
                                    <span class="fs-2qx fw-bolder">Mini Project Backend</span>
                                </div>
                                <div class="d-flex align-items-center flex-wrap d-grid gap-2 mb-10 mb-xl-20">
                                    <div class="d-flex align-items-center me-5 me-xl-13">
                                        <div class="symbol symbol-30px symbol-circle me-3">
                                            <span class="symbol-label" style="background: #35C7FF">
                                                <span class="svg-icon svg-icon-5 svg-icon-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.8"
                                                            d="M3 6C2.4 6 2 5.6 2 5V3C2 2.4 2.4 2 3 2H5C5.6 2 6 2.4 6 3C6 3.6 5.6 4 5 4H4V5C4 5.6 3.6 6 3 6ZM22 5V3C22 2.4 21.6 2 21 2H19C18.4 2 18 2.4 18 3C18 3.6 18.4 4 19 4H20V5C20 5.6 20.4 6 21 6C21.6 6 22 5.6 22 5ZM6 21C6 20.4 5.6 20 5 20H4V19C4 18.4 3.6 18 3 18C2.4 18 2 18.4 2 19V21C2 21.6 2.4 22 3 22H5C5.6 22 6 21.6 6 21ZM22 21V19C22 18.4 21.6 18 21 18C20.4 18 20 18.4 20 19V20H19C18.4 20 18 20.4 18 21C18 21.6 18.4 22 19 22H21C21.6 22 22 21.6 22 21ZM16 11V9C16 6.8 14.2 5 12 5C9.8 5 8 6.8 8 9V11C7.2 11 6.5 11.7 6.5 12.5C6.5 13.3 7.2 14 8 14V15C8 17.2 9.8 19 12 19C14.2 19 16 17.2 16 15V14C16.8 14 17.5 13.3 17.5 12.5C17.5 11.7 16.8 11 16 11ZM13.4 15C13.7 15 14 15.3 13.9 15.6C13.6 16.4 12.9 17 12 17C11.1 17 10.4 16.5 10.1 15.7C10 15.4 10.2 15 10.6 15H13.4Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M9.2 12.9C9.1 12.8 9.10001 12.7 9.10001 12.6C9.00001 12.2 9.3 11.7 9.7 11.6C10.1 11.5 10.6 11.8 10.7 12.2C10.7 12.3 10.7 12.4 10.7 12.5L9.2 12.9ZM14.8 12.9C14.9 12.8 14.9 12.7 14.9 12.6C15 12.2 14.7 11.7 14.3 11.6C13.9 11.5 13.4 11.8 13.3 12.2C13.3 12.3 13.3 12.4 13.3 12.5L14.8 12.9ZM16 7.29998C16.3 6.99998 16.5 6.69998 16.7 6.29998C16.3 6.29998 15.8 6.30001 15.4 6.20001C15 6.10001 14.7 5.90001 14.4 5.70001C13.8 5.20001 13 5.00002 12.2 4.90002C9.9 4.80002 8.10001 6.79997 8.10001 9.09997V11.4C8.90001 10.7 9.40001 9.8 9.60001 9C11 9.1 13.4 8.69998 14.5 8.29998C14.7 9.39998 15.3 10.5 16.1 11.4V9C16.1 8.5 16 8 15.8 7.5C15.8 7.5 15.9 7.39998 16 7.29998Z"
                                                            fill="currentColor" />

                                                    </svg>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="text-white">
                                            <span class="fw-bold d-block fs-8 opacity-75">Jumlah Dosen</span>
                                            <span class="fw-bolder fs-7">{{ $count_dosen }} Orang</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-30px symbol-circle me-3">
                                            <span class="symbol-label" style="background: #35C7FF">
                                                <span class="svg-icon svg-icon-5 svg-icon-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                                            fill="currentColor" />
                                                        <path opacity="0.8"
                                                            d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="text-white">
                                            <span class="fw-bold d-block fs-8 opacity-75">Jumlah Mahasiswa</span>
                                            <span class="fw-bolder fs-7">{{ $count_mahasiswa }} Orang</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-30px symbol-circle me-3">
                                            <span class="symbol-label" style="background: #35C7FF">
                                                <span class="svg-icon svg-icon-5 svg-icon-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path
                                                            d="M2 16C2 16.6 2.4 17 3 17H21C21.6 17 22 16.6 22 16V15H2V16Z"
                                                            fill="currentColor" />
                                                        <path opacity="0.8"
                                                            d="M21 3H3C2.4 3 2 3.4 2 4V15H22V4C22 3.4 21.6 3 21 3Z"
                                                            fill="currentColor" />
                                                        <path opacity="0.8" d="M15 17H9V20H15V17Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="text-white">
                                            <span class="fw-bold d-block fs-8 opacity-75">Jumlah Matkul</span>
                                            <span class="fw-bolder fs-7">{{ $count_mata_kuliah }} Matkul</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-30px symbol-circle me-3">
                                            <span class="symbol-label" style="background: #35C7FF">
                                                <span class="svg-icon svg-icon-5 svg-icon-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M9.2 3H3C2.4 3 2 3.4 2 4V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V7C22 6.4 21.6 6 21 6H12L10.4 3.60001C10.2 3.20001 9.7 3 9.2 3Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="text-white">
                                            <span class="fw-bold d-block fs-8 opacity-75">Jumlah Kelas</span>
                                            <span class="fw-bolder fs-7">{{ $count_kelas }} Kelas</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-5 pt-10">
                                <div class="bgi-no-repeat bgi-size-contain bgi-position-x-end h-225px"
                                    style="background-image:url('assets/media/svg/illustrations/easy/5.svg');"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col mt-8">
                <div class="card shadow-sm">
                    @if (Auth::user()->level == 'mahasiswa')
                    <div class="card-header">
                        <h3 class="card-title">Jadwal Mata Kuliah Anda</h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_jadwal_mahasiswa" class="table table-row-bordered gy-5 gs-7 border rounded">
                                <thead>
                                    <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                        <th class="text-start">Hari</th>
                                        <th class="text-start">Jam</th>
                                        <th class="text-start">Ruangan</th>
                                        <th class="text-start">Kode Mata Kuliah</th>
                                        <th class="text-start">Mata Kuliah</th>
                                        <th class="text-start">Dosen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <script>
                            $(document).ready(function() {
                                var tb_jadwal_mahasiswa = $("#tb_jadwal_mahasiswa").DataTable({
                                    "language": {
                                        "lengthMenu": "Show _MENU_"
                                    },
                                    ajax: {
                                        url: "{{ route('get_all_jadwal_mata_kuliah_mahasiswa')}}",
                                        type: "GET",
                                        dataSrc: "",
                                    },
                                    columns: [{
                                            data: "hari"
                                        },
                                        {
                                            data: null,
                                            render: function(data, type, row) {
                                                if (data === null || typeof data ===
                                                    'undefined' || typeof data.jam_mulai ===
                                                    'undefined') {
                                                    return '<p class="text-muted"></p>';
                                                } else {
                                                    var jamSelesai = typeof data.jam_selesai !==
                                                        'undefined' ? ' - ' + data.jam_selesai :
                                                        '';
                                                    return '<p class="text-muted">' + data
                                                        .jam_mulai + jamSelesai + '</p>';
                                                }
                                            }
                                        },
                                        {
                                            data: "ruangan"
                                        },
                                        {
                                            data: "kode_mata_kuliah"
                                        },
                                        {
                                            data: "nama_mata_kuliah"
                                        },
                                        {
                                            data: "dosen"
                                        }
                                    ],
                                    columnDefs: [{
                                        targets: "_all",
                                        render: function(data, type, row, meta) {
                                            if (data === null || typeof data ===
                                                'undefined') {
                                                return '<p class="text-muted"></p>';
                                            } else {
                                                return '<p class="text-muted">' + data +
                                                    '</p>';
                                            }
                                        }
                                    }],
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
                                        ">",
                                });
                            });
                            </script>
                        </div>
                    </div>
                    @endif
                    @if (Auth::user()->level == 'dosen')
                    <div class="card-header">
                        <h3 class="card-title">Jadwal Mengajar Anda</h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_jadwal_dosen" class="table table-row-bordered gy-5 gs-7 border rounded">
                                <thead>
                                    <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                        <th class="text-start">Hari</th>
                                        <th class="text-start">Jam</th>
                                        <th class="text-start">Ruangan</th>
                                        <th class="text-start">Kode Mata Kuliah</th>
                                        <th class="text-start">Mata Kuliah</th>
                                        <th class="text-start">Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <script>
                            $(document).ready(function() {
                                var tb_jadwal_dosen = $("#tb_jadwal_dosen").DataTable({
                                    "language": {
                                        "lengthMenu": "Show _MENU_"
                                    },
                                    ajax: {
                                        url: "{{ route('get_all_jadwal_mata_kuliah_dosen')}}",
                                        type: "GET",
                                        dataSrc: "",
                                    },
                                    columns: [{
                                            data: "hari"
                                        },
                                        {
                                            data: null,
                                            render: function(data, type, row) {
                                                if (data === null || typeof data ===
                                                    'undefined' || typeof data.jam_mulai ===
                                                    'undefined') {
                                                    return '<p class="text-muted"></p>';
                                                } else {
                                                    var jamSelesai = typeof data.jam_selesai !==
                                                        'undefined' ? ' - ' + data.jam_selesai :
                                                        '';
                                                    return '<p class="text-muted">' + data
                                                        .jam_mulai + jamSelesai + '</p>';
                                                }
                                            }
                                        },
                                        {
                                            data: "ruangan"
                                        },
                                        {
                                            data: "kode_mata_kuliah"
                                        },
                                        {
                                            data: "nama_mata_kuliah"
                                        },
                                        {
                                            data: "nama_kelas"
                                        }
                                    ],
                                    columnDefs: [{
                                        targets: "_all",
                                        render: function(data, type, row, meta) {
                                            if (data === null || typeof data ===
                                                'undefined') {
                                                return '<p class="text-muted"></p>';
                                            } else {
                                                return '<p class="text-muted">' + data +
                                                    '</p>';
                                            }
                                        }
                                    }],
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
                            });
                            </script>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection