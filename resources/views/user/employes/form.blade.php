<div class="modal animate-box" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" class="form-horizontal">
                {{ csrf_field() }} {{ method_field('post') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title" ></h3>
                </div>

                <div class="modal-body" id="content">
                    <div class="container-fluid">

                        <div class="row ">
                            <div class="col-md-4 animate-box has-feedback" data-animate-effect="flash">
                                <img style="width: 250px"  id="ava">
                            </div>
                            <div class="col-md-8 animate-box has-feedback" data-animate-effect="fadeIn">
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