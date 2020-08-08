<?php 
$id = $_GET["id"];

include("funcs.php");

$pdo = db_conn();

//データ登録SQL作成
// $stmt = $pdo -> prepare("SELECT * FROM gs_bm_table");
// $status = $stmt -> execute();

$delete = $pdo -> prepare("DELETE FROM gs_bm_table WHERE id=:id");
$delete -> bindValue(':id',$id,PDO::PARAM_INT);
$status = $delete ->execute();

//4.データ登録処理後
if($status == false){
    sql_error($delete);
}else{
    //5.index.phpへリダイレクト
    redirect("list.php");
}
?>