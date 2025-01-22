<?php
include '../../../../data/def/def.php';

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/adminMain.css">
    <title>adminMain</title>
</head>
    <div class="container">
    <a href="userList.php"><button>チーム作成</button></a>
        <div class="header">
            <h1>ユーザー全件一覧</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ユーザー</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>ユーザー1</td>
                    <td><button class="delete-button">削除</button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>ユーザー2</td>
                    <td><button class="delete-button">削除</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="../../js/adminMain.js"></script>
    </body>

</html>