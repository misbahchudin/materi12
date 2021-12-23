<?php 
  require("../atas.php"); 
  require("../menu.php");

  $thePROGRAM = "dataPASIEN";
?>
 <h3>Daftar Nama Pasien</h3>
 <a href="tambah.php" class="btn btn-primary btn-sm mb-3">Add Data</a>
  <table class="table table-striped table-secondary table-sm">
   <thead>
    <tr>
     <th scope="col">NO</th>
     <th scope="col">NOMOR REKAM MEDIS</th>
     <th scope="col">NAMA PASIEN</th>
     <th scope="col">SEX</th>
     <th scope="col">TANGGAL LAHIR</th>
     <th scope="col">PHOTO PASIEN</th>
     <th scope="col" class="text-center">aksi</th>
    </tr>
   </thead>
   <tbody>
    <!-- List Data Menggunakan DataTable -->              
   </tbody>
  </table>
<?php require("../bawah.php"); ?>