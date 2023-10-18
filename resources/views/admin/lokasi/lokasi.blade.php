@extends('layouts.app')
@section('content')
    @include('layouts.headers.cardscontent')
@section('title')
    {{ __('AC') }}
@endsection
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h3 class="mb-0">Lokasi Air Conditioner SPH</h3>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#modal-default">New</a>
                        </div>
                    </div>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table table-flush" id="datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Id Lokasi</th>
                                <th>Nama Lokasi</th>
                                @admin()
                                    <th class="text-center">Aksi</th>
                                @endadmin
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lokasi as $loc)
                                <tr>
                                    <td>
                                        <span class="name mb-0 text-sm">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        {{ $loc->id_lokasi }}
                                    </td>

                                    <td>
                                        <span class="status">{{ $loc->nama_lokasi }}</span>
                                    </td>
                                    @admin()
                                        <td class="text-center">
                                            <div>
                                                <a href="#" type="button" title="edit obat"
                                                    class="btn btn-primayr btn-sm" data-toggle="modal"
                                                    data-target="#modalform{{ $loc->id_lokasi }}"><i
                                                        class="fa fa-edit btn btn-primary btn-sm"></i></a>
                                                <a href="#" type="button" title="hapus obat"
                                                    class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modalnotification{{ $loc->id_lokasi }} "><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    @endadmin
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    <div class="col-md-4">
        <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
            aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Tambah Data Lokasi</h3>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="{{ route('lokasi.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="id_lokasi" class="form-control-label">Nama Lokasi</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key text-blue"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="LOC000X" type="text" name="id_lokasi"
                                        id="id_lokasi">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="nama_lokasi" class="form-control-label">Nama Lokasi</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-atom"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Ruang Tamu" type="text"
                                        name="nama_lokasi" id="nama_lokasi">
                                </div>
                            </div>

                            <div class="text-center">
                                <button id="formSubmit" type="submit" class="btn btn-primary"
                                    onclick="swal ( 'Berhasil','Lokasi Telah Ditambahkan','success')">Tambah</button>
                                <button type="button" class="btn btn-danger  ml-auto"
                                    data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal buat edit data --}}
    @foreach ($lokasi as $loc)
        <div class="col-md-4">
            <div class="modal fade" id="modalform{{ $loc->id_lokasi }}" tabindex="-1" role="dialog"
                aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content bg-gradient-default">
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">Edit Data Lokasi</h3>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="{{ route('lokasi.edit', [$loc->id_lokasi]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key"></i></span>
                                        </div>
                                        <input class="form-control" value="{{ $loc->id_lokasi }}" type="text"
                                            name="id_lokasi" id="id_lokasi" disabled>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-atom"></i></span>
                                        </div>
                                        <input class="form-control" value="{{ $loc->nama_lokasi }}" type="text"
                                            name="nama_lokasi" id="nama_lokasi">
                                    </div>
                                </div>


                                <div class="text-center">
                                    <button id="formSubmit" type="submit" class="btn btn-primary"
                                        onclick="swal ( 'Berhasil','Lokasi {{ $loc->nama_lokasi }} Telah Berhasil di Edit','info')">Simpan</button>
                                    <button type="button" class="btn btn-danger  ml-auto"
                                        data-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Modal Buat Delete --}}
    @foreach ($lokasi as $loc)
        <div class="modal fade" id="modalnotification{{ $loc->id_lokasi }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                <div class="modal-content bg-gradient-default">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Hapus Lokasi ?</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('lokasi.destroy', [$loc->id_lokasi]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                        <button type="submit" title="Hapus" class="btn btn-danger"
                                            class="btn btn-danger"
                                            onclick="swal ( 'Berhasil','Lokasi {{ $loc->nama_lokasi }} Telah Dihapus','warning')">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                buttons: ['print', 'excel', 'colvis'],
                dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu: [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ]
            });
            table.buttons().container()
                .appendTo('#table_wrapper .col-md-5:eq(0)');
        });
    </script>
    <script>
        document.querySelector(".Berhasil").addEventListener('click', function() {
            swal("Our First Alert", "With some body text and success icon!", "success");
        });
    </script>
@endsection
