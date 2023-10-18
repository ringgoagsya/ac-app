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
                            <h3 class="mb-0">Air Conditioner SPH</h3>
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
                                <th>Id ac</th>
                                <th>Nama Lokasi</th>
                                <th>Nama Area</th>
                                <th>Status</th>
                                <th>Terakhir Service</th>
                                <th>Keterangan</th>
                                {{-- @admin() --}}
                                <th class="text-center">Aksi</th>
                                {{-- @endadmin --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ac as $loc)
                                <tr>
                                    <td>
                                        <span class="name mb-0 text-sm">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        {{ $loc->id_ac }}
                                    </td>
                                    <td>
                                        <span class="status">{{ $loc->lokasi->nama_lokasi }}</span>
                                    </td>
                                    <td>
                                        <span class="status">{{ $loc->area->nama_area }}</span>
                                    </td>
                                    <td>
                                        @if ($loc->status == 1)
                                            <span class="badge badge-success">DONE</span>
                                        @elseif($loc->status == 2)
                                            <span class="badge badge-warning">WARNING</span>
                                        @elseif($loc->status == 0)
                                            <span class="badge badge-danger">DANGER</span>
                                        @else
                                            <span class="badge badge-default">STAND BY</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php $tanggal = 'Belum Di Service' @endphp
                                        @foreach ($last_service as $last)
                                            @if ($last != null)
                                                @if ($last->id_ac == $loc->id_ac)
                                                    @php $tanggal = Carbon\Carbon::parse($last->tanggal_service)->format('d M Y') @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                        {{ $tanggal }}
                                    </td>
                                    <td>
                                        @php $keterangan = 'Belum Di Service' @endphp
                                        @foreach ($last_service as $last)
                                            @if ($last != null)
                                                @if ($last->id_ac == $loc->id_ac)
                                                    @php $keterangan = Carbon\Carbon::parse($last->tanggal_service)->diffForHumans($now) @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                        {{ $keterangan }}
                                    </td>
                                    <td class="text-center">
                                        <div>
                                            <a href="{{ route('detail_ac.index', $loc->id_ac) }}" type="button"
                                                target="_blank" title="detail obat" class="btn btn-pr btn-sm"><i
                                                    class="fa fa-eye btn btn-default btn-sm"></i></a>
                                            @admin()
                                                <a href="#" type="button" title="hapus obat"
                                                    class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modalnotification{{ $loc->id_ac }} "><i
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
@admin()
    @section('modals')
        <div class="col-md-4">
            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">Tambah Data ac</h3>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="{{ route('ac.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <label for="id_ac" class="form-control-label">ID Air Conditioner</label>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-key text-blue"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="IU/OU-KODELOKASI-NO.UNIT" type="text"
                                            name="id_ac" id="id_ac">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="id_area" class="form-control-label">Nama Area</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-building text-blue"></i></span>
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
                                <div class="form-group">
                                    <label for="id_lokasi" class="form-control-label">Nama Lokasi</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="fa fa-location-arrow text-blue"></i></span>
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
                                <div class="form-group">
                                    <label for="type_lokasi" class="form-control-label">Tipe Lokasi</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-map-marker text-blue"></i></span>
                                        </div>
                                        <select id="type_lokasi" name="type_lokasi" class="form-control">
                                            <option value="INDOOR" selected>
                                                {{ 'INDOOR' }}
                                            </option>
                                            <option value="OUTDOOR">
                                                {{ 'OUTDOOR' }}
                                            </option>
                                        </select>
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
                                <div class="form-group">
                                    <label for="alarm_service" class="form-control-label">Alarm Service</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-clock text-blue"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="ALARM" type="text"
                                            name="alarm_service" id="alarm_service">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button id="formSubmit" type="submit" class="btn btn-primary"
                                        onclick="swal ( 'Berhasil','Obat Telah Ditambahkan','success')">Tambah</button>
                                    <button type="button" class="btn btn-danger  ml-auto"
                                        data-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Buat Delete --}}
        @foreach ($ac as $loc)
            <div class="modal fade" id="modalnotification{{ $loc->id_ac }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content bg-gradient-default">
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">Hapus ac ?</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{ route('ac.destroy', [$loc->id_ac]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="text-center">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <button type="submit" title="Hapus" class="btn btn-danger"
                                                class="btn btn-danger"
                                                onclick="swal ( 'Berhasil','ac {{ $loc->nama_ac }} Telah Dihapus','warning')">Ya</button>
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
@endadmin
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
@endsection
