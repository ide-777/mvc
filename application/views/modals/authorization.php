

<div class="modal fade in show" tabindex="-1" role="dialog" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" name="auth">
                    <input type="hidden" name="act" value="auth">
                    <div class="form-group row">
                        <label for="select" class="col-2 col-form-label">Email</label>
                        <div class="col-10">
                            <select class="selectpicker form-control" multiple>
                                <option>Mustard</option>
                                <option>Ketchup</option>
                                <option>Relish</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="login" class="col-2 col-form-label">Login</label>
                        <div class="col-10">
                            <input type="text" name="login" class="form-control" id = 'login'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-2 col-form-label">Password</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-10">
                            <button>Go!</button>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>