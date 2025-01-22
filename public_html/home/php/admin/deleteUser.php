<?php
include '../../../../data/def/def.php';
// データベース接続を作成
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// 接続をチェック
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $account_id = intval($_POST['account_id']);

    // SQLクエリを実行してユーザーを削除
    $sql = "DELETE FROM " . TBL_USER . " WHERE account_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $account_id);

    if ($stmt->execute()) {
        echo "ユーザーID " . $account_id . " を削除しました。";
        header("Location: admin_main.php");

    } else {
        echo "ユーザー削除に失敗しました: " . $stmt->error;
        header("Location: admin_main.php");

    }

    $stmt->close();
} else {
    echo "無効なリクエストです。";
}

$conn->close();