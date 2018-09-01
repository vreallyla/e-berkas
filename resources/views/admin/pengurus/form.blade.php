<div class="modal animate-box" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                {{ csrf_field() }} {{ method_field('post') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title">Data Pegawai</h3>
                </div>

                <div class="modal-body" id="content">
                    <div class="container-fluid">
                        <div class="row ">


                            <div class="col-md-4 animate-box" data-animate-effect="flash">
                                <br>
                                <img style="width: 250px" id="ava">
                                <br><br>
                                <center><h3 id="notif1" style="color:darkred"></h3></center>
                            </div>
                            <div class="col-md-8 animate-box" data-animate-effect="fadeIn">
                                <div class="row form-group has-feedback">
                                    <div class="col-md-6">
                                        <span>NIP :</span>
                                        <input placeholder="NIP" id="nip" type="text"
                                               class="form-control contentshow"
                                               name="nip"
                                               required autofocus>
                                        <input id="id" name="id" type="hidden">
                                    </div>
                                    <div class="col-md-6">
                                        <span>Nama :</span>
                                        <input placeholder="Singkatan Kategori Surat" id="name" type="text"
                                               class="form-control contentshow"
                                               name="name"
                                               required autofocus>
                                    </div>
                                </div>
                                <div class="row form-group has-feedback">
                                    <div class="col-md-6">
                                        <span>Seksi :</span>
                                        <select placeholder="Seksi" id="job_id" type="text"
                                                class="form-control contentshow"
                                                name="job_id"
                                                required autofocus>
                                        </select>

                                    </div>
                                    <div class="col-md-6">
                                        <span>Jobdesk :</span>
                                        <select placeholder="Jobdesk" id="posisition_id" type="text"
                                                class="form-control contentshow"
                                                name="posisition_id"
                                                required autofocus>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group has-feedback">
                                    <div class="col-md-6">
                                        <span>Hak Akses :</span>
                                        <select placeholder="Jobdesk" id="role_id" type="text"
                                                class="form-control contentshow"
                                                name="role_id"
                                                required autofocus>
                                        </select>
                                        <span>Email :</span>
                                        <input placeholder="Email" id="email" type="text"
                                               class="form-control contentshow"
                                               name="email"
                                               required autofocus>
                                        <span>Telp :</span>
                                        <input placeholder="Telp" id="phone" type="text"
                                               class="form-control contentshow"
                                               name="phone"
                                               required autofocus>

                                    </div>
                                    <div class="col-md-6">
                                        <span>Alamat :</span>
                                        <textarea placeholder="Alamat" id="alamat"
                                                  class="form-control contentshow "
                                                  name="alamat" style="height: 143px"
                                                  required autofocus></textarea>
                                    </div>
                                </div>
                                <div class="row form-group has-feedback">
                                    <div class="col-md-12">
                                        <span>Deskripsi :</span>
                                        <textarea placeholder="Bio" id="bio"
                                                  class="form-control contentshow "
                                                  name="bio" style="height: 91px"
                                                  required autofocus></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save editform"><em id="berubah1">Submit</em>
                        <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw" id="loading3"></i>
                    </button>
                    <button type="button" class="btn btn-primary lihatsurat lihatform" data-action="edit"
                            data-status="1" data-id="1"
                            onclick="lihatuser(this)">Rubah
                    </button>
                    <button type="button" class="btn btn-danger hapususer lihatform" data-dismiss="modal"
                            onclick="hapususer(this)">Bekukan
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
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
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="noarray" name="noarray">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>

                <div class="modal-body" id="content">
                    <div class="container-fluid">
                        <div class="row container-fluid">
                            <div class="row form-group has-feedback">
                                <div class="col-md-6">
                                    <span>Nama Kategori Surat :</span>
                                    <input placeholder="Nama Kategori Surat" id="name" type="text"
                                           class="form-control contentshow"
                                           name="name"
                                           required autofocus>
                                </div>
                                <div class="col-md-6">
                                    <span>Singkatan Kategori Surat :</span>
                                    <input placeholder="Singkatan Kategori Surat" id="singkatan" type="text"
                                           class="form-control contentshow"
                                           name="singkatan"
                                           required autofocus>
                                </div>
                            </div>
                            <div class="row form-group has-feedback">
                                <div class="col-md-6">
                                    <span>Seksi :</span>
                                    <select placeholder="Seksi" id="job_id" type="text"
                                            class="form-control contentshow"
                                            name="job_id"
                                            required autofocus>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <span>Dibuat Oleh :</span>
                                    <input placeholder="Dibuat Oleh" id="user_id" type="text"
                                           class="form-control contentshow1"
                                           name="user_id"
                                    >
                                </div>

                            </div>
                            <div class="row form-group has-feedback">
                                <div class="col-md-12">
                                    <span>Detail :</span>
                                    <textarea placeholder="Detail" id="desc"
                                              class="form-control contentshow "
                                              name="desc"
                                              required autofocus></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save editform"><em id="berubah">Submit</em>
                        <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw" id="loading1"></i>
                    </button>
                    <button type="button" class="btn btn-primary lihatsurat lihatform" data-action="edit"
                            data-status="0" data-id="1"
                            onclick="lihatsurat(this)">Rubah
                    </button>
                    <button type="button" class="btn btn-danger hapussurat lihatform" data-dismiss="modal"
                            onclick="hapussurat(this)">Hapus
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                </div>

            </form>
        </div>
    </div>
</div>
<div class="modal animate-box" id="modal-form3" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
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
                    <div class="container-fluid" id="fill">
                        <div class="row container-fluid loopmulti">
                            <div class="row form-group has-feedback">
                                <div class="col-md-3">
                                    <input type="hidden" class="id" id="id[]" name="id[]">
                                    <span>Nama Kategori Surat :</span>
                                    <input placeholder="Nama Kategori Surat" id="name" type="text"
                                           class="form-control name"
                                           name="name[]"
                                           required autofocus>
                                </div>
                                <div class="col-md-3">
                                    <span>Singkatan :</span>
                                    <input placeholder="Singkatan Kategori Surat" id="singkatan[]" type="text"
                                           class="form-control singkatan"
                                           name="singkatan[]"
                                           required autofocus>
                                </div>
                                <div class="col-md-3">
                                    <span>Seksi :</span>
                                    <select placeholder="Seksi" id="job_id[]" type="text"
                                            class="form-control job_id"
                                            name="job_id[]"
                                            required autofocus>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <span>Detail :</span>
                                    <textarea placeholder="Detail" id="desc[]"
                                              class="form-control desc"
                                              name="desc[]" style="height: 33px"
                                              required autofocus></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save editform"><em id="berubah2">Submit</em>
                        <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw" id="loading2"></i>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal animate-box" id="modal-form4" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
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
                    <div class="container-fluid" id="fill">
                        <div class="row container-fluid loopmulti">
                            <div class="row form-group has-feedback">
                                <div class="col-md-3">
                                    <input type="hidden" class="id" id="id[]" name="id[]">
                                    <span>Nama :</span>
                                    <input placeholder="Nama" id="name" type="text"
                                           class="form-control name"
                                           name="name[]"
                                           required autofocus>
                                </div>
                                <div class="col-md-3">
                                    <span>Seksi :</span>
                                    <select placeholder="Seksi" id="job_id" type="text"
                                            class="form-control contentshow job_id"
                                            name="job_id[]"
                                            required autofocus>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <span>Jobdesk :</span>
                                    <select placeholder="Jobdesk" id="posisition_id" type="text"
                                            class="form-control contentshow posisition_id"
                                            name="posisition_id[]"
                                            required autofocus>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <span>Hak Akses :</span>
                                    <select placeholder="Hak Akses" id="role_id" type="text"
                                            class="form-control contentshow role_id"
                                            name="role_id[]"
                                            required autofocus>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save editform"><em id="berubah3">Submit</em>
                        <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw" id="loading4"></i>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>
