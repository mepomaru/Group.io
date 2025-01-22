<?php
include '../../../../data/def/def.php';
// 接続を作成
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// 接続をチェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
// セッションからaccount_idを取得
if (isset($_SESSION['account_id'])) {
    $account_id = $_SESSION['account_id'];
    //echo "ログイン中のユーザーIDは: " . $account_id;
} else {
    //echo "ログインしてください。";
}
// データベースからレコード数を取得する
$sql = "SELECT COUNT(*) as count FROM " . TBL_FORMANS . " where account_id = $account_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $record_count = $row['count'];
} else {
    $record_count = 0;
}
// 接続を閉じる
$conn->close();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/usermain.css">
    <link rel="stylesheet" href="../../css/main.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>userMain</title>
</head>

<body>
    <?php if ($record_count == 0): ?>
        <h2>フォーム解答</h2>
        <a href="form.php"><button>フォーム入力画面へ</button></a>
    <?php else: ?>
        <h2>チーム一覧</h2>
        <ul class="accordion-area">
            <?php
            include 'display.php';
            ?>
        </ul>
    <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="../../js/usermain.js"></script>

</body>

</html>