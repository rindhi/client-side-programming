<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data API</div>
                <div class="float-right pt-1">
                    <button type="button" class="btn btn-success" onclick="bukamodal()">Tambah Data</button>
                    <button type="button" class="btn btn-primary" onclick="ambildatamahasiswa()">Refresh Data</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                <table id="tbl-data" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 15%">NIM</th>
                            <th style="width: 35%">Nama</th>
                            <th style="width: 25%">Email</th>
                            <th style="width: 10%">Kelas</th>
                            <th style="width: 15%">Operasi</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modaltambah">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header btn-light">
                    <h5 class="modal-title">Form Pengisian Data</h5>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="form-group">
                            <label>NIM</label>
                                <input type="numeric" class="form-control" id="txtnim" style="font-size: 20px">
                            <label>Nama</label>
                                <input type="text" class="form-control" id="txtnama" style="font-size: 20px">
                            <label>Email</label>
                                <input type="text" class="form-control" id="txtemail" style="font-size: 20px">
                            <label>Kelas</label>
                            <select class="form-control" id="cbokelas" style="font-size: 20px">
                                <option value="Reguler">Reguler</option>
                                <option value="Ekstensi">Ekstensi</option>
                                <option value="RPL">RPL</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="tambahmahasiswa()">Save</button>
                    <button type="button" class="btn btn-secondary" onclick="kosongmahasiswa()">Reset</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modaledit">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header btn-dark">
                    <h5 class="modal-title">Edit Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-dark">
                        <div class="form-group">
                            <label>NIM</label>
                                <input type="numeric" class="form-control" id="txtnime" style="font-size: 20px">
                            <label>Nama</label>
                                <input type="text" class="form-control" id="txtnamae" style="font-size: 20px">
                            <label>Email</label>
                                <input type="text" class="form-control" id="txtemaile" style="font-size: 20px">
                            <label>Kelas</label>
                            <select class="form-control" id="cbokelase" style="font-size: 20px">
                                <option value="Reguler">Reguler</option>
                                <option value="Ekstensi">Ekstensi</option>
                                <option value="RPL">RPL</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="updatemahasiswa()">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#mndataapi").addClass("active");
    let tblapi = $('#tbl-data').DataTable();

    function bukamodal(){
            $("#modaltambah").modal("show");
        }
</script>
<script>
    function ambildatamahasiswa(){
        let url = "https://rindhidwif04.000webhostapp.com/subdomain/api.php";
        $.getJSON(url, {fungsi: "bacadata"}, function(result){
            if(result !=0){
                tblapi.clear().draw();
                $.each(result, function(i, kolom){
                    let nim = kolom.nim;
                    let nama = kolom.nama;
                    let email = kolom.email;
                    let kelas = kolom.kelas;
                    let tomboledit = "<button type='button' class='btn btn-primary btn-sm' data-nim='"+ nim +"'onclick='kelolamahasiswa(this)'>Edit</button>&nbsp";
                    let tombolhapus ="<button type='button' class='btn btn-danger btn-sm' data-nim='"+ nim +"'onclick='hapusmahasiswa(this)'>Hapus</button>";
                    tblapi.row.add([nim, nama, email, kelas, tomboledit + tombolhapus]).draw();
                })
            }else{
                swal({title: "Info", text: "Data Mahasiswa Kosong", icon: "Info"});
                tblapi.clear().draw();
            }
        })
    }
    ambildatamahasiswa()
        function tambahmahasiswa(){
            let nim = $("#txtnim").val();
            let nama = $("#txtnama").val();
            let email = $("#txtemail").val();
            let kelas = $("#cbokelas").val();
            if(nim == "" || nama == "" || email == "" || kelas == ""){
                swal({title: "Gagal", text: "Ada Isian yang Masih Kosong", icon: "error"});
                return;
            }
            $.ajax({
                url: "https://rindhidwif04.000webhostapp.com/subdomain/api.php",
                method: "POST",
                data: {fungsi: "tambahdata", nim: nim, nama: nama, email: email, kelas: kelas},
                cache: "false",
                success: function(y){
                    var x = atob(y);
                    var xx = x.split("|");
                    if(xx[0] == "1"){
                        swal({title: "Berhasil", text: xx[1], icon: "success"});
                        kosongmahasiswa();
                        ambildatamahasiswa();
                    }else{
                        swal({title: "Gagal", text: xx[1], icon: "error"})
                    }
                },
                error: function(){
                    swal({title: "Gagal", text: "Koneksi API Gagal", icon: "error"})
                }
            })
        }
        function kosongmahasiswa(){
            $("#txtnim").val("");
            $("#txtnama").val("");
            $("#txtemail").val("");
            $("#cbokelas").val("Reguler");
        }
        function kelolamahasiswa(el){
            let nim = $(el).data("nim");
            if(nim == ""){
                swal({title: "Kosong", text: "NIM Tidak Terdeteksi", icon: "error"});
                return;
            }
            let url = "https://rindhidwif04.000webhostapp.com/subdomain/api.php";
            $.getJSON(url, {fungsi: "filterdata", nim: nim}, function(result){
                if(result != 0){
                    $.each(result, function(i, kolom){
                        let nama = kolom.nama;
                        let email = kolom.email;
                        let kelas = kolom.kelas;
                        $("#txtnime").val(nim);
                        $("#txtnamae").val(nama);
                        $("#txtemaile").val(email);
                        $("#cbokelase").val(kelas);
                    })
                    $("#modaledit").modal("show");
                }else{
                    swal({title: "Kosong", text: "Data Tidak Ditemukan", icon: "Info"});
                    ambildatamahasiswa();
                }
            })
        }
        function updatemahasiswa(){
            let nim = $("#txtnime").val();
            let nama = $("#txtnamae").val();
            let email = $("#txtemaile").val();
            let kelas = $("#cbokelase").val();
            if(nim == "" || nama == "" || email == "" || kelas == ""){
                swal({title: "Gagal", text: "Ada Isian yang Masih Kosong", icon: "error"});
                return;
            }
            $.ajax({
                url: "https://rindhidwif04.000webhostapp.com/subdomain/api.php",
                method: "POST",
                data: {fungsi: "updatedata", nim: nim, nama: nama, email: email, kelas: kelas},
                cache: "false",
                success: function(y){
                    var x = atob(y);
                    var xx = x.split("|");
                    if(xx[0] == "1"){
                        swal({title: "Berhasil", text: xx[1], icon: "success"});
                        kosongmahasiswa();
                        ambildatamahasiswa();
                    }else{
                        swal({title: "Gagal", text: xx[1], icon: "error"})
                    }
                },
                error: function(){
                    swal({title: "Gagal", text: "Koneksi API Gagal", icon: "error"})
                }
            })
        }
        function hapusmahasiswa(el){
            let nim = $(el).data("nim");
            if(nim == ""){
                swal({title: "Gagal", text: "NIM Masih Kosong", icon: "error"});
                return;
            }
            swal({
                title: 'Konfirmasi',
                text: "Anda Yakin Ingin Menghapus?",
                icon: 'warning',
                buttons: {
                    confirm: {text: 'Yakin', className: 'btn btn-primary'},
                    cancel: {visible: true, text: 'Tidak', className: 'btn btn-danger'}
                }
            }).then((hapus) => {
                if(hapus){
                    $.ajax({
                    url: "https://rindhidwif04.000webhostapp.com/subdomain/api.php",
                    method: "POST",
                    data: {fungsi: "hapusdata", nim: nim},
                    cache: "false",
                    success: function(y){
                        var x = atob(y);
                        var xx = x.split("|");
                        if(xx[0] == "1"){
                            swal({title: "Berhasil", text: xx[1], icon: "success"});
                            ambildatamahasiswa();
                        }else{
                            swal({title: "Gagal", text: xx[1], icon: "error"});
                        }
                    },
                    error: function(){
                        swal({title: "Gagal", text: "Koneksi API Gagal", icon: "error"});
                    }
                })
            }
        })
    }
</script>