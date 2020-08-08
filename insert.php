<?php 
//1.POSTデータ取得

$book_title = $_POST["book_title"];
$book_url = $_POST["book_url"];
$book_image = $_POST["book_image"];
$category = $_POST["category"];
$comment = $_POST["comment"];

//2.データベース接続
include("funcs.php");
$pdo = db_conn();

//3.データ登録SQL作成
$sql = "INSERT INTO gs_bm_table(id,book_title,book_url,book_image,category_id,book_comment,indate) VALUE(NULL,:book_title,:book_url,:book_image,:category,:comment,sysdate())";
$stmt = $pdo -> prepare($sql);
$stmt -> bindValue(':book_title',$book_title,PDO::PARAM_STR);
$stmt -> bindValue(':book_url',$book_url,PDO::PARAM_STR);
$stmt -> bindValue(':book_image',$book_image,PDO::PARAM_STR);
$stmt -> bindValue(':category',$category,PDO::PARAM_STR);
$stmt -> bindValue(':comment',$comment,PDO::PARAM_STR);

//SQL実行
$status = $stmt -> execute();

//4.データ登録処理後
if($status == false){
    sql_error($stmt);
}else{
    //5.index.phpへリダイレクト
    redirect("index.php");
}



?>