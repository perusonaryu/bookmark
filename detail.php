<?php 
$id = $_GET["id"];

include("funcs.php");
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt -> bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

if($status == false){
    sql_error();
}else{
    $r = $stmt->fetch();//一行だけ取得
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand " href="index.php">Bookmark</a>
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
        </div>

    </nav>

    <div class="container">
        <form method="post" action="update.php">
            <div class="form-group">
                <label for="book_title">書籍名</label>
                <input type="text" name="book_title" class="form-control" id="book_title" aria-describedby="emailHelp" value="<?=$r["book_title"]?>">
            </div>

            <div class="form-group">
                <label for="book-url">書籍URL</label>
                <input type="text" name="book_url" class="form-control" id="book-url" value="<?=$r["book_url"]?>">
            </div>

            <div class="form-group">
                <label for="book-image">書籍の画像URL</label>
                <input type="text" name="book_image" class="form-control" id="book-image" value="<?=$r["book_image"]?>">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="category">Category</label>
                </div>
                <select class="custom-select" id="category" name="category">
                    <option  >Choose...</option>
                    <option value="1" <?php if($r["category"]==1){echo "selected";} ?>>Programming</option>
                    <option value="2" <?php if($r["category"]==2){echo "selected";} ?>>Hobby</option>
                    <option value="3" <?php if($r["category"]==3){echo "selected";} ?>>Life</option>
                </select>
            </div>


            <div class="form-group">
                <label for="comment">コメント</label>
                <textarea class="form-control" name="comment" id="comment" rows="3"><?= $r["book_comment"] ?></textarea>
            </div>

            <input type="hidden" name="id" value="<?= $r["id"] ?>">
            <input class="btn btn-primary" type="submit" value="Submit">
        </form>

    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="js/main.js"></script>
</body>

</html>