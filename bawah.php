 </div>
 <script src="<?= $thePORT . 'library/jquery-3.5.1.js'; ?>"></script>
 <script src="<?= $thePORT . 'library/jquery.dataTables.min.js'; ?>"></script>
 <script src="<?= $thePORT . 'library/dataTables.bootstrap4.min.js'; ?>"></script>
 
 <?php
 if ($thePROGRAM == "dataPASIEN")
 {
  require("data_pasien/ajax2.php");
 }
 if ($thePROGRAM == "dataUSER")
 {
  require("data_user/ajax2.php");
 }
 ?>
</body>
</html>