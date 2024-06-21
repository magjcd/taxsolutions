<?php

if(isset($_POST['feeyr'])){ // Update Fees Year in General Journal on Click
    include('../autoLoad.php');
    $ContObj = new Controller();
    $ContObj->UpdateFeeYear($_POST['id'],$_POST['feeyr']);

}elseif(isset($_POST['feetpid'])){ // Update Debit Amount in General Journal on Click
    include('../autoLoad.php');
    $ContObj = new Controller();
    $ContObj->UpdateFeeType($_POST['id'],$_POST['feetpid'],$_POST['feetpname']);
}

// elseif(isset($_POST['drAmt'])){ // Update Debit Amount in General Journal on Click
//     include('../autoLoad.php');
//     $ContObj = new Controller();
//     $ContObj->UpdateDrAmt($_POST['id'],$_POST['drAmt']);
// }elseif(isset($_POST['crAmt'])){ // Update Credit Amount in General Journal on Click
//     include('../autoLoad.php');
//     $ContObj = new Controller();
//     $ContObj->UpdateCrAmt($_POST['id'],$_POST['crAmt']);
// }