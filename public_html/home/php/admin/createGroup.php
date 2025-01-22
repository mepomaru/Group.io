<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/createGroup.css">
    <title>グループ作成</title>
</head>

<body>
    <form action="createGroup.php" method="post">
        <label for="groupName">グループ名を入力してください：</label><br>
        <input type="text" id="groupName" name="groupName" required><br>

        <label for="rolesName">必要な役割を入力してください：</label><br>
        <div id="textContainer">
            <input type="text" id="dynamicInput1" name="dynamicInput[]">
        </div>
        <button type="button" id="addButton">+</button><br>

        <input type="submit" id="submit" name="createGroup" value="グループ作成">
    </form>
    <script src="../../js/createGroup.js"></script>
    <?php
    // フォームが送信された場合
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 入力されたグループ名を取得
        $groupName = $_POST['groupName'];

        include '../../../../data/def/def.php';

        // 接続を作成
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // 接続をチェック
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // 4. グループ名をテーブルに挿入
        $sql = "INSERT INTO groupName (gName) VALUES ('$groupName')";

        if ($conn->query($sql) === TRUE) {

            // データベース接続を閉じる
            $conn->close();

            // flame.phpにリダイレクト
            header("Location: adminflame.php");
            exit();
        } else {
            echo "エラー: " . $sql . "<br>" . $conn->error;
        }

        // 接続を閉じる
        $conn->close();
    }
    ?>
</body>

</html>