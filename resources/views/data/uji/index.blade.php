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
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Data Hasil Uji</h4>
                            </div>
                            <button type="button" class="btn btn-primary rounded-pill" data-toggle="modal"
                                data-target="#create">
                                Add New
                            </button>

                            {{-- Modal Create --}}
                            @include('data.uji.create')

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable-1" class="table data-table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="2%">No</th>
                                            <th>Nama Pulau</th>
                                            <th>Tahun</th>
                                            <th>Lokasi</th>
                                            <th width="20%">Data Uji</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;

                                        foreach ($data as $uji) {
                                            $id = $uji->id;
                                        ?>
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $uji->pulau->nama }}</td>
                                            <td>{{ $uji->tahun }}</td>
                                            <td>{{ $uji->pulau->alamat }}</td>
                                            <td>
                                                <?php $i = 0; ?>
                                                <a href="" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#pilih_parameter{{ $id }}">Pilih
                                                    Parameter
                                                </a>
                                                @foreach ($uji->sample as $sample)
                                                    {{-- @if (empty($sample->id_uji)) --}}
                                                    @if ($sample->id_uji == $id && $i == 0)
                                                        <a href="" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#edit_parameter{{ $id }}">Edit
                                                            Parameter
                                                        </a>
                                                    @endif
                                                    <?php $i++; ?>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a class="iq-icons-list m-0 text-left" href="" title="Edit"
                                                    data-toggle="modal" data-target="#edit{{ $id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="m-0">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>
                                                </a>

                                                {{-- Modal Parameter --}}
                                                @include('data.uji.add-parameter')
                                                @include('data.uji.edit-parameter')
                                            </td>
                                        </tr>
                                        <?php
                                        $no += 1;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
