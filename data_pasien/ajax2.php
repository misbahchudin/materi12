<script>
 $(function(){
  $('.table').DataTable({
   "processing": true,
   "serverSide": true,
   "ajax":
   {
    "url": "ajax1.php?action=table_data",
    "dataType": "json",
    "type": "POST"
   },
   "columns":
   [
    { "data": "no" },
    { "data": "no_rm" },
    { "data": "nm_psn" },
    { "data": "sex" },
    { "data": "tgl_lhr" },
    { "data": "photo" },
    { "data": "aksi" },
   ]  
  });
 });
 </script>