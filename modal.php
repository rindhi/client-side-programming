<div class="row mt-5">
    <div class="col-md-11 mr-auto ml-auto">
        <button class="btn btn-danger" onclick="bukamodal()">
            <span class="btn-label">
                <i class="fa fa-home"></i>
            </span>Coba Layout Modal
        </button>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalku">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header btn-danger">
                    <h5 class="modal-title">Tes Modal</h5>
                </div>
                <div class="modal-body">
                    <p>Modal body</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#mnmodal").addClass("active");

    function bukamodal() {

        $("#modalku").modal("show");
    }
</script>