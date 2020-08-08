<?php 
$book_title = $_POST["book_title"];
$book_url   = $_POST["book_url"];
$book_image = $_POST["book_image"];
$category   = $_POST["category"];
$comment    = $_POST["comment"];
$id         = $_POST["id"];

include("funcs.php");
$pdo = db_conn();

$sql = "UPDATE gs_bm_table SET book_title=:book_title, book_url=:book_url, book_image=:book_image, category=:category, book_comment=:book_comment WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt -> bindValue(':book_title',$book_title,PDO::PARAM_STR);
$stmt -> bindValue(':book_url',$book_url,PDO::PARAM_STR);
$stmt -> bindValue(':book_image',$book_image,PDO::PARAM_STR);
$stmt -> bindValue(':category',$category,PDO::PARAM_INT);
$stmt -> bindValue(':book_comment',$comment,PDO::PARAM_STR);
$stmt -> bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

if($status == false){
    sql_error($stmt);
}else{
    redirect("list.php");
}



?>