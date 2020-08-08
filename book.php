<?php
include("funcs.php");


$book_title = $_POST["title"];
$book_author = $_POST["author"];

// 検索条件を配列にする
$params = array(
  'intitle'  => $book_title,  //書籍タイトル
  'inauthor' => $book_author,       //著者
);
// 1ページあたりの取得件数
$maxResults = 40;
// ページ番号（1ページ目の情報を取得）
$startIndex = 0;  //欲しいページ番号-1 で設定
// APIの基本になるURL
$base_url = 'https://www.googleapis.com/books/v1/volumes?q=';
// 配列で設定した検索条件をURLに追加

// var_dump(!empty($book_title));
// var_dump(!empty($book_author));

if (!empty($book_title) && !empty($book_author)) {
    foreach ($params as $key => $value) {
        $base_url .= $key.':'.$value.'+';
    }
    // 末尾につく「+」をいったん削除
    $params_url = substr($base_url, 0, -1);
    // 件数情報を設定
    $url = $params_url.'&maxResults='.$maxResults.'&startIndex='.$startIndex;
} elseif (!empty($book_title) && empty($book_author)) {
    $base_url .=  array_search($book_title, $params).':'. $params['intitle'];
    // 件数情報を設定
    $url = $base_url.'&maxResults='.$maxResults.'&startIndex='.$startIndex;
} elseif (empty($book_title) && !empty($book_author)) {
    $base_url .=  array_search($book_author, $params).':'. $params['inauthor'];
    // 件数情報を設定
    $url = $base_url.'&maxResults='.$maxResults.'&startIndex='.$startIndex;
}


// foreach ($params as $key => $value) {
//     $base_url .= $key.':'.$value.'+';
// }

// // 末尾につく「+」をいったん削除
// $params_url = substr($base_url, 0, -1);
// // 件数情報を設定
// $url = $params_url.'&maxResults='.$maxResults.'&startIndex='.$startIndex;
// echo $url;



// 書籍情報を取得
$json = file_get_contents($url);
// デコード（objectに変換）
$data = json_decode($json);
// var_dump($data);

// 全体の件数を取得
$total_count = $data->totalItems;
// 書籍情報を取得
$books = $data->items;
// 実際に取得した件数
$get_count = count($books);


?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <title>Books</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
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

    <form class="form-inline my-2 my-lg-0" action="book.php" method="post">
      <input class="form-control mr-sm-2" name="title" type="search" placeholder="title" aria-label="title" value="<?= $book_title?>">
      <input class="form-control mr-sm-2" name="author" type="search" placeholder="author" aria-label="author" value="<?= $book_author?>">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </nav>

  <div class="container">
    <!-- <p>全<?php echo $total_count; ?>件中、<?php echo $get_count; ?>件を表示中</p> -->
    <!-- <button type="button" class="btn btn-info" id="next">Info</button> -->
    <!-- 1件以上取得した書籍情報がある場合 -->
    <?php if ($get_count > 0): ?>
    <div class="scroll" style="overflow: auto;height: 800px;">
    <div class="row">
      <!-- 取得した書籍情報を順に表示 -->
      <?php
      session_start();
      $_SESSION["book_t"] = [];
      $_SESSION["book_thumbnail"] = [];
      $_SESSION["book_link"] = [];
      // $book_thumbnail = [];
      // $book_author = [];
      $i = 0;
    //     var_dump($book);
        foreach($books as $book):
        // タイトル
        $title = $book->volumeInfo->title;
        // サムネ画像
        $thumbnail = $book->volumeInfo->imageLinks->thumbnail;
        // echo $authors;
        // echo $book_link;
        // echo $thumbnail;
        // 著者（配列なのでカンマ区切りに変更）
        $authors = implode(',', $book->volumeInfo->authors);
        $book_link = $book->volumeInfo->infoLink;


        $_SESSION["book_t"][] = $title;
        $_SESSION["book_thumbnail"][] = $thumbnail;
        $_SESSION["book_link"][] = $book->volumeInfo->infoLink;
      ?>

      <div class="col-md-4 mt-5">
        <div class="card ml-auto mr-auto border-primary h-100" style="width: 18rem;">
          <img src="<?php echo $thumbnail; ?>" class="card-img-top" alt="<?php echo $title; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $title; ?></h5>
            <a href="<?php echo $book_link; ?>" class="btn btn-primary">Go Link</a>
            <a href="index.php?id=<?=$i?>" class="btn btn-primary">Bookmark</a>
          </div>
        </div>
      </div>


      <?php
        $i++;
        endforeach;
        // var_dump($book_t);
        // var_dump($book_thumbnail);
    ?>
    </div><!-- ./loop_books -->
  </div>
  </div>
  <!-- 書籍情報が取得されていない場合 -->
  <?php else: ?>
  <p>情報が有りません</p>
  <?php endif; ?>


  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
  </script>
  <script>
  $("#next").on("click",function(){
    <?php
    if($startIndex == 0){
      $startIndex += 9;
    }else{
      $startIndex += 10;
    }
    ?>
    window.location.reload();
  });
  </script>
</body>

</html>