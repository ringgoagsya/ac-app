@extends('layouts.app')
@section('content')
    @include('layouts.headers.cardscontent')
@section('title')
    {{ __('AC') }}
@endsection
<!-- Page content -->
<style>
    /* Ganti warna teks menjadi abu-abu atau warna yang Anda inginkan */
    input[disabled] {
        color: #000000;
        /* Ubah ini sesuai keinginan Anda */
    }

    .form-control {
        color: #000000;
        /* Ubah warna teks sesuai keinginan Anda */
    }
</style>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h3 class="mb-0">Air Conditioner SPH</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <div>
                            <div>
                                <div class="body">
                                    <form role="form" method="post" action="{{ route('ac.edit', [$ac->id_ac]) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <div class="form-group">
                                            <div>
                                                <label for="example-text-input" class="form-control-label">ID AC</label>
                                                <input disabled class="form-control" placeholder="ID ac" type="text"
                                                    value="{{ $ac->id_ac }}" name="id_ac" id="id_ac">
                                            </div>
                                        </div>
                                        @php
                                            $now = Carbon\Carbon::now()->format('Y-m-d');
                                            $terakhir = 'Belum Di Service';
                                            $terakhir_keterangan = 'Belum Di Service';
                                            $status = 'Belum Di Service';
                                            $keterangan_ac = 'Belum Di Service';
                                            $teknisi = 'Belum ada teknisi';
                                            $nama_teknisi = 'Belum ada teknisi';
                                            $start = 'Belum Di Service';
                                            $end = 'Belum Di Service';
                                        @endphp
                                        @foreach ($last_service as $last)
                                            @if ($last != null)
                                                @if ($last->id_ac == $ac->id_ac)
                                                    @php
                                                        $terakhir = Carbon\Carbon::parse($last->tanggal_service)->format('d M Y');
                                                        $terakhir_keterangan = Carbon\Carbon::parse($last->tanggal_service)->diffForHumans($now);
                                                        $status = $ac->status;
                                                        $keterangan_ac = $last->keterangan;
                                                        $teknisi = $last->id_teknisi;
                                                        $nama_teknisi = $last->teknisi->nama_teknisi;
                                                        $start = $last->start_time;
                                                        $end = $last->stop_time;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endforeach

                                        <div class="row form-group">
                                            <div class="col-md-3">
                                                <label for="example-text-input" class="form-control-label">Terakhir
                                                    Service</label>
                                                <input disabled class="form-control" placeholder="Terakhir Service"
                                                    type="text" value="{{ $terakhir }}" name="last_service"
                                                    id="last_service">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="example-text-input" class="form-control-label">Keterangan
                                                    Tanggal</label>
                                                <input disabled class="form-control" placeholder="Terakhir Service"
                                                    type="text" value="{{ $terakhir_keterangan }}"
                                                    name="keterangan_last_service" id="keterangan_last_service">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="example-text-input" class="form-control-label">Mulai</label>
                                                <input disabled class="form-control" placeholder="Terakhir Service"
                                                    type="text" value="{{ $start }}"
                                                    name="keterangan_last_service" id="keterangan_last_service">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="example-text-input"
                                                    class="form-control-label">Selesai</label>
                                                <input disabled class="form-control" placeholder="Terakhir Service"
                                                    type="text" value="{{ $end }}"
                                                    name="keterangan_last_service" id="keterangan_last_service">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-3">
                                                <label for="example-text-input" class="form-control-label">ID
                                                    Teknisi</label>
                                                <input disabled class="form-control" placeholder="Terakhir Service"
                                                    type="text" value="{{ $teknisi }}"
                                                    name="keterangan_last_service" id="keterangan_last_service">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="example-text-input" class="form-control-label">Nama
                                                    Teknisi</label>
                                                <input disabled class="form-control" placeholder="Terakhir Service"
                                                    type="text" value="{{ $nama_teknisi }}"
                                                    name="keterangan_last_service" id="keterangan_last_service">
                                            </div>
                                            <div class="col-md-3">
                                                @if ($status == 1)
                                                    @php $hasil = 'DONE'; @endphp
                                                @elseif($status == 2)
                                                    @php $hasil = 'WARNING'; @endphp
                                                @elseif($status == 0)
                                                    @php $hasil = 'DANGER'; @endphp
                                                @else
                                                    @php $hasil = 'STAND BY'; @endphp
                                                @endif
                                                <label for="example-text-input"
                                                    class="form-control-label">Status</label>
                                                <input disabled class="form-control" placeholder="Terakhir Service"
                                                    type="text" value="{{ $hasil }}"
                                                    name="keterangan_last_service" id="keterangan_last_service">

                                            </div>
                                            <div class="col-md-3">
                                                <label for="example-text-input" class="form-control-label">Keterangan
                                                    Service</label>
                                                <input disabled class="form-control" placeholder="Terakhir Service"
                                                    type="text" value="{{ $keterangan_ac }}"
                                                    name="keterangan_last_service" id="keterangan_last_service">
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <label for="example-text-input" class="form-control-label">AREA</label>
                                            <select @user() disabled @enduser
                                                id="id_area" name="id_area" class="form-control">
                                                @foreach ($area as $areanya)
                                                    <option value="{{ $areanya->id_area }}"
                                                        @if ($areanya->id_area == $ac->id_area) selected @endif>
                                                        {{ $areanya->nama_area }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <label for="example-text-input"
                                                    class="form-control-label">LOKASI</label>
                                                <select @user() disabled
                                                    @enduser id="id_lokasi" name="id_lokasi"
                                                    class="form-control">
                                                    @foreach ($lokasi as $lokasinya)
                                                        <option value="{{ $lokasinya->id_lokasi }}"
                                                            @if ($lokasinya->id_lokasi == $ac->id_lokasi) selected @endif>
                                                            {{ $lokasinya->nama_lokasi }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <label for="example-text-input" class="form-control-label">TYPE
                                                    LOKASI</label>
                                                <select @user() disabled @enduser
                                                    id="type_lokasi" name="type_lokasi" class="form-control">
                                                    <option value="INDOOR"
                                                        @if ('INDOOR' == $ac->type_lokasi) selected @endif>
                                                        {{ 'INDOOR' }}
                                                    </option>
                                                    <option value="OUTDOOR"
                                                        @if ('OUTDOOR' == $ac->type_lokasi) selected @endif>
                                                        {{ 'OUTDOOR' }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <label for="example-text-input"
                                                    class="form-control-label">STATUS</label>
                                                <select @user() disabled @enduser
                                                    id="status" name="status" class="form-control">
                                                    <option value="4">
                                                        <span class="badge badge-default">
                                                            --Pilih Status Setelah di Service--
                                                        </span>
                                                    </option>
                                                    <option value="0"
                                                        @if ('0' == $ac->status) selected @endif>
                                                        <span class="badge badge-danger">Belum di Service</span>
                                                    </option>
                                                    <option value="1"
                                                        @if ('1' == $ac->status) selected @endif>
                                                        <span class="badge badge-success"> Sudah di Service </span>
                                                    </option>
                                                    <option value="2"
                                                        @if ('2' == $ac->status) selected @endif>
                                                        <span class="badge badge-warning"> Note </span>
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="example-text-input" class="form-control-label">ALARM
                                                        SERVICE</label>
                                                    <input @user() disabled
                                                        @enduser class="form-control"
                                                        placeholder="ALARM" type="text"
                                                        value="{{ $ac->alarm_service }}" name="alarm_service"
                                                        id="alarm_service">
                                                </div>
                                            </div>
                                            @admin()
                                                <div class="text-center">
                                                    <button id="formSubmit" type="submit" class="btn btn-primary"
                                                        onclick="swal ( 'Berhasil','ac {{ $ac->id_ac }} Telah Berhasil di Edit','info')">Simpan</button>
                                                </div>
                                            @endadmin
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('modals')
@endsection
@section('script')
@endsection
