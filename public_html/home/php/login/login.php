<?php
include '../../../../data/def/def.php';
include '../admin/createAdmin.php';
session_start();
// データベース接続情報
// $servername = "localhost";
// $username = "p2root";
// $db_password = "p2root";
// $dbname = "phase2";

// フォームから送られた値を取得する
$login_id = filter_input(INPUT_POST, "login_account_id");
$login_password = filter_input(INPUT_POST, "password");

// 入力チェック
$error = [
    "status" => true,
    "message" => "",
];

// アカウントIDが入力されているかのチェック
if (!$login_id) {
    $error["status"] = false;
    $error["message"] .= "アカウントIDが入力されていません。";
}

// パスワードが入力されているかのチェック
if (!$login_password) {
    $error["status"] = false;
    $error["message"] .= "パスワードを入力してください。";
}

// エラーメッセージを表示
if (!$error["status"]) {
    echo $error["message"];
    exit;
}

try {
    // データベース接続
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // 接続チェック
    if ($conn->connect_error) {
        die("接続に失敗しました: " . $conn->connect_error);
    }

    // SQLクエリを準備
    $sql = "SELECT * FROM " . TBL_USER . " WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // レコードが存在する場合
        $row = $result->fetch_assoc();

        // 挿入された行のuser_idを取得
        // $user_id = $conn->insert_id;

        // データベースから取得したuser_idとパスワード
        $_SESSION['account_id'] = $row['account_id'];
        $storedPassword = $row['password'];
        $authority = $row['authority'];

        // 入力されたパスワードとデータベースのパスワードを比較
        if (password_verify($login_password, $row['password'])) {
            if ($authority == 1) {
                header("Location: ../admin/adminflame.php");
                exit;
            }
            // 一致する場合
            header("Location: ../user/userflame.php");
            exit;
        } else {
            header("Location: ../../../index.php#Login");
            exit;
        }
    }
    // プリペアドステートメントを閉じる
    $stmt->close();

    // データベースとの接続を閉じる
    $conn->close();
    header("Location: ../../../index.php#Login");
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "データ登録に失敗しました: " . $e->getCode() . " - " . $e->getMessage();
    header("Location: ../user/userflame.php");
    exit;
} catch (Exception $e) {
    $_SESSION['error'] = "エラー: " . $e->getMessage();
    header("Location: ../user/userflame.php");
    exit;
}
