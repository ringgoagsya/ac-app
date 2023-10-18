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
                            <h3 class="mb-0">Teknisi Air Conditioner SPH</h3>
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
                                <th>ID TEKNISI</th>
                                <th>Nama Teknisi</th>
                                <th>Type Teknisi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teknisi as $loc)
                                <tr>
                                    <td>
                                        <span class="name mb-0 text-sm">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        {{ $loc->id_teknisi }}
                                    </td>

                                    <td>
                                        <span class="status">{{ $loc->nama_teknisi }}</span>
                                    </td>
                                    <td>
                                        {{ $loc->type_teknisi }}
                                    </td>
                                    @admin()
                                        <td class="text-center">
                                            <div>
                                                <a href="#" type="button" title="edit obat"
                                                    class="btn btn-primayr btn-sm" data-toggle="modal"
                                                    data-target="#modalform{{ $loc->id_teknisi }}"><i
                                                        class="fa fa-edit btn btn-primary btn-sm"></i></a>
                                                <a href="#" type="button" title="hapus obat"
                                                    class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modalnotification{{ $loc->id_teknisi }} "><i
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
                        <h3 class="modal-title" id="modal-title-default">Tambah Data Teknisi</h3>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="{{ route('teknisi.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @php
                                $last_teknisi_internal = 'Belum Ada Teknisi';
                                $last_teknisi_external = 'Belum Ada Teknisi';
                            @endphp
                            @foreach ($teknisi as $pem_in)
                                @if ($pem_in->type_teknisi == 'INTERNAL')
                                    @php
                                        $last_teknisi_internal = $pem_in;
                                    @endphp
                                @endif
                            @endforeach
                            @foreach ($teknisi as $pem_ex)
                                @if ($pem_ex->type_teknisi == 'EXTERNAL')
                                    @php
                                        $last_teknisi_external = $pem_ex;
                                    @endphp
                                @endif
                            @endforeach
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">LAST ID</span>
                                    <textarea class="form-control" aria-label="LAST ID">
{{ "LAST ID TEKNISI 'INTERNAL':" . $last_teknisi_internal->id_teknisi }}
{{ "LAST ID TEKNISI 'EXTERNAL': " . $last_teknisi_external->id_teknisi }}
                                </textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                    </div>
                                    <select id="type_teknisi" name="type_teknisi" class="form-control">
                                        <option value="INTERNAL" selected>{{ 'INTERNAL' }}
                                        </option>
                                        <option value="EXTERNAL">{{ 'EXTERNAL' }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-align-left-2"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="ID TEKNISI" type="text"
                                        name="id_teknisi" id="id_teknisi">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-atom"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Nama Teknisi" type="text"
                                        name="nama_teknisi" id="nama_teknisi">
                                </div>
                            </div>

                            <div class="text-center">
                                <button id="formSubmit" type="submit" class="btn btn-primary"
                                    onclick="swal ( 'Berhasil','Teknisi Telah Ditambahkan','success')">Tambah</button>
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
    @foreach ($teknisi as $loc)
        <div class="col-md-4">
            <div class="modal fade" id="modalform{{ $loc->id_teknisi }}" tabindex="-1" role="dialog"
                aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content bg-gradient-default">
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">Edit Data teknisi</h3>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post"
                                action="{{ route('teknisi.edit', [$loc->id_teknisi]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                        </div>
                                        <select id="type_teknisi" name="type_teknisi" class="form-control">
                                            <option value="INTERNAL" @if ($loc->type_teknisi == 'INTERNAL') selected @endif>
                                                {{ 'INTERNAL' }}
                                            </option>
                                            <option value="EXTERNAL" @if ($loc->type_teknisi == 'EXTERNAL') selected @endif>
                                                {{ 'EXTERNAL' }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-atom"></i></span>
                                        </div>
                                        <input class="form-control" value="{{ $loc->nama_teknisi }}" type="text"
                                            name="nama_teknisi" id="nama_teknisi">
                                    </div>
                                </div>


                                <div class="text-center">
                                    <button id="formSubmit" type="submit" class="btn btn-primary"
                                        onclick="swal ( 'Berhasil','teknisi {{ $loc->nama_teknisi }} Telah Berhasil di Edit','info')">Simpan</button>
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
    @foreach ($teknisi as $loc)
        <div class="modal fade" id="modalnotification{{ $loc->id_teknisi }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                <div class="modal-content bg-gradient-default">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Hapus teknisi ?</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('teknisi.destroy', [$loc->id_teknisi]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                        <button type="submit" title="Hapus" class="btn btn-danger"
                                            class="btn btn-danger"
                                            onclick="swal ( 'Berhasil','teknisi {{ $loc->nama_teknisi }} Telah Dihapus','warning')">Ya</button>
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
