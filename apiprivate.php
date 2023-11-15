<table id="tbl-data2" class="display table table-striped table-hover">
    <thead>
        <tr>
            <th style="width: 15 %;">ID Karyawan</th>
            <th style="width: 25%;">Nama Depan</th>
            <th style="width: 25%; ">Nama Belakang</th>
            <th style="width: 35 %;">Email</th>
        </tr>
    </thead>
</table>

<script>
    $("#mnapiprivate").addClass("active");
    let tblapiprivate = $('#tbl-data2').DataTable();

    tampildata();
    function tampildata(){
        $.ajax({
            url: "https://rindhidwif04.000webhostapp.com/coba-api/api3.php",
            method: "POST",
            cache: "false",
            success: function(y){
                var x = atob(y);
                var dtbesar = x.split("##");
                if(dtbesar.length != 0){
                    tblapiprivate.clear().draw();
                    for(z in dtbesar){
                        let dtkecil = dtbesar[z];
                        let dt = dtkecil.split("|");
                        let idkaryawan = dt[0];
                        let namadepan = dt[1];
                        let namabelakang = dt[2];
                        let email = dt[3]; 
                        tblapiprivate.row.add([idkaryawan, namadepan, namabelakang, email]).draw();
                    } 
                }else{
                    tblapiprivate.clear().draw(); 
                    swal({title: "Info", text: "Data Kosong", icon: "info"});
                }
            },
            error: function(){
                swal({title: "Gagal", text: "API Tidak Terhubung", icon: "error"});
            }
        })
    }
</script>