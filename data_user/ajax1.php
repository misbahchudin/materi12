<?php 
require_once '../atas.php';

if ($_GET['action'] == "table_data")
{
 $columns = array( 
  0 => 'id', 
  1 => 'name',
  2 => 'email',
 );

 $querycount    = $theLINK->query("SELECT count(id) as jumlah FROM tbl_user");
 $datacount     = $querycount->fetch_array();
 $totalData     = $datacount['jumlah'];
 $totalFiltered = $totalData; 

 $limit = $_POST['length'];
 $start = $_POST['start'];
 $order = $columns[$_POST['order']['0']['column']];
 $dir   = $_POST['order']['0']['dir'];

 if (empty($_POST['search']['value']))
 {            
  $query  = $theLINK->query("SELECT * FROM tbl_user order by $order $dir 
                             LIMIT $limit OFFSET $start");
 }
 else
 {
  $search = $_POST['search']['value']; 
  $query  = $theLINK->query("SELECT * FROM tbl_user WHERE id = '$search' 
                             OR name LIKE '%$search%' OR email LIKE '%$search%' 
                             ORDER BY $order $dir LIMIT $limit OFFSET $start");

  $querycount    = $theLINK->query("SELECT count(id) as jumlah FROM tbl_user 
                                    WHERE id = '$search' OR name LIKE '%$search%' 
                                    OR email LIKE '%$search%'");
  $datacount     = $querycount->fetch_array();
  $totalFiltered = $datacount['jumlah'];
 }
 
 $data = array();
 if (!empty($query))
 {
  $no = $start + 1;
  while ($r = $query->fetch_array())
  {
   $nestedData['no']    = $no;
   $nestedData['name']  = $r['name'];
   $nestedData['email'] = $r['email'];
   $data[] = $nestedData;
   $no++;
  }
 }

 $json_data = array(
  "draw"            => intval($_POST['draw']),  
  "recordsTotal"    => intval($totalData),  
  "recordsFiltered" => intval($totalFiltered), 
  "data"            => $data   
 );

 echo json_encode($json_data); 
}