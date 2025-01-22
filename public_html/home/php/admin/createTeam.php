<!-- インポート -->
<!-- 
    composer require google-gemini-php/client
    composer require guzzlehttp/guzzle 
    composer require symfony/http-client  
-->

<?php
session_start(); // セッションの開始

//importみたいなやつ
include '../../../../data/AI/vendor/autoload.php';
include '../../../../data/def/def.php';
include '../../../../data/def/rules.php';

use Gemini\Data\Content;
use Gemini\Enums\Role;

// 確認画面で表示するための結果
$result = [
    "status" => true,   // エラーの有無
    "username" => null, // 完成時に名前を表示
    "password" => null, // 完成時のパスワードを表示
    "errmsg" => null    // エラー時のメッセージ
];

//AIレスポンス時間180に設定
ini_set('max_execution_time', '180');

//APIキー取得(defから取得)
$client = Gemini::Client(GEMINI_KEY);


$member_rules = "5";
$team_rules = "16";


$chat = $client->generativeModel('gemini-1.5-flash')->startChat(history: [
    Content::parse(part: $motivation_rule, role: Role::MODEL)
]);

try {
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
    $conn = new PDO($dsn, DB_USER, DB_PASS);

    // PDOの動作オプションを指定
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    //memberテーブルを削除
    $delete_sql = "DELETE FROM member";
    $stmt = $conn->query($delete_sql);

    //motivationを取得
    $motivation_sql = "SELECT passion FROM formAnswer";
    $stmt = $conn->query($motivation_sql);

    //データの件数を取得
    $num = $stmt->rowCount();

    for ($i = 1; $i <= $num; $i++) {
        $useid = 'userid' . $i;
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        //$passionをjsonに入れる
        $passion = $data['passion'];
        $userData["$useid"]["passion"] = $passion;
    }

    //json型にencode
    $userpassion = json_encode($userData, JSON_UNESCAPED_UNICODE);

    //判定がバグる"！"を排除
    $replacepassion = replace($userpassion, ['！', '!']);

    //AIに投げます
    $response = $chat->sendMessage($replacepassion);

    //返答を取得します
    $text_json = $response->text();

    //```jsonの削除
    $replace_json2 = replace($text_json, ['```json', '```']);

    //echo ($replace_json2);

    // 追加のvalueを各useridに入れる
    $decoded_json = json_decode($replace_json2, true);

    //選択式のdataを取得
    $sqlform = "SELECT m_concentration, m_cooperation, l_goal, l_prioritize, p_achieve, p_precedence, r_contact, r_tool FROM formAnswer";
    $stmt2 = $conn->query($sqlform);

    foreach ($decoded_json as $key) {
        $data2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        //選択式のmotivationを結合する(小数点切り捨て)
        $key['motivation'] = floor(floor($key['motivation'] + $data2['m_concentration'] * $important4 + $data2['m_cooperation'] * $important3 + $data2['l_goal'] * $important3 + $data2['l_prioritize'] * $important3 + $data2['p_achieve'] * $important3 + $data2['p_precedence'] * $important2 + $data2['r_contact'] * $important1 + $data2['r_tool']) * $important2);
    }


    //motivationを取得
    $sqlform2 = "SELECT role_select FROM formAnswer";
    $stmt3 = $conn->query($sqlform2);

    // //データの件数を取得
    $num = $stmt3->rowCount();

    //roleを各useridに追記する
    for ($i = 1; $i <= $num; $i++) {
        $useid = 'userid' . $i;
        $data = $stmt3->fetch(PDO::FETCH_ASSOC);

        $role = $data['role_select'];
        $decoded_json[$useid]['role'] = $role;
    }

    //json型にencode
    $userrole = json_encode($decoded_json, JSON_UNESCAPED_UNICODE);
    $build_rules = build_rules($member_rules,$team_rules);

    $chat2 = $client->generativeModel('gemini-1.5-flash')->startChat(history: [
        Content::parse(part: $build_rules, role: Role::MODEL)
    ]);

    $response2 = $chat2->sendMessage($userrole);

    //返答を取得します
    $res_json2 = $response2->text();

    $json_str = replace($res_json2, ['```json', '```']);
    
    //echo ($json_str);

    $sqlname2 = "INSERT INTO member (team_no,account_id) VALUE";

    // 返答をデコード
    $decoded_data = json_decode($json_str, true);

    //teamの要素を全件取得
    $keys = array_keys($decoded_data);
    
    
    //teamごとにuserを全件取得
    foreach ($keys as $key) {
        $userInfo = $decoded_data[$key];
        $user_keys = array_keys($userInfo); 
        $userid = json_encode($user_keys[0], JSON_UNESCAPED_UNICODE);
        //valueを再宣言   
        $insert = "";
        //account_idを全件取得
        foreach ($user_keys as $user_key){
            $rep_team = replace_team($key,['team']);
            $rep_user = replace_userid($user_key, ['userid']);
            
            $insert = $insert.("($rep_team,$rep_user),");
        }
        //最後のカンマを削除
        $insert = substr($insert, 0, -1);
        //SQLを作成(最後に；を入れる)
        $insert_sql = $sqlname2.$insert.";";
        //実行
        $stmt = $conn->query($insert_sql);
    
        echo($insert_sql);
        
    }    
    
} catch (Exception $e) {
    $result["status"] = false;
    $result["errmsg"] = $e->getMessage();
    echo($result["errmsg"]);
    //header("Location: ./userList.php");
}

/**
 * jsonの無駄な部分排除
 * @param mixed $text_json
 * @param mixed $targets
 * @return array|string
 */
function replace($text_json, $targets = ['！', '!', '```json', '```'])
{
    return str_replace($targets, '', $text_json);
}

function replace_team($team, $targets = ['team']){
    return str_replace($targets, '', $team);
}

function replace_userid($team, $targets = ['userid']){
    return str_replace($targets, '', $team);
}