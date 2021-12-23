<?php 
  require("../atas.php"); 
  require("../menu.php");
?>
<h3>Daftar Nama User</h3>
  <table class="table table-striped table-secondary table-sm">
   <thead>
    <tr>
     <th>NO</th>
     <th>NAMA USER</th>
     <th>EMAIL USER</th>
    </tr>
   </thead>
   <tbody>
   <?php
   $nomor   = 1;
   $query   = "SELECT * FROM tbl_user ORDER BY id";
   $sambung = mysqli_query($theLINK, $query);
   while ($row = mysqli_fetch_array($sambung))
   {
    ?>
    <tr>
      <td><?= $nomor; ?></td>
      <td><?= $row["name"]; ?></td>
      <td><?= $row["email"]; ?></td>
    </tr>
    <?php
    $nomor = $nomor + 1;
    }
   ?>
   </tbody>
  </table>
<?php require("../bawah.php"); ?>