<div class="modal animate-box" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
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
                    <div class="container-fluid">
                        <div class="row ">


                            <div class="col-md-4 animate-box" data-animate-effect="flash">
                                <img style="width: 250px" id="ava">
                            </div>
                            <div class="col-md-8 animate-box" data-animate-effect="fadeIn">
                                <table id="location"></table>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
<div class="modal animate-box" id="modal-form2" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                {{ csrf_field() }} {{ method_field('post') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title">Tambah Slide</h3>
                </div>

                <div class="modal-body" id="content">
                    <div class="container-fluid">
                        <div class="row form-group has-feedback">
                            <div class="col-md-6">
                                <input placeholder="Nama lengkap" data-toggle="tooltip" title="ukuran 1280 x 720 px" id="img" type="file"
                                       class="form-control"
                                       name="img"
                                       required autofocus>
                            </div>

                            <div class="col-md-6">
                                <input placeholder="Judul" id="title" type="text"
                                       class="form-control"
                                       name="title"
                                       required autofocus>
                            </div>
                        </div>
                        <div class="row form-group has-feedback">
                            <div class="col-md-6">
                                <span class="input-group-addon"><em class="domain-em">{{url('').'/'}}</em>
                                    <strike class="domain-strike">{{url('').'/'}}</strike>
                                </span>
                                <input placeholder="URL" id="url" type="text"
                                       class="form-control"
                                       name="url"
                                       required autofocus>
                            </div>
                            <div class="col-md-6">
                                <input placeholder="Isi Tombol" id="button" type="text"
                                       class="form-control"
                                       name="button"
                                       required autofocus>
                                <span data-toggle="tooltip" title="{{url('').'/'}}"><input type="checkbox"  value="1" id="domain" name="domain">
                                    <em>Masuk Domain ini?</em>
                                </span>
                            </div>
                        </div>
                        <div class="row form-group has-feedback">
                            <div class="col-md-12">
                                <textarea placeholder="Detail" id="desc"
                                       class="form-control"
                                       name="desc"
                                          required autofocus></textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save"><em id="berubah">Submit</em>
                        <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw" id="loading1"></i>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal animate-box" id="modal-form3" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                {{ csrf_field() }} {{ method_field('post') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title">Detail Slide</h3>
                </div>

                <div class="modal-body" id="content">
                    <div class="container-fluid">
                        <div class="row form-group has-feedback">
                            <div class="col-md-12">
                                <input type='hidden' id="id" name="id" value="">
                                <div class="avatar-upload">
                                    <div class="avatar-edit" id="editimgca">
                                        <input type='file' id="imageUpload" name="img" accept="image/*" />
                                        <label for="imageUpload" data-toggle="tooltip" title="klik untuk ganti gambar"></label>
                                    </div>
                                    <div class="avatar-preview" >
                                        <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group has-feedback">
                            <div class="col-md-6">
                                <span>Judul :</span>
                                <input placeholder="Judul" id="title" type="text"
                                       class="form-control content1"
                                       name="title"
                                       required autofocus>
                            </div>
                            <div class="col-md-6">
                                <span>Isi Tombol :</span>
                                <input placeholder="Isi Tombol" id="button" type="text"
                                       class="form-control content1"
                                       name="button"
                                       required autofocus>
                            </div>
                        </div>
                        <div class="row form-group has-feedback">
                            <div class="col-md-12">
                                <span>URL :</span>
                                <div class="input-group">
                                <span class="input-group-addon"><em class="domain-em">{{url('').'/'}}</em>
                                    <strike class="domain-strike">{{url('').'/'}}</strike>
                                </span>
                                <input placeholder="URL" id="url" type="text"
                                       class="form-control content1"
                                       name="url"
                                       required autofocus>
                                </div>
                                <span data-toggle="tooltip" title="{{url('').'/'}}" id="domainload"><input type="checkbox"  class="content1" value="1" id="domain" name="domain">
                                    <em>Masuk Domain ini?</em>
                                </span>
                            </div>
                        </div>
                        <div class="row form-group has-feedback">
                            <div class="col-md-12">
                                <span>Detail :</span>
                                <textarea placeholder="Detail" id="desc"
                                          class="form-control content1"
                                          name="desc"
                                          required autofocus></textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save" id="klik1"><em id="berubah">Submit</em>
                        <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw" id="loading1"></i>
                    </button>
                    <button type="button" class="btn btn-info" id="klik2">Edit</button>
                    <button type="button" class="btn btn-danger" id="klik3" data-id="0" onclick="deleteSlide(this)">Hapus</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal animate-box" id="modal-form4" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                {{ csrf_field() }} {{ method_field('post') }}
                <input type='hidden' id="id" name="id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title">Detail Kategori Surat</h3>
                </div>

                <div class="modal-body" id="content">
                    <div class="container-fluid">
                        <div class="row form-group has-feedback">
                            <div class="col-md-6">
                                <span>Nama Kategori Surat :</span>
                                <input placeholder="Nama Kategori Surat" id="name" type="text"
                                       class="form-control" disabled="true"
                                       name="name"
                                       required autofocus>
                            </div>
                            <div class="col-md-6">
                                <span>Singkatan Kategori Surat :</span>
                                <input placeholder="Singkatan Kategori Surat" id="singkatan" type="text"
                                       class="form-control" disabled="true"
                                       name="singkatan"
                                       required autofocus>
                            </div>
                        </div>
                        <div class="row form-group has-feedback">
                            <div class="col-md-6">
                                <span>Dibuat Oleh :</span>
                                <input placeholder="Dibuat Oleh" id="user_id" type="text"
                                       class="form-control"
                                       name="user_id" disabled="true"
                                       required autofocus>
                            </div>
                            <div class="col-md-6">
                                <span>Seksi :</span>
                                <input placeholder="Seksi" id="job_id" type="text"
                                       class="form-control" disabled="true"
                                       name="job_id"
                                       required autofocus>
                            </div>
                        </div>
                        <div class="row form-group has-feedback">
                            <div class="col-md-12">
                                <span>Detail :</span>
                                <textarea placeholder="Detail" id="desc"
                                          class="form-control " disabled="true"
                                          name="desc"
                                          required autofocus></textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal animate-box" id="modal-form5" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                {{ csrf_field() }} {{ method_field('post') }}
                <input type='hidden' id="id" name="id" value="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title">Detail Surat</h3>
                </div>

                <div class="modal-body" id="content">
                    <div class="container-fluid">
                        <div class="row form-group has-feedback">
                            <div class="col-md-6">
                                <span>Kode Surat :</span>
                                <input placeholder="Nama Kategori Surat" id="kode" type="text"
                                       class="form-control" disabled="true"
                                       name="kode"
                                       required autofocus>
                            </div>
                            <div class="col-md-6">
                                <span>Nama Surat :</span>
                                <input placeholder="Singkatan Kategori Surat" id="name" type="text"
                                       class="form-control" disabled="true"
                                       name="name"
                                       required autofocus>
                            </div>
                        </div>
                        <div class="row form-group has-feedback">
                            <div class="col-md-6">
                                <span>Kategori Surat :</span>
                                <input placeholder="Dibuat Oleh" id="category_id" type="text"
                                       class="form-control"
                                       name="category_id" disabled="true"
                                       required autofocus>
                            </div>
                            <div class="col-md-6">
                                <span>Seksi :</span>
                                <input placeholder="Seksi" id="job_id" type="text"
                                       class="form-control" disabled="true"
                                       name="job_id"
                                       required autofocus>
                            </div>
                        </div>
                        <div class="row form-group has-feedback">
                            <div class="col-md-6">
                                <span>Pengirim :</span>
                                <input placeholder="Dibuat Oleh" id="user_id" type="text"
                                       class="form-control"
                                       name="user_id" disabled="true"
                                       required autofocus>
                            </div>
                            <div class="col-md-6">
                                <span>Dibuat :</span>
                                <input placeholder="Seksi" id="created_at" type="text"
                                       class="form-control" disabled="true"
                                       name="created_at"
                                       required autofocus>
                            </div>
                        </div>
                        <div class="row form-group has-feedback">
                            <div class="col-md-12">
                                <span>Detail :</span>
                                <textarea placeholder="Detail" id="desc"
                                          class="form-control " disabled="true"
                                          name="desc"
                                          required autofocus></textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>