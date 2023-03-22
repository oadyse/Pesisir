<div id="add_sampeluji{{ $id }}" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
    aria-labelledby="createTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTitle">Input Sampel Hasil Uji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('add-hasil', base64_encode($id)) }}" class="needs-validation"
                    enctype='multipart/form-data' novalidate>
                    @csrf
                    @foreach ($sampelUji as $data)
                        <input type="hidden" name="id[]" value="{{ $data->id }}">
                        <div class="form-row my-3">
                            <div class="col-6 m-auto">
                                <label for="validationTooltip05">{{ $data->param->parameter }}</label>
                            </div>
                            <div class="col-6">
                                <input type="number" step="0.01" min="0" class="form-control"
                                    id="validationTooltip05" name="hasil[]" value="{{ $data->hasil }}" required>
                            </div>
                        </div>
                    @endforeach
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary">Add Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
