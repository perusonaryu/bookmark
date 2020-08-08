<?php 


//データベース接続関数
function db_conn(){
    try {
        // $db_name = "practice_01";    //データベース名
        // $db_id   = "root";      //アカウント名
        // $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
        // $db_host = "localhost"; //DBホスト
        // $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);


        $db_name = "perusonaryu_bookmark";    //データベース名
        $db_id   = "perusonaryu";      //アカウント名
        $db_pw   = "perusona1127";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "mysql57.perusonaryu.sakura.ne.jp"; //DBホスト
        $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}


//sqlエラー関数
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

function redirect($file_name){
    header("Location:".$file_name);
    exit();
}



?>