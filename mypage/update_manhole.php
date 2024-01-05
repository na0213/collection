<?php
session_start();
require('../connect.php');
$pdo = db_conn();
//３．データ登録SQL作成
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prefecture = $_POST['prefecture'];
    $comment = $_POST['comment'];
    $image_id = $_POST['image_id']; // フォームから送信された画像のID

    // UPDATEクエリの実行
    $sql = 'UPDATE manhole_image SET prefecture = :prefecture, comment = :comment WHERE image_id = :image_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':prefecture', $prefecture, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':image_id', $image_id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: manhole.php'); // 更新後にmanhole.phpにリダイレクト
    exit();
}
