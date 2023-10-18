<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                @forelse ($area as $areanya)
                    @foreach ($ac_area[$areanya->id_area] as $loc)
                        @php
                            $total = $loc::where('id_area', '=', $areanya->id_area)->count();
                            $sukses = $loc
                                ::where('id_area', '=', $areanya->id_area)
                                ->where('status', '=', 1)
                                ->count();
                            $gagal = $loc
                                ::where('id_area', '=', $areanya->id_area)
                                ->where('status', '=', 0)
                                ->count();
                            $pending = $loc
                                ::where('id_area', '=', $areanya->id_area)
                                ->where('status', '=', 2)
                                ->count();
                        @endphp
                    @endforeach
                    <div class="col-xl-2 col-lg-3">
                        <div class="card card-stats mb-4 mb-xl-0" style="margin-top: 10px; margin-bottom:10px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-blue mb-0">{{ $areanya->nama_area }}
                                        </h5>
                                        <span
                                            class="h6 font-weight-bold mb-0">{{ 'ID AC : ' . $areanya->id_area }}</span>
                                        <span class="h6 font-weight-bold mb-0">{{ 'Total AC : ' . $total }}</span>
                                    </div>
                                </div>
                                <p class="mt-2 mb-0 text-blue text-sm">

                                    <span class="text-success mr-1"><i
                                            class="fa fa-check"></i>{{ $sukses }}</span>
                                    <span class="text-danger mr-1"><i class="fa fa-times"></i>{{ $gagal }}</span>
                                    <span class="text-warning mr-1"><i
                                            class="fa fa-clock"></i>{{ $pending }}</span>
                                </p>
                                <button class="text-center btn btn-primary btn-sm"
                                    id="area{{ $areanya->id_area }}">Detail</button>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Ambil referensi tombol
                            var datatable{{ $areanya->id_area }} = document.getElementById("datatable{{ $areanya->id_area }}");
                            var tombol{{ $areanya->id_area }} = document.getElementById('area{{ $areanya->id_area }}');
                            // Tambahkan event listener untuk menghandle klik tombol
                            tombol{{ $areanya->id_area }}.addEventListener('click', function() {
                                // Kode JavaScript Anda akan dijalankan ketika tombol ditekan

                                datatable{{ $areanya->id_area }}.focus();
                                console.log(datatable{{ $areanya->id_area }});
                                alert('Tombol telah ditekan dan menuju tabel!');
                                datatable{{ $areanya->id_area }}.scrollIntoView({
                                    behavior: 'smooth',
                                    block: "start",
                                    inline: "nearest"
                                });
                                datatable{{ $areanya->id_area }}.style.backgroundColor = '#EEF8FF';
                                // datatable{{ $areanya->id_area }}.style.color = 'white';

                            });
                            // Atau lakukan tindakan JavaScript lainnya di sini
                        });
                    </script>
                @empty
                @endforelse

            </div>
        </div>
    </div>
</div>
