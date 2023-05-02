@include('layout.header')
<!-- Wrapper Start -->
<div class="wrapper">
    @include('layout.sidebar')
    @include('layout.topnav')

    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center pb-0">
                            <div class="header-title">
                                <h4 class="card-title">Hasil Laporan</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="card-body">
                            {{-- <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab-fill" data-toggle="pill"
                                        href="#pills-home-fill" role="tab" aria-controls="pills-home"
                                        aria-selected="true">Biota Laut</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab-fill" data-toggle="pill"
                                        href="#pills-profile-fill" role="tab" aria-controls="pills-profile"
                                        aria-selected="false">Wisata Bahari</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent-1">
                                <div class="tab-pane fade show active" id="pills-home-fill" role="tabpanel"
                                    aria-labelledby="pills-home-tab-fill">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.</p>
                                </div>
                                <div class="tab-pane fade" id="pills-profile-fill" role="tabpanel"
                                    aria-labelledby="pills-profile-tab-fill">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.</p>
                                </div>
                                <div class="tab-pane fade" id="pills-contact-fill" role="tabpanel"
                                    aria-labelledby="pills-contact-tab-fill">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.</p>
                                </div>
                            </div> --}}

                            <h5 class="mb-3">Golongan Parameter : Biota Laut</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="text-center table-active">
                                            <th>Parameter</th>
                                            <th>Baku Mutu</th>
                                            <th>Nilai Ambang Batas (SVi)</th>
                                            <th>Normalized</th>
                                            <th>Vi = 1/SVi</th>
                                            <th>k = 1/∑Vi</th>
                                            <th>Wi = k/SVi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalVi = 0;
                                        @endphp
                                        @foreach ($data as $laporan)
                                            @if ($laporan->param->jenis == 'biota')
                                                @php
                                                    $Vi = round(1 / $laporan->get_data->nilai, 5);
                                                    $totalVi += $Vi;
                                                @endphp
                                            @endif
                                        @endforeach

                                        @foreach ($data as $laporan)
                                            @if ($laporan->param->jenis == 'biota')
                                                @php
                                                    $SVi = $laporan->get_data->nilai;
                                                    $Vi = round(1 / $SVi, 4);
                                                    $k = 1 / $totalVi;
                                                @endphp
                                                <tr class="text-center">
                                                    {{ $totalVi }}
                                                    <td>{{ $laporan->param->parameter }}</td>
                                                    <td>{{ $laporan->get_data->baku_mutu }}</td>
                                                    <td>
                                                        {{ number_format($SVi, 2, ',', ' ') }}
                                                    </td>
                                                    <td>1</td>
                                                    <td>
                                                        {{ number_format($Vi, 5, ',', ' ') }}
                                                    </td>
                                                    <td>{{ number_format($k, 5, ',', ' ') }}</td>
                                                    <td>{{ number_format($k / $SVi, 5, ',', ' ') }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <h5 class="mb-3">Nilai CWQI</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="text-center table-active">
                                            <th>Parameter</th>
                                            <th>Wi</th>
                                            <th>Wi*Qi-1</th>
                                            {{-- <th>Wi*Qi-2</th>
                                            <th>Wi*Qi-3</th>
                                            <th>Wi*Qi-4</th>
                                            <th>Wi*Qi-5</th>
                                            <th>Wi*Qi-6</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @php
                                            $WQIA = 0;
                                            $WQIAU = 0;
                                        @endphp
                                        @foreach ($data as $laporan)
                                            @if ($laporan->param->jenis == 'biota')
                                                @php
                                                    $SVi = $laporan->get_data->nilai;
                                                    $Vi = round(1 / $SVi, 2);
                                                    $k = 1 / $totalVi;
                                                    $Wi = $k / $SVi;
                                                    
                                                    // Nilai Y didapat dari perkalian sampel dengan kurva tiap parameter
                                                    if ($laporan->param->id == 11) {
                                                        // 11 = BOD5
                                                        $nilaiY = 1.01040745922865 * exp(-0.116995811136413 * $laporan->hasil);
                                                    } elseif ($laporan->param->id == 12) {
                                                        // 12 = Amonia total
                                                        $nilaiY = 1.010498667279 * exp(-0.0077965531620728 * $laporan->hasil);
                                                    } elseif ($laporan->param->id == 13) {
                                                        // 13 = Ortofosfat
                                                        $nilaiY = 0.981085972533536 * exp(-0.153725962938623 * $laporan->hasil);
                                                    } elseif ($laporan->param->id == 14) {
                                                        // 14 = Nitrat
                                                        $nilaiY = 1.01050605076391 * exp(-0.292728289588808 * $laporan->hasil);
                                                    }
                                                    
                                                    // Nilai y * 100 * nilai Wi (diklai 100 untung menghilangkan 0 di depan angka)
                                                    $hasil = $nilaiY * 100 * $Wi;
                                                    $x = $nilaiY * 100;
                                                    
                                                    // Total Nilai akhir
                                                    $WQIA += $hasil;
                                                    
                                                    // Total Nilai perkalian nilaiY *100
                                                    $WQIAU += $x;
                                                @endphp
                                                <tr>
                                                    <td>{{ $laporan->param->id }}</td>
                                                    <td>{{ number_format($Wi, 5, ',', ' ') }}</td>
                                                    <td>{{ number_format($hasil, 5, ',', ' ') }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td class="table-warning">WQIA</td>
                                            <td class="table-secondary">Jumlah</td>
                                            <td class="table-secondary"><b>{{ number_format($WQIA, 2, ',', ' ') }}</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="table-warning">WQIAU</td>
                                            <td class="table-secondary">Jumlah</td>
                                            <td class="table-secondary">
                                                <b>{{ number_format($WQIAU / 4, 5, ',', ' ') }}</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row my-3">
                                <div class="col-2">Min = </div>
                                <div class="col-2">Mean = </div>
                                <div class="col-2">Max = </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-12">
                                    <b>Kesimpulan:</b>
                                    <p>
                                        Nilai CWQI berkisar diantara ...., sehingga dapat dikatakan kualitas air pesisir
                                        untuk biota laut berada pada tingkat yang .... pada tahun
                                        {{ $laporan->get_year->tahun }}.
                                    </p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Wrapper End-->
@include('layout.footer')

<!-- Backend Bundle JavaScript -->
@include('layout.script')

<!-- Add alert -->
@if (session('successAdd'))
    <script>
        swal({
            icon: 'success',
            title: "Add Success!",
            text: "{{ session('successAdd') }}",
            button: false,
            timer: 3500
        })
    </script>
@elseif (session('successUpdate'))
    <script>
        swal({
            icon: "success",
            title: "Update Success!",
            text: "{{ session('successUpdate') }}",
            button: false,
            timer: 3500
        })
    </script>
@elseif (session('delete'))
    <script>
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover it!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("{{ session('delete') }}", {
                        icon: "success",
                        button: false,
                        timer: 3500
                    });
                } else {
                    swal("Your data is safe!");
                }
            });
    </script>
@endif
<!-- /Alert -->

</body>

</html>
