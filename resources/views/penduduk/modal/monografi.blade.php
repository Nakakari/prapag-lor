<div class="modal fade" id="monografi-modal" tabindex="-1" role="dialog" aria-labelledby="monografi-modalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-bottom-primary">
            <form action="{{ route('penduduk.data-monografi') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="monografi-modalLabel">Monografi Penduduk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <label for="filter-kondisi">PILIH KONDISI</label>
                            <select class="form-control" name="filter_kondisi" id="filter-kondisi" required>
                                <option value=""> --- Pilih Kondisi --- </option>
                                @foreach ($penduduk as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-10">
                            <label for="filter-rw">RW</label>
                            <select class="form-control" id="filter-rw" name="rw">
                                <option value=""> -- Pilih RW -- </option>
                                @foreach (App\Models\DataRw::with('rts')->get() as $row)
                                    <option value="{{ $row->name }}" data-rt="{{ $row->rts }}">
                                        00{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-10">
                            <label for="filter-rt">RT</label>
                            <select class="form-control" id="filter-rt" name="rt">
                                <option value=""> -- Pilih RT -- </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-eye preview"></i> Preview</button>
                </div>
            </form>
        </div>
    </div>
</div>
