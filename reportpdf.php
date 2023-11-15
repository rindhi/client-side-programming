<?php
     require_once __DIR__ .'/assets/vendor/autoload.php';   
     $mpdf = new \Mpdf\Mpdf(['mode' =>'utf-8', 'format'=>'A4-P']); 
     $mpdf->SetWatermarkText('Client Side Programming');
     $mpdf->showWatermarkText = true;
     ob_start();
     if(!isset($_REQUEST["parameter"])){
          echo "<h1 style='text-align: center;'>Parameter Salah, Sehingga Konten Tidak Tersedia</h1>";
     }else{
          $parameter = base64_decode($_REQUEST["parameter"]);
          $arr= explode("-", $parameter);
          $th = $arr[0];
          $bln = $arr[1];
          $dataku = file_get_contents("https://rindhidwif04.000webhostapp.com/coba-api/api2.php?data=penjualan&tahun=".$th."&bulan=".$bln);
          $hasil = json_decode($dataku, TRUE);    
          echo '<h2 style="text-align: center;">Data Penjualan Tahun '.$th.' Bulan'.$bln.'</h2> 
          <table style="border: 2px solid black; border-collapse: collapse;">
               <tr style="background-color: #336E78;">
                    <th style="padding: 5px; width: 15%; border: 2px solid black; border-collapse: collapse; color: white;"> ID Order </th> 
                    <th style="padding: 5px; width: 20%; border: 2px solid black; border-collapse: collapse; color: white;"> Tgl Orders </th>
                    <th style="padding: 5px; width: 15%; border: 2px solid black; border-collapse: collapse; color: white;"> Status </th> 
                    <th style="padding: 5px; width: 45%; border: 2px solid black; border-collapse: collapse; color: white;"> Comment </th>
               </tr>';
          foreach($hasil as $c){
          $idorder = $c["orderNumber"];
          $tgl = $c["orderDate"];
          $status = $c["status"];
          $komen= $c["comments"];  
          echo "<tr>
               <td style='padding: 5px; border: 2px solid black; border-collapse: collapse;'>$idorder</td>
               <td style='padding: 5px; border: 2px solid black; border-collapse: collapse;'>$tgl</td>
               <td style='padding: 5px; border: 2px solid black; border-collapse: collapse;'>$status</td>
               <td style='padding: 5px; border: 2px solid black; border-collapse: collapse;'>$komen</td>
          </tr>";
     }
     echo '</table>';
    }
     $isi = ob_get_contents();
     ob_end_clean();
     $mpdf->WriteHTML($isi);
     $mpdf->Output("report.pdf", "I");
     exit;
?>