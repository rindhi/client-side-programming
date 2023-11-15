<?php
    include "assets/SimpleXLSXGen.php";
    if(!isset($_REQUEST["parameter"])){
        $nilai = [
            ['Parameter Salah, Sehingga Konten Tidak Tersedia']
        ];
    }else{
        $parameter = base64_decode($_REQUEST["parameter"]);
        $arr = explode("-", $parameter);
        $th = $arr[0];
        $bln = $arr[1];
        $dataku = file_get_contents("https://rindhidwif04.000webhostapp.com/coba-api/api2.php?data=penjualan&tahun=".$th."&bulan=".$bln);
        $hasil = json_decode($dataku, TRUE);
        $nilai = [
            ['ID Order', 'Tgl Order', 'Status', 'Comment']
        ];
        foreach($hasil as $c){
            $idorder = $c["orderNumber"];
            $tgl = $c["orderDate"];
            $status = $c["status"];
            $komen = $c["comments"];
            array_push($nilai, [$idorder, $tgl, $status, $komen]);
        }
    }
    $z = SimpleXLSXGen::fromArray($nilai);
    $z->downloadAs('report.xlsx');
    exit;
?>