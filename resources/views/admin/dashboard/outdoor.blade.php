@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row" style="margin-bottom: 4em;overflow-x: auto;white-space: nowrap;">
            @forelse ($area as $areanya)
                <div class="horizontal-scroll col-xl-6" style="margin-bottom: 4em;overflow-x: auto;white-space: nowrap;">
                    <div class="horizontal-scroll card shadow"
                        style="margin-bottom: 4em;overflow-x: auto;white-space: nowrap;">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <h1 class="text-uppercase text-blue">{{ $areanya->nama_area }}</h1>
                            </div>
                        </div>
                        <div class="card-body" id="area{{ $areanya->id_area }}">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable{{ $areanya->id_area }}">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-uppercase text-blue">No</th>
                                            <th class="text-uppercase text-blue">ID AC</th>
                                            <th class="text-uppercase text-blue">Nama Lokasi</th>
                                            <th class="text-uppercase text-blue">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ac_area[$areanya->id_area] as $loc)
                                            <tr>
                                                <td>
                                                    <span class="name mb-0 text-sm">{{ $loop->iteration }}</span>
                                                </td>
                                                <td>
                                                    {{ $loc->id_ac }}
                                                </td>
                                                <td>
                                                    {{ $loc->lokasi->nama_lokasi }}
                                                </td>
                                                <td>
                                                    @if ($loc->status == 1)
                                                        <span class="badge badge-success">
                                                            <i class="fa fa-circle text-green" aria-hidden="true"></i>
                                                            {{ ' DONE' }}
                                                        </span>
                                                    @elseif($loc->status == 2)
                                                        <span class="badge badge-warning">
                                                            <i class="fa fa-circle text-yellow" aria-hidden="true"></i>
                                                            {{ ' WARNING' }}
                                                        </span>
                                                    @elseif($loc->status == 0)
                                                        <span class="badge badge-danger">
                                                            <i class="fa fa-circle text-red"aria-hidden="true"></i>
                                                            {{ ' DANGER' }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-default">STAND BY</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        var table = $('#datatable{{ $areanya->id_area }}').DataTable({
                            buttons: ['print', 'excel', 'csv'],
                            dom: "<'row'<'col-sm-5'l><'col-sm-4'f>>" +
                                "<'col-sm-12'B>" +
                                "<'row'<'col-sm-10'tr>>" +
                                "<'row'<'col-sm-5'i><'col-sm-5'p>>",
                            lengthMenu: [
                                [25, 50, 100, -1],
                                [25, 50, 100, "All"]
                            ]
                        });
                        table.buttons().container()
                            .appendTo('#table_wrapper .col-md-3:eq(0)');
                    });
                </script>
            @empty
                {{ 'AREA BELUM DI INPUT' }}
            @endforelse


        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
