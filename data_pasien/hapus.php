<?php 
  require("../atas.php"); 
  
  $tempKODE   = $_POST["tempKODE"];
  $tempGAMBAR = $_POST["tempGAMBAR"];

  $query    = "DELETE FROM tbl_pasien WHERE no_rm = '$tempKODE'";
  $sambung  = mysqli_query($theLINK, $query);

  if (mysqli_errno($theLINK) > 0 && mysqli_errno($theLINK) == 1451)
  {
    ?>
    <script>
      alert("data belum bisa dihapus karena masih terhubung dengan data yang lain");
    </script>
    <?php
    echo '<script>window.location="tampil.php"</script>';
  }
  elseif (mysqli_errno($theLINK) > 0 && mysqli_errno($theLINK) <> 1451)
  {
    ?>
    <script>
      alert("terjadi kesalahan, proses hapus data tidak berhasil");
      alert("<?= mysqli_error($theLINK); ?>");
    </script>
    <?php
    echo '<script>window.location="tampil.php"</script>';
  }
  else
  {
    unlink("../photo/" . $tempGAMBAR);
    echo '<script>window.location="tampil.php"</script>';
  }
?>