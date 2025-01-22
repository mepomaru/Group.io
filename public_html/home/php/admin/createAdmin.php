<?php

// データベース接続

// 接続チェック

$user_id = 'p2admin';
$uname = 'p2admin';
$login_password = 'p2admin';
$authority = 1;
// パスワードをハッシュ化
$hashed_password = password_hash($login_password, PASSWORD_DEFAULT);
echo $hashed_password;
// プリペアドステートメントを使用してユーザー情報を挿入する
// $stmt = $conn->prepare("INSERT INTO " . TBL_USER . " (user_id, uname, password, authority) VALUES (?, ?, ?, ?)");
// if (!$stmt) {
//     die(" プリペアドステートメントの準備に失敗しました: " . $conn->error);
// }

// $stmt->bind_param("sssi", $user_id, $uname, $hashed_password, $authority);

?>