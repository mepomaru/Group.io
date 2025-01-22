<?php
session_start();
include '../../../../data/def/def.php';
include '../admin/createAdmin.php';

// データベース接続情報
// $servername = "localhost";
// $username = "p2root";
// $db_password = "p2root";
// $dbname = "phase2";

// フォームから送られた値を取得する
$uname = filter_input(INPUT_POST, "user_name");
$user_id = filter_input(INPUT_POST, "user_id");
$login_password = filter_input(INPUT_POST, "login-password");
$confirm_password = filter_input(INPUT_POST, "confirm-password");

// 入力チェック
$error = [
    "status" => true,
    "message" => "",
];

// 名前が入力されているかのチェック
if (!$uname) {
    $error["status"] = false;
    $error["message"] .= "名前が入力されていません。";
}

// ユーザーIDが入力されているかのチェック
if (!$user_id) {
    $error["status"] = false;
    $error["message"] .= "ユーザーIDが入力されていません。";
}

// パスワードが入力されているかのチェック
if (!$login_password) {
    $error["status"] = false;
    $error["message"] .= "パスワードを入力してください。";
}

// パスワードと確認パスワードが一致しているかのチェック
if ($login_password !== $confirm_password) {
    $error["status"] = false;
    $error["message"] .= "パスワードが一致しません。";
}

// エラーメッセージを表示
if (!$error["status"]) {
    $_SESSION['error'] = $error["message"];
    header("Location: /logster.php#Register");
    exit;
}

try {
    // データベース接続
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // 接続チェック
    if ($conn->connect_error) {
        die("接続に失敗しました: " . $conn->connect_error);
    }

    // パスワードをハッシュ化
    $hashed_password = password_hash($login_password, PASSWORD_DEFAULT);

    // プリペアドステートメントを使用してユーザー情報を挿入する
    $stmt = $conn->prepare("INSERT INTO " . TBL_USER . " (user_id, uname, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        die(" プリペアドステートメントの準備に失敗しました: " . $conn->error);
    }

    $stmt->bind_param("sss", $user_id, $uname, $hashed_password);

    // プリペアドステートメントを実行
    if ($stmt->execute()) {
        
        // ユーザーが正常に登録された場合、セッション変数に成功メッセージを設定
        $_SESSION['success'] = "ユーザー登録が完了しました。";
        $stmt->close();
        $conn->close();
        header("Location: ../../../index.php#Register");
        exit;
    } else {
        $_SESSION['error'] = "ユーザー登録に失敗しました: " . $stmt->error;
        $stmt->close();
        $conn->close();
        header("Location: ../../../index.php#Register");
        exit;
    }

} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "データ登録に失敗しました: " . $e->getCode() . " - " . $e->getMessage();
    header("Location: ../../../index.php#Register");
    exit;
} catch (Exception $e) {
    $_SESSION['error'] = "エラー: " . $e->getMessage();
    header("Location: ../../../index.php#Register");
    exit;
}
?>