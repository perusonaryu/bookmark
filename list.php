<?php
//データベースに接続
include("funcs.php");
$pdo = db_conn();

//データ登録SQL作成
// $stmt = $pdo -> prepare("SELECT * FROM gs_bm_table");
// $status = $stmt -> execute();

$stmt = $pdo -> prepare("SELECT * FROM category_table LEFT OUTER JOIN gs_bm_table ON gs_bm_table.category_id = category_table.category_id");
$status = $stmt ->execute();

//データ表示
$view = "";


// $view .= $result["book_title"].$result["book_url"].$result["book_comment"];

if ($status == false) {
    //execute(SQL実行時にエラーがある場合)
    sql_error($stmt);
} else {
    //SELECTデータの数だけ自動でループでしてくれる
    while ($result = $stmt ->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<div class= "col-md-4 category_'.$result["category_id"].' mt-5">';
            $view .= '<div class="card ml-auto mr-auto border-primary h-100" style="width:18rem;">';
                $view .= '<img src='.$result["book_image"].' class="card-img-top" alt="...">';
                $view .= '<div class="card-body">';
                    $view .= '<h5 class="card-title text-success">'.$result["book_title"].'</h5>';
                    $view .= '<p class="card-subtitle mb-2 text-muted">'.$result["category"];
                        $view .= '<a href="delete.php?id='.$result["id"].'">';
                            $view .= '<i class="fas fa-trash-alt fa-lg float-right"></i>';
                        $view .= '</a>'; 
                        $view .= '<a href="detail.php?id='.$result["id"].'">';
                            $view .= '<i class="fas fa-edit fa-lg float-right"></i>';
                        $view .= '</a>'; 
                    $view .= '</p>';
                    $view .= '<p class="card-text mb-0">'.$result["book_comment"].'</p>';
                    $view .= '<a href='.$result["book_url"].' class="card-link" target="_blank">link</a>';
                $view .= '</div>';
            $view .= '</div>';
        $view .= '</div>';
    }
}





?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body >
    <nav class="navbar navbar-expand-lg navbar-primary bg-success fixed-top">
        <a class="navbar-brand" href="index.php">Bookmark</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            <!-- 以下に mr-auto クラスを付与するだけ -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="list.php">BookList</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle a" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="all">All</a>
                        <a class="dropdown-item" id="program">Programming</a>
                        <a class="dropdown-item" id="work">Hobby</a>
                        <a class="dropdown-item" id="life">Life</a>
                    </div>
                </li>
            </ul>

        </div>

    </nav>

    <div class="container">
        <div class="scroll" style="overflow:auto;height: 800px;">
            <div class="row" >
                <?= $view ?>
            </div>

        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>
<script src="js/main.js"></script>




</html>