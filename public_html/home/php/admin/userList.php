<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/adminUserList.css">
    <title>userList</title>
</head>

<body>
    <div class="container">
        <header>
            <h1>チーム作成</h1>
        </header>
        <div class="memberTotal">
            <a>現在のform回答者？？人</a>
        </div>
        <div class="form-group">
            <label for="membersPerTeam">1チーム当たりのメンバー数を入力:</label>
            <input type="number" id="membersPerTeam">
        </div>

        <div class="form-group">
            <label for="membersPerTeam">1チーム当たりのメンバー数を入力:</label>
            <input type="number" id="membersPerTeam">
        </div>

        <div class="form-group">
            <button onclick="window.location.href='./createTeam.php'">作成</button>
            <a href="admin_main.php"><button class="back-button">戻る</button></a>
        </div>
        <div class="teams" id="teams">
            <!-- チームがここに表示される -->
        </div>
    </div>
    <script src="../../js/adminUserList.js"></script>
    <script>
        // ページが読み込まれたときにcreateTeams関数を呼び出す
        window.onload = function() {
            createTeams();
        }
    </script>
</body>

</html>
