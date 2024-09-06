<?php include "../../config/koneksi.php";
//get

// SELECT pos_dsalesdeleted_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, postby, postdate, ad_muser_key, pos_dcashierbalance_key, sku, qty, price, discount, billno, approvedby, issync, status_intransit
// FROM public.pos_dsalesdeleted;


$query = "SELECT * FROM pos_dsalesdeleted WHERE isactived = '1' order by date(insertdate) desc";

$json = array();
$no = 1;
$statement = $connec->query($query);
foreach ($statement as $r) {
    
    $pos_dsalesdeleted_key = $r['pos_dsalesdeleted_key'];
    $ad_mclient_key = $r['ad_mclient_key'];
    $ad_morg_key = $r['ad_morg_key'];
    $isactived = $r['isactived'];
    $insertdate = $r['insertdate'];
    $insertby = $r['insertby'];
    $postby = $r['postby'];
    $postdate = $r['postdate'];
    $ad_muser_key = $r['ad_muser_key'];
    $pos_dcashierbalance_key = $r['pos_dcashierbalance_key'];
    $sku = $r['sku'];
    $qty = $r['qty'];
    $price = $r['price'];
    $discount = $r['discount'];
    $billno = $r['billno'];
    $approvedby = $r['approvedby'];
    $issync = $r['issync'];
    $status_intransit = $r['status_intransit'];
    $total = $qty * $price - $discount;
    $description = '';
    //get description from ad_mproduct_key
    $query_product = "SELECT * FROM pos_mproduct WHERE sku = '". $sku."' ";
    $statement_product = $connec->query($query_product);
    foreach ($statement_product as $r_product) {
        $description = $r_product['name'];
    }

    $cashier_name = '';
    //get cashier name from ad_muser_key
    $query_cashier = "SELECT * FROM ad_muser WHERE ad_muser_key = '" . $ad_muser_key . "' ";
    $statement_cashier = $connec->query($query_cashier);
    foreach ($statement_cashier as $r_cashier) {
        $cashier_name = $r_cashier['username'];
    }


    $json[] = array(
        "no" => $no,
        "pos_dsalesdeleted_key" => $pos_dsalesdeleted_key,
        "ad_mclient_key" => $ad_mclient_key,
        "ad_morg_key" => $ad_morg_key,
        "isactived" => $isactived,
        "insertdate" => $insertdate,
        "insertby" => $insertby,
        "postby" => $postby,
        "postdate" => $postdate,
        "ad_muser_key" => $ad_muser_key,
        "cashier_name" => $cashier_name,
        "pos_dcashierbalance_key" => $pos_dcashierbalance_key,
        "sku" => $sku,
        "description" => $description,
        "qty" => $qty,
        "price" => $price,
        "discount" => $discount,
        "total" => $total,
        "billno" => $billno,
        "approvedby" => $approvedby,
        "issync" => $issync,
        "status_intransit" => $status_intransit
    );

    $no++;
}


$json_string = json_encode($json);
echo $json_string;

?>