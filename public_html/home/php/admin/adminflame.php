<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/flame.css">
    <title>フレームページ</title>
</head>

<body>
    <!-- ヘッダー：グループ作成ページへ移動するボタン -->
    <header>
        <button onclick="window.location.href='createGroup.php'">グループ作成ページへ</button>
    </header>

    <!-- メインコンテンツ：グループボタンの表示 -->
    <main>
        <div id="buttonContainer">
            <?php
            include '../../../../data/def/def.php';

            // 接続を作成
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            // 接続をチェック
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // gnameを取得するクエリ
            $sql = 'SELECT gname FROM groupName';
            $result = $conn->query($sql);

            // ボタン生成のためのHTML出力
            if ($result->num_rows > 0) {
                // 結果をループで回してbuttonを生成
                while ($row = $result->fetch_assoc()) {
                    $gname = htmlspecialchars($row['gname']);
                    echo '<button class = "button" onclick="navigateToPage(\'' . $gname . '\')">' . $gname . '</button>';
                }
            } else {
                echo 'No group names found.';
            }

            // データベース接続を閉じる
            $conn->close();
            ?>
        </div>
    </main>
    <script>
        // 遷移先にリダイレクトするJavaScript関数
        function navigateToPage(gname) {
            // 基本URLを設定（任意のページに変更可能）
            var baseUrl = 'admin_main.php';
            // クエリパラメータを追加して遷移
            window.location.href = baseUrl + '?gname=' + encodeURIComponent(gname);
        }
    </script>
</body>

</html>