<?php include "../../config/koneksi.php";

$org_key = $_POST['ad_org_id'];
$nama_insert = $_POST['username'];
$userid = $_POST['userid'];

//show tbody format return
$sql = "SELECT * FROM cash_in WHERE org_key = '$org_key' AND userid = '$userid' ORDER BY insertdate DESC";
$statement1 = $connec->query($sql);
if ($statement1) {
    $json = array('result' => '1', 'msg' => 'Berhasil menampilkan cash in', 'data' => $statement1->fetchAll(PDO::FETCH_ASSOC));
} else {
    $json = array('result' => '0', 'msg' => 'Gagal menampilkan cash in');
}

$json_string = json_encode($json);
echo $json_string;