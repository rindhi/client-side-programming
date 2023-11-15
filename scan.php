<div class="row mt-5">
    <div class="col-md-6 ml-auto mr-auto">
        <div class="card">
            <div class="card-header">
                <div class="card-title">QRCode Scanner</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Hasil Scan</label>
                            <textarea class="form-control" id="txthasil" style="font-size: 20px;" readonly></textarea>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="btnscan">Scan</button>
                            <button type="button" class="btn btn-danger" onclick="$('#txthasil').val('')">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $("#mnscan").addClass("active");
    $.qrCodeReader.jsQRpath = "assets/libqr/jsQR.js";
    $.qrCodeReader.beepPath = "assets/libqr/beep.mp3";
    $("#btnscan").qrCodeReader({
        target: "#txthasil",
        audioFeedback: true,
        callback: function(codes) {
        }
    });
</script>