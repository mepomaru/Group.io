<?php
// セッションを開始
session_start();
include '../../../../data/def/def.php';


// セッションからaccount_idを取得
if (isset($_SESSION['account_id'])) {
    $account_id = $_SESSION['account_id'];
    // echo "ログイン中のユーザーIDは: " . $account_id;
} else {
    // echo "ログインしてください。";
}
$account_id = $_SESSION['account_id'];

//性別の情報を取得する
$gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_SPECIAL_CHARS);

// 役割選択の情報取得
$roles = "";
if (isset($_POST['roles']) && is_array($_POST['roles'])) {
    $roles = $_POST['roles'];
}

// 配列をJSON形式に変換
$roles_json = json_encode($roles, JSON_UNESCAPED_UNICODE);

// エンコード結果の確認
if (json_last_error() !== JSON_ERROR_NONE) {
    die('JSONエンコードエラー: ' . json_last_error_msg());
}

//意気込みの情報を取得する
$passion = filter_input(INPUT_POST, "passion", FILTER_SANITIZE_SPECIAL_CHARS);

//モチベーション判定質問1の情報を取得する
$concentration = filter_input(INPUT_POST, "m_concentration", FILTER_VALIDATE_INT, [
    'options' => [
        'min_range' => 1,      //1以上の整数を許可 
        'max_range' => 4       //4以下の整数を許可
    ]
]);

//モチベーション判定質問2の情報を取得する
$cooperation = filter_input(INPUT_POST, "m_cooperation", FILTER_VALIDATE_INT, [
    'options' => [
        'min_range' => 1,      //1以上の整数を許可 
        'max_range' => 4       //4以下の整数を許可
    ]
]);

//リーダーシップ判定質問1の情報を取得する
$goal = filter_input(INPUT_POST, "l_goal", FILTER_VALIDATE_INT, [
    'options' => [
        'min_range' => 1,      //1以上の整数を許可 
        'max_range' => 4       //4以下の整数を許可
    ]
]);

//リーダーシップ判定質問2の情報を取得する
$prioritize = filter_input(INPUT_POST, "l_prioritize", FILTER_VALIDATE_INT, [
    'options' => [
        'min_range' => 1,      //1以上の整数を許可 
        'max_range' => 4       //4以下の整数を許可
    ]
]);

//計画性判定質問1の情報を取得する
$achieve = filter_input(INPUT_POST, "p_achieve", FILTER_VALIDATE_INT, [
    'options' => [
        'min_range' => 1,      //1以上の整数を許可 
        'max_range' => 4       //4以下の整数を許可
    ]
]);

//計画性判定質問2の情報を取得する
$precedence = filter_input(INPUT_POST, "p_precedence", FILTER_VALIDATE_INT, [
    'options' => [
        'min_range' => 1,      //1以上の整数を許可 
        'max_range' => 4       //4以下の整数を許可
    ]
]);

//報連相判定質問2の情報を取得する
$contact = filter_input(INPUT_POST, "r_contact", FILTER_VALIDATE_INT, [
    'options' => [
        'min_range' => 1,      //1以上の整数を許可 
        'max_range' => 4       //4以下の整数を許可
    ]
]);

//報連相判定質問2の情報を取得する
$tool = filter_input(INPUT_POST, "r_tool", FILTER_VALIDATE_INT, [
    'options' => [
        'min_range' => 1,      //1以上の整数を許可 
        'max_range' => 4       //4以下の整数を許可
    ]
]);


//入力チェック
$error = [
    "status" => true,
    "message" => null,
    "result" => null,
];

//NULL判定
$required_fields = array($gender, $passion, $concentration, $cooperation, $goal, $prioritize, $achieve, $precedence, $contact, $tool);

foreach ($required_fields as $field) {
    if ($field == null) {
        $error["status"] = false;
        // エラーメッセージを追加する場合は必要に応じて以下のように処理を追加できる
        $error["message"] .= "NULLあり<br>";
    }
}

$error_message = '既に登録されています';

//phpが最後まで実行されたかを確認するフラグ
$sucsess = true;

if ($error["status"]) {
    try {
        // データベース接続
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // 接続チェック
        if ($conn->connect_error) {
            die("Connect failed: " . $conn->connect_error);
        }

        // 同じclass_nameが存在する場合の処理
        // echo "ここ";
        // INSERT文の準備
        $stmt = $conn->prepare("INSERT INTO " . TBL_FORMANS . " (account_id, gender, role_select, passion, m_concentration, m_cooperation, l_goal, l_prioritize, p_achieve, p_precedence, r_contact, r_tool) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("プリペアドステートメントの準備に失敗しました: " . $conn->error);
        }
        $stmt->bind_param("iissiiiiiiii", $account_id,  $gender, $roles_json, $passion, $concentration, $cooperation, $goal, $prioritize, $achieve, $precedence, $contact, $tool);

        // プリペアドステートメントを実行
        if (!$stmt->execute()) {
            throw new Exception("データベースエラー: " . $stmt->error);
        }

        // 成功した場合
        $error_message = "データが正常に登録されました";
        $stmt->close();
    } catch (mysqli_sql_exception $e) {
        $error_message = "データ登録に失敗されました";
        if ($e->getCode() == 1062) {
            $error_message = '既に登録されています';
        } else {
            // エラーメッセージの表示
            $error_message = "エラー: " . $e->getMessage();
        }
    } catch (Exception $e) {
        $error_message = "データ登録に失敗されました";
        // エラーメッセージの表示
        $error_message = "エラー: " . $e->getMessage();
    }

    // データベースとの接続を閉じる
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/main.css">
    <title>formDone</title>
</head>

<body>
    <h2>完了しました</h2>
    <?php
    // echo $error_message
    ?>
    <a href="main.php"><button>戻る</button></a>
</body>

</html>