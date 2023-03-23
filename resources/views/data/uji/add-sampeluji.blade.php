<div id="add_sampeluji{{ $id }}" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
    aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTitle">Input Sampel Hasil Uji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add-hasil', base64_encode($id)) }}" class="needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="id_uji" value="{{ $id }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>BIOTA LAUT</h6>
                            <hr>
                            @foreach ($sampelUji as $data)
                                @if ($data->param->jenis == 'biota')
                                    <input type="hidden" name="id[]" value="{{ $data->id }}">
                                    <div class="form-row my-3">
                                        <div class="col-5 m-auto">
                                            <label for="validationTooltip05">{{ $data->param->parameter }}</label>
                                        </div>
                                        <input type="hidden" name="id_parameter[]" value="{{ $data->id_parameter }}">
                                        <div class="col-4">
                                            <input type="number" step="0.01" min="0" class="form-control"
                                                id="validationTooltip05" name="hasil[]" value="{{ $data->hasil }}"
                                                required>
                                        </div>
                                        <div class="col-3 m-auto">
                                            <label for="">{{ $data->get_data->satuan }}</label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-sm-6">
                            <h6>WISATA BAHARI</h6>
                            <hr>
                            @foreach ($sampelUji as $data)
                                @if ($data->param->jenis == 'wisata')
                                    <input type="hidden" name="id[]" value="{{ $data->id }}">
                                    <div class="form-row my-3">
                                        <div class="col-5 m-auto">
                                            <label for="validationTooltip05">{{ $data->param->parameter }}</label>
                                        </div>
                                        <input type="hidden" name="id_parameter[]" value="{{ $data->id_parameter }}">
                                        <div class="col-4">
                                            <input type="number" step="0.01" min="0" class="form-control"
                                                id="validationTooltip05" name="hasil[]" value="{{ $data->hasil }}"
                                                required>
                                        </div>
                                        <div class="col-3 m-auto">
                                            <label for="">{{ $data->get_data->satuan }}</label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

            </div>
            <div class="modal-footer justify-content-end">
                <button type="submit" class="btn btn-primary">Add Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
