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
    { "data": "name" },
    { "data": "email" },
   ]  
  });
 });
 </script>