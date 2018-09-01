<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                {{ csrf_field() }} {{ method_field('post') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>

                <div class="modal-body" id="content">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="category" class="col-md-3 control-label">Nama Recorder</label>
                        <div class="col-md-6">
                            <input type="text" id="nama_recorder" name="nama_recorder" class="form-control content" autofocus >
                            <p class="nama_recorder content2"></p>
                            <span class="help-block with-errors content"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category" class="col-md-3 control-label">Deskripsi</label>
                        <div class="col-md-6">
                            <input type="text" id="deskripsi" name="deskripsi" class="form-control content" autofocus required>
                            <p class="deskripsi content2"></p>
                            <span class="help-block with-errors content"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category" class="col-md-3 control-label">Harga Recorder</label>
                        <div class="col-md-6">
                            <input type="text" id="harga_recorder" name="harga_recorder" class="form-control content" autofocus required>
                            <p class="harga_recorder content2"></p>
                            <span class="help-block with-errors content"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category" class="col-md-3 control-label">Batas Hari</label>
                        <div class="col-md-6">
                            <input type="number" id="batas_hari" name="batas_hari" class="form-control content" autofocus required>
                            <p class="batas_hari content2"></p>
                            <span class="help-block with-errors content"></span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save content">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>