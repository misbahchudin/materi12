<?php 
require_once '../atas.php';

if ($_GET['action'] == "table_data")
{
 $columns = array( 
  0 => 'no_rm', 
  1 => 'nm_psn',
  2 => 'sex',
  3 => 'tgl_lhr',
  4 => 'photo',
  5 => 'no_rm',
 );

 $querycount    = $theLINK->query("SELECT count(no_rm) as jumlah FROM tbl_pasien");
 $datacount     = $querycount->fetch_array();
 $totalData     = $datacount['jumlah'];
 $totalFiltered = $totalData; 

 $limit = $_POST['length'];
 $start = $_POST['start'];
 $order = $columns[$_POST['order']['0']['column']];
 $dir   = $_POST['order']['0']['dir'];

 if (empty($_POST['search']['value']))
 {            
  $query  = $theLINK->query("SELECT * FROM tbl_pasien order by $order $dir 
                             LIMIT $limit OFFSET $start");
 }
 else
 {
  $search = $_POST['search']['value']; 
  $query  = $theLINK->query("SELECT * FROM tbl_pasien WHERE no_rm LIKE '%$search%' 
            OR nm_psn LIKE '%$search%' OR sex LIKE '%$search%' OR tgl_lhr LIKE '%$search%' 
            ORDER BY $order $dir LIMIT $limit OFFSET $start");

  $querycount    = $theLINK->query("SELECT count(no_rm) as jumlah FROM tbl_pasien 
                   WHERE no_rm LIKE '%$search%' OR nm_psn LIKE '%$search%' 
                   OR sex LIKE '%$search%' OR tgl_lhr LIKE '%$search%'");
  $datacount     = $querycount->fetch_array();
  $totalFiltered = $datacount['jumlah'];
 }
 
 $data = array();
 if (!empty($query))
 {
  $no = $start + 1;
  while ($r = $query->fetch_array())
  {
   $ubah = "<form action='ubah.php' method='post'>
            <input type='hidden' name='tempKODE' id='tempKODE' value='" . $r['no_rm'] . "'>
            <input type='hidden' name='tempGAMBAR' id='tempGAMBAR' value='" . $r['photo'] . "'>
            <button type='submit' class='btn btn-success btn-sm' name='cmdUBAH'>ubah</button>
            </form>";
   $pesan = "yakin ingin menghapus";
   $hapus = "<form action='hapus.php' method='post'>
             <input type='hidden' name='tempKODE' id='tempKODE' value='" . $r['no_rm'] . "'>
             <input type='hidden' name='tempGAMBAR' id='tempGAMBAR' value='" . $r['photo'] . "'>
             <button type='submit' class='btn btn-danger btn-sm' name='cmdHAPUS' 
             onclick=\"javascript: return confirm('yakin ingin menghapus...?');\">hapus</button></form>";
   $nestedData['no']       = $no;
   $nestedData['no_rm']    = $r['no_rm'];
   $nestedData['nm_psn']   = $r['nm_psn'];
   $nestedData['sex']      = $r['sex'];
   $nestedData['tgl_lhr']  = $r['tgl_lhr'];
   $nestedData['photo']    = "<img src='" . $thePORT . 'photo/' . $r['photo'] . 
                             "' width='66' height='66'>";
   $nestedData['aksi']     = "<div class='row justify-content-center'><div class='col-3'>
                              $ubah</div><div class='col-3'>$hapus</div></div>";
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