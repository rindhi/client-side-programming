<div class="row mt-5">
    <div class="col-md-6 ml-auto mr-auto">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Percobaan Event</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Isi Nama</label>
                            <input type="text" class="form-control" onkeyup="hitungkarakter()" id="txtnama" style="font-size: 20px;">
                            <small class="form-text text-muted">Isi Sesuai Dengan Format yang Muncul</small>
                        </div>
                        <div class="form-group">
                            <p id="blokhasil" style="font-size: 20px;">Jumlah Karakter: 0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $("#mnform2").addClass("active");

    function hitungkarakter() {
        let nilai = $("#txtnama").val();
        let jumlah = nilai.length;
        $("#blokhasil").html("Jumlah Karakter: " + jumlah);
    }
  
</script>