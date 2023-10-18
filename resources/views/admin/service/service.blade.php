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
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h3>Service Air Conditioner SPH</h3>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="btn btn-md btn-primary" data-toggle="modal"
                                data-target="#modal-default"><i class="ni ni-fat-add text-white"></i> New Entry
                                Service</a>
                        </div>
                        <div class="col-md-4 col-4 text-right">
                            <form role="form" method="post" action="{{ route('service.tanggal', [$now]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <label for="tanggal_input">Tanggal:</label>
                                <input class="" value="{{ $now }}" type="date" id="tanggal_input"
                                    name="tanggal_input">
                                <button style="width:70px" id="formSubmit" type="submit"
                                    class="btn btn-sm btn-primary">Submit
                                </button>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
                <table class="table table-flush" id="datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>ID AC</th>
                            <th>Area</th>
                            <th>Lokasi</th>
                            <th>Tanggal Service</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Nama Teknisi</th>
                            <th>Tanggal Input</th>
                            {{-- <th>Area</th> --}}
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($service as $loc)
                            <tr>
                                <td>
                                    <span class="name mb-0 text-sm">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    {{ $loc->id_ac }}
                                </td>
                                <td>
                                    {{ $loc->ac->area->nama_area }}
                                </td>
                                <td>
                                    {{ $loc->ac->lokasi->nama_lokasi }}
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($loc->tanggal_service)->format('d M Y') }}
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($loc->start_time)->format('H:i') }}
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($loc->stop_time)->format('H:i') }}
                                </td>
                                <td>
                                    {{ $loc->teknisi->nama_teknisi }}
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($loc->created_at)->format('d M Y') }}
                                </td>
                                <td class="text-center">
                                    <div>
                                        @php
                                            $id_teknisi = auth()->user()->id_teknisi;
                                        @endphp
                                        @user()
                                            @if ($id_teknisi == $loc->teknisi->id_teknisi)
                                                <a href="#" type="button" title="edit obat"
                                                    class="btn btn-primayr btn-sm" data-toggle="modal"
                                                    data-target="#modalform{{ $loc->id }}"><i
                                                        class="fa fa-edit btn btn-primary btn-sm"></i></a>
                                                <a href="#" type="button" title="hapus obat"
                                                    class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modalnotification{{ $loc->id }} "><i
                                                        class="fa fa-trash"></i></a>
                                            @endif
                                        @enduser
                                        @admin()
                                            <a href="#" type="button" title="edit obat"
                                                class="btn btn-primayr btn-sm" data-toggle="modal"
                                                data-target="#modalform{{ $loc->id }}"><i
                                                    class="fa fa-edit btn btn-primary btn-sm"></i></a>
                                            <a href="#" type="button" title="hapus obat"
                                                class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modalnotification{{ $loc->id }} "><i
                                                    class="fa fa-trash"></i></a>
                                        @endadmin
                                    </div>
                                </td>
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
                    <h3 class="modal-title" id="modal-title-default">Tambah Data service</h3>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" action="{{ route('service.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="id_area" class="form-control-label">INDOOR / OUTDOOR</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hospital text-blue"></i></span>
                                    </div>
                                    <select id="id_type_lokasi" name="id_type_lokasi" class="form-control">
                                        <option value="INDOOR">
                                            {{ 'INDOOR' }}
                                        </option>
                                        <option value="OUTDOOR">
                                            {{ 'OUTDOOR' }}
                                        </option>
                                        <option value="BOTH" selected>
                                            {{ 'BOTH' }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="id_area" class="form-control-label">Area</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-square-pin text-red"></i></span>
                                    </div>
                                    <select id="id_area" name="id_area" class="form-control">
                                        @foreach ($area as $areanya)
                                            <option value="{{ $areanya->id_area }}"
                                                @if ($areanya->id_area == 'AREA01') selected @endif>
                                                {{ $areanya->nama_area }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="id_lokasi" class="form-control-label">Lokasi</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-pin-3 text-orange"></i></span>
                                    </div>
                                    <select id="id_lokasi" name="id_lokasi" class="form-control">
                                        @foreach ($lokasi as $lokasinya)
                                            <option value="{{ $lokasinya->id_lokasi }}"
                                                @if ($lokasinya->id_lokasi == 'LOC0001') selected @endif>
                                                {{ $lokasinya->nama_lokasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="id_ac" class="form-control-label">ID AC</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="bi bi-usb-mini-fill text-blue">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-usb-mini-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M3 3a1 1 0 0 0-1 1v1.293L.293 7A1 1 0 0 0 0 7.707V12a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7.707A1 1 0 0 0 15.707 7L14 5.293V4a1 1 0 0 0-1-1H3Zm.5 5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Z" />
                                                </svg>
                                            </i>
                                        </span>
                                    </div>
                                    <select id="id_ac" name="id_ac" class="form-control">
                                        @foreach ($ac as $acnya)
                                            <option value="{{ $acnya->id_ac }}"
                                                @if ($acnya->id_ac == 'IU-OF-1') selected @endif>
                                                {{ $acnya->id_ac . ' (' . $acnya->type_lokasi . ') STATS : ' . $acnya->status }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="teknisi" class="form-control-label">Nama Teknisi</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-circle-08 text-blue"></i></span>
                                </div>
                                <select id="id_teknisi" name="id_teknisi" class="form-control">
                                    @foreach ($teknisi as $teknisinya)
                                        <option value="{{ $teknisinya->id_teknisi }}"
                                            @if ($teknisinya->id_teknisi == auth()->user()->id_teknisi) selected @endif>
                                            {{ $teknisinya->nama_teknisi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="tanggal_service" class="form-control-label">Tanggal Service</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-calendar-grid-58 text-blue"></i></span>
                                    </div>
                                    <input id="datepicker" class="form-control datepicker"name="tanggal_service"
                                        placeholder="Pilih Tanggal" type="date" value="{{ $now }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="waktu_mulai" class="form-control-label">Waktu Mulai</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-watch-time text-blue"></i></span>
                                    </div>
                                    <input id="datepicker" class="form-control datepicker"name="waktu_mulai"
                                        placeholder="Pilih Waktu" type="time"
                                        value="{{ Carbon\Carbon::now()->format('H:i') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="waktu_selesai" class="form-control-label">Waktu Selesai</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-watch-time text-blue"></i></span>
                                    </div>
                                    <input id="datepicker" class="form-control datepicker"name="waktu_selesai"
                                        placeholder="Pilih Waktu" type="time"
                                        value="{{ Carbon\Carbon::now()->addHours(5)->format('H:i') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-5">
                                <label for="status" class="form-control-label">Status</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-satisfied text-blue"></i></span>
                                    </div>
                                    <select id="status" name="status" class="form-control">
                                        <option value="4">
                                            <span class="badge badge-default">
                                                --Pilih Status Setelah di Service--
                                            </span>
                                        </option>
                                        <option value="0">
                                            <span class="badge badge-danger">Belum di Service</span>
                                        </option>
                                        <option value="1">
                                            <span class="badge badge-success"> Sudah di Service </span>
                                        </option>
                                        <option value="2">
                                            <span class="badge badge-warning"> Note </span>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <label for="keterangan" class="form-control-label">Keterangan</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-fat-add text-blue"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Keterangan" type="text"
                                        name="keterangan" id="keterangan">
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button id="formSubmit" type="submit" class="btn btn-primary"
                                onclick="swal ( 'Berhasil','service Telah Ditambahkan','success')">Tambah</button>
                            <button type="button" class="btn btn-danger  ml-auto"
                                data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('#id_type_lokasi').change(function() {
        var typeLokasi = this.value;
        console.log(typeLokasi);
        $("#id_ac").html('');
        $("#id_area").html('');
        $("#id_lokasi").html('');
        $.ajax({
            url: "{{ url('api/fetch/type_lokasi') }}",
            type: "POST",
            data: {
                type_lokasi: typeLokasi,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                // $('#id_ac').html('<option value="">-- Pilih AC --</option>');
                $.each(result.ac, function(key, value) {
                    $("#id_ac").append('<option value="' + value
                        .id_ac + '">' + value.id_ac + " (" + value.type_lokasi +
                        ") STATS :" + value.status + '</option>');
                });
                // $('#id_area').html('<option value="">-- Pilih Area --</option>');
                $.each(result.area, function(key, value) {
                    $("#id_area").append('<option value="' + value
                        .id_area + '">' + value.nama_area + " " +
                        " " + '</option>');
                });
                // $('#id_lokasi').html('<option value="">-- Pilih Lokasi --</option>');
                $.each(result.lokasi, function(key, value) {
                    $("#id_lokasi").append('<option value="' + value
                        .id_lokasi + '">' + value.nama_lokasi + " " +
                        " " + '</option>');
                });
            }
        });
    });
    $('#id_area').change(function() {
        var idArea = this.value;
        var typeLokasi = id_type_lokasi.value;
        console.log(typeLokasi);
        $("#id_ac").html('');
        $("#id_lokasi").html('');
        $.ajax({
            url: "{{ url('api/fetch/area') }}",
            type: "POST",
            data: {
                id_area: idArea,
                type_lokasi: typeLokasi,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                // $('#id_ac').html('<option value="">-- Pilih AC --</option>');
                $.each(result.ac, function(key, value) {
                    $("#id_ac").append('<option value="' + value
                        .id_ac + '">' + value.id_ac + " (" + value.type_lokasi +
                        ") STATS :" + value.status + '</option>');
                });
                // $('#id_lokasi').html('<option value="">-- Pilih Lokasi --</option>');
                $.each(result.lokasi, function(key, value) {
                    $("#id_lokasi").append('<option value="' + value
                        .id_lokasi + '">' + value.nama_lokasi + " " +
                        " " + '</option>');
                });
                // $('#type_lokasi').html('<option value="">-- Pilih INDOOR/OUTDOOR --</option>');
                $.each(result.type_lokasi, function(key, value) {
                    $("#type_lokasi").append('<option value="' + value
                        .type_lokasi + '">' + value.type_lokasi + " " +
                        " " + '</option>');
                });

            }
        });
    });
    $('#id_lokasi').change(function() {
        var idLokasi = this.value;
        var typeLokasi = id_type_lokasi.value;
        console.log(idLokasi);
        $("#id_ac").html('');
        $("#id_area").html('');
        $.ajax({
            url: "{{ url('api/fetch/lokasi') }}",
            type: "POST",
            data: {
                id_lokasi: idLokasi,
                type_lokasi: typeLokasi,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                // $('#id_ac').html('<option value="">-- Pilih AC --</option>');
                $.each(result.ac, function(key, value) {
                    $("#id_ac").append('<option value="' + value
                        .id_ac + '">' + value.id_ac + " (" + value.type_lokasi +
                        ") STATS :" + value.status + '</option>');
                });
                // $('#id_area').html('<option value="">-- Pilih Area --</option>');
                $.each(result.area, function(key, value) {
                    $("#id_area").append('<option value="' + value
                        .id_area + '">' + value.nama_area + " " +
                        " " + '</option>');
                });
                // $('#type_lokasi').html('<option value="">-- Pilih INDOOR/OUTDOOR --</option>');
                $.each(result.type_lokasi, function(key, value) {
                    $("#type_lokasi").append('<option value="' + value
                        .type_lokasi + '">' + value.type_lokasi + " " +
                        " " + '</option>');
                });
            }
        });
    });
</script>
{{-- Modal buat edit data --}}
@foreach ($service as $loc)
    <div class="col-md-4">
        <div class="modal fade" id="modalform{{ $loc->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-notification" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered " role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Edit Data service</h3>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="{{ route('service.edit', [$loc->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="id_area" class="form-control-label">Nama Area</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-circle-08 text-blue"></i></span>
                                    </div>
                                    <select id="id_area" name="id_area" class="form-control">
                                        @foreach ($area as $areanya)
                                            <option value="{{ $areanya->id_area }}"
                                                @if ($areanya->id_area == $loc->ac->id_area) selected @endif>
                                                {{ $areanya->nama_area }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_lokasi" class="form-control-label">Lokasi</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-circle-08 text-blue"></i></span>
                                    </div>
                                    <select id="id_lokasi" name="id_lokasi" class="form-control">
                                        @foreach ($lokasi as $lokasinya)
                                            <option value="{{ $lokasinya->id_lokasi }}"
                                                @if ($lokasinya->id_lokasi == $loc->ac->id_lokasi) selected @endif>
                                                {{ $lokasinya->nama_lokasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_ac" class="form-control-label">ID AC</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="bi bi-usb-mini-fill text-blue">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-usb-mini-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M3 3a1 1 0 0 0-1 1v1.293L.293 7A1 1 0 0 0 0 7.707V12a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7.707A1 1 0 0 0 15.707 7L14 5.293V4a1 1 0 0 0-1-1H3Zm.5 5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Z" />
                                                </svg>
                                            </i>
                                        </span>
                                    </div>
                                    <select id="id_ac" name="id_ac" class="form-control">
                                        @foreach ($ac as $acnya)
                                            <option value="{{ $acnya->id_ac }}"
                                                @if ($acnya->id_ac == $loc->id_ac) selected @endif>
                                                {{ $acnya->id_ac . ' (' . $acnya->type_lokasi . ') ' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_teknisi" class="form-control-label">Nama Teknisi</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-circle-08 text-blue"></i></span>
                                    </div>
                                    <select id="id_teknisi" name="id_teknisi" class="form-control">
                                        @foreach ($teknisi as $teknisinya)
                                            <option value="{{ $teknisinya->id_teknisi }}"
                                                @if ($teknisinya->id_teknisi == $loc->id_teknisi) selected @endif>
                                                {{ $teknisinya->nama_teknisi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_service" class="form-control-label">Tanggal Service</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-calendar-grid-58 text-blue"></i></span>
                                    </div>
                                    <input id="datepicker" class="form-control datepicker"name="tanggal_service"
                                        placeholder="Pilih Tanggal" type="date"
                                        value="{{ Carbon\Carbon::parse($loc->ac->tanggal_service)->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="waktu_mulai" class="form-control-label">Jam Mulai</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-black"><i
                                                class="ni ni-watch-time text-blue"></i></span>
                                    </div>
                                    <input id="datepicker" class="form-control datepicker"name="waktu_mulai"
                                        placeholder="Pilih Waktu" type="time" value="{{ $loc->start_time }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="waktu_selesai" class="form-control-label">Jam
                                    Berakhir</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-watch-time text-blue"></i></span>
                                    </div>
                                    <input id="datepicker" class="form-control datepicker"name="waktu_selesai"
                                        placeholder="Pilih Waktu" type="time" value="{{ $loc->stop_time }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="form-control-label">Status</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-satisfied text-blue"></i></span>
                                    </div>
                                    <select id="status" name="status" class="form-control">
                                        <option value="" @if (4 == $loc->ac->status) selected @endif>
                                            <span class="badge badge-default">
                                                --Pilih Status Setelah di Service--
                                            </span>
                                        </option>
                                        <option value="0" @if (0 == $loc->ac->status) selected @endif>
                                            <span class="badge badge-danger">Belum di Service</span>
                                        </option>
                                        <option value="1" @if (1 == $loc->ac->status) selected @endif>
                                            <span class="badge badge-success"> Sudah di Service </span>
                                        </option>
                                        <option value="2" @if (2 == $loc->ac->status) selected @endif>
                                            <span class="badge badge-warning"> Note </span>
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="form-control-label">Keterangan</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-fat-add text-blue"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Keterangan" type="text"
                                        value="{{ $loc->keterangan }}" name="keterangan" id="keterangan">
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="formSubmit" type="submit" class="btn btn-primary"
                                    onclick="swal ( 'Berhasil','service {{ $loc->id_ac }} Telah Berhasil di Edit','info')">Simpan</button>
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
@foreach ($service as $loc)
    <div class="modal fade" id="modalnotification{{ $loc->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-default">Hapus service ?</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('service.destroy', [$loc->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <div class="text-center">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Batal</button>
                                    <button type="submit" title="Hapus" class="btn btn-danger"
                                        class="btn btn-danger"
                                        onclick="swal ( 'Berhasil','service {{ $loc->id_ac }} Telah Dihapus','warning')">Ya</button>
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
    let Datatable;
    $(document).ready(function() {

        var Datatable = $('#datatable').DataTable({

            buttons: ['print', 'excel', 'colvis'],
            dom: "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
                "<'row'<'col-md-12'tr>>" +
                "<'row'<'col-md-5'i><'col-md-7'p>>",
            lengthMenu: [
                [25, 50, 100, -1],
                [25, 50, 100, "All"]
            ]
        });

    });
</script>
@endsection
