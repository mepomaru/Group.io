<?php
// 接続を作成
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// 接続をチェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// チーム番号を取得
$sql = "SELECT team_no FROM " . TBL_MEMBER . " WHERE account_id = $account_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $team_no = intval($row['team_no']);
} else {
    die("フォームは入力されています。<br>管理者がチームを作成するまでお待ちください。");
}

// メンバーを取得
$sql = "SELECT account_id FROM " . TBL_MEMBER . " WHERE team_no = $team_no";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $member_account_id = intval($row['account_id']);

        // uname を取得するクエリ
        $sql_user = "SELECT uname FROM " . TBL_USER . " WHERE account_id = $member_account_id";
        $result_user = $conn->query($sql_user);
        if ($result_user && $result_user->num_rows > 0) {
            $row_user = $result_user->fetch_assoc();
            $uname = htmlspecialchars($row_user['uname']);
        } else {
            $uname = 'ユーザーが見つかりませんでした';
        }

        // passion を取得するクエリ
        $sql_passion = "SELECT passion FROM " . TBL_FORMANS . " WHERE account_id = $member_account_id";
        $result_passion = $conn->query($sql_passion);
        if ($result_passion && $result_passion->num_rows > 0) {
            $row_passion = $result_passion->fetch_assoc();
            $passion = htmlspecialchars($row_passion['passion']);
        } else {
            $passion = '情報が見つかりませんでした';
        }


        // グローバル配列を初期化
        $roles_array = array();
        // 役割を取得するクエリ
        $sql_roles = "SELECT role_select FROM " . TBL_FORMANS . " WHERE account_id = $member_account_id";
        $result_roles = $conn->query($sql_roles);

        // クエリが成功したか確認
        if ($result_roles) {
            // 結果が存在するか確認
            if ($result_roles->num_rows > 0) {
                while ($row = $result_roles->fetch_assoc()) {
                    // 配列に追加
                    $role = $row['role_select'];
                    $roles_array = replace($role);
                }
            } else {
                echo "指定されたアカウントIDには役割が見つかりませんでした: $member_account_id";
            }
        } else {
            echo "クエリ実行エラー: " . $conn->error;
        }


        // HTMLとして表示
        echo '<li>';
        echo "<section>";
        echo "<p class=\"title\" style=\"color: white\">$uname</p>";
        echo '<div class="box">';
        echo '<hr class="hr1">';
        echo "<p class=\"passion\" style=\"color: white\">意気込み</p>";
        echo "<p style=\"color: white\">$passion</p>";
        echo '<hr class="hr1">';
        echo "<p class=\"role\" style=\"color: white\">希望する役割</p>";
        echo "<p style=\"color: white\">$roles_array</p>";
        echo '</div>';
        echo "</section>";
        echo '</li>';
    }
} else {
    echo "メンバーが見つかりませんでした";
}

// MySQL接続を閉じる
$conn->close();

function replace($role,$targets = ['[', ']', '"'])
{
    return str_replace($targets, '', $role);
}
