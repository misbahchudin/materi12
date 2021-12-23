<?php 
 require("../atas.php");
 require("../menu.php");

 //Nilai Awal
 $no_rm   = '';
 $nm_psn  = '';
 $sex     = '';
 $tgl_lhr = '';
 $photo   = '';

 if (isset($_POST["cmdSIMPAN"]))
 {
  $no_rm   = $_POST["no_rm"];
  $nm_psn  = $_POST["nm_psn"];
  $sex     = $_POST["sex"];
  $tgl_lhr = $_POST["tgl_lhr"];  // $photo = $_POST["photo"];  tidak bisa

  $tipefile   = array('png','jpg','jpeg','gif');
  $namafile   = $_FILES['photo']['name'];
  $ukuranfile = $_FILES['photo']['size'];
  $EXT        = pathinfo($namafile, PATHINFO_EXTENSION);

  if (!in_array($EXT, $tipefile))
  {
  ?>
   <script>
   alert("tipe file PHOTO PASIEN salah, harus .png | .jpg | .jpeg | .gif");
   </script>
  <?php
  }
  elseif ($ukuranfile > 1048576 || $ukuranfile == 0) // directory xampp->php->php.ini
  {                                                 // "upload_max_filesize" DEFAULT 2M
   ?>
   <script>
   alert("ukuran file PHOTO PASIEN salah, maksimal 1Mb");
   </script>
   <?php
  }    
  else
  {
   $photo   = rand() . '_' . date("YmdHis") . '.' . $EXT;
   $query   = "INSERT INTO tbl_pasien (no_rm, nm_psn, sex, tgl_lhr, photo) VALUES 
               ('$no_rm', '$nm_psn', '$sex', '$tgl_lhr', '$photo')";
   $sambung = mysqli_query($theLINK, $query);

   if (mysqli_errno($theLINK) > 0 && mysqli_errno($theLINK) == 1062)
   {
    ?>
    <script>
      alert("terjadi duplikasi NOMOR REKAM MEDIS, ganti NOMOR REKAM MEDIS dengan yang lain");
   </script>
   <?php
   }
   elseif (mysqli_errno($theLINK) > 0 && mysqli_errno($theLINK) <> 1062)
   {
    ?>
    <script>
      alert("terjadi kesalahan, proses tambah data tidak berhasil");
      alert("<?= mysqli_error($theLINK); ?>");
    </script>
    <?php
   }
   else
   {
    move_uploaded_file($_FILES['photo']['tmp_name'], '../photo/' . $photo);
    echo '<script>window.location="tampil.php"</script>';
   }
  }
 }
?>
<div class="card mt-3">
 <div class="card-header bg-primary text-white">Tambah Data Dosen</div>
  <div class="card-body">
   <form action="" method="post" enctype="multipart/form-data">
   <!-- *********************************************************************************** -->
    <div class="form-group">
     <label for="no_rm">NOMOR REKAM MEDIS</label>
     <input type="text" class="form-control" name="no_rm" id="no_rm" minlength="8" 
     maxlength="8" required pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}" value="<?=$no_rm;?>">
    </div>
   <!-- *********************************************************************************** -->
    <div class="form-group">
     <label for="nm_dos">NAMA LENGKAP PASIEN</label>
     <input type="text" class="form-control" name="nm_psn" id="nm_psn" 
     maxlength="80" required value="<?=$nm_psn;?>">
    </div>
   <!-- *********************************************************************************** -->
    <div class="form-group">
     <label for="sex">JENIS KELAMIN PASIEN</label>&nbsp;&nbsp;&nbsp;
      <?php if ($sex == 'L') $CEK = 'checked'; else $CEK = ''; ?>
      <input type="radio" name="sex" id="sex" value="L" required <?=$CEK;?>>
      <label for="sex">Laki-Laki</label>&nbsp;&nbsp;&nbsp;
      <?php if ($sex == 'P') $CEK = 'checked'; else $CEK = ''; ?>
      <input type="radio" name="sex" id="sex" value="P" required <?=$CEK;?>>
      <label for="sex">Perempuan</label>
    </div>
   <!-- *********************************************************************************** -->
    <div class="form-group">
     <label for="tgl_lhr">TANGGAL LAHIR</label>
     <input type="date" class="form-control" name="tgl_lhr" id="tgl_lhr" 
     value="<?=$tgl_lhr;?>" required>
    </div>
   <!-- *********************************************************************************** -->
    <div class="form-group">
     <label for="photo">PHOTO PASIEN</label>
     <input type="file" class="form-control" name="photo" id="photo" required>
     <p style="color: red"><b>Ekstensi harus .png | .jpg | .jpeg | .gif - Maksimal 1Mb</b></p>
    </div>
   <!-- *********************************************************************************** -->
    <button type="submit" class="btn btn-primary mt-3" name="cmdSIMPAN">Simpan</button>
    <button type="button" class="btn btn-danger mt-3" 
    onclick="window.location='tampil.php'">Batal</button>
   <!-- *********************************************************************************** -->
   </form>
</div>
<?php require("../bawah.php"); ?>