<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="">
    <link rel="stylesheet" href="../../css/form.css">
    <title>form</title>
</head>

<body>
    <form id="myForm" method="POST" , action="formDone.php">
        <!-- 性別解答欄 -->
        <div class="box">
            <label for="exchange_std">あなたの性別を解答してください？</label>
            <input type="radio" name="gender" value="male" required>男性
            <input type="radio" name="gender" value="female">女性
            <input type="radio" name="gender" value="notanswered"> 未回答
        </div>
        <br>
        <!-- 役割選択 -->
        <div class="box">
            <label for="roll_select">あなたがしたい役割は何ですか？</label>
            <input type="checkbox" name="roles[]" value="フロントエンド">フロントエンド
            <input type="checkbox" name="roles[]" value="バックエンド">バックエンド
            <input type="checkbox" name="roles[]" value="デザイン">デザイン
        </div>
        <br>
        <!-- 意気込み入力欄 -->
        <div class="box">
            <label for="passion">意気込みを入力してください。</label>
            <textarea id="passion" name="passion" required></textarea>
        </div>
        <br>
        <!-- モチベーション判定質問1 -->
        <div class="box">
            <label for="m_concentration">環境や周囲の影響を受けずに集中できますか？</label>
            <input type="radio" name="m_concentration" value="1" required>できる
            <input type="radio" name="m_concentration" value="2">どちらかといえばできる
            <input type="radio" name="m_concentration" value="3">どちらかといえば出来ない
            <input type="radio" name="m_concentration" value="4">出来ない
        </div>
        <br>
        <!-- モチベーション判定質問2 -->
        <div class="box">
            <label for="m_cooperation">他のメンバーと協力することにやりがいを感じますか？</label>
            <input type="radio" name="m_cooperation" value="1" required>感じる
            <input type="radio" name="m_cooperation" value="2">どちらかといえば感じる
            <input type="radio" name="m_cooperation" value="3">どちらかといえば感じない
            <input type="radio" name="m_cooperation" value="4">感じない
        </div>
        <br>
        <!-- リーダーシップ判定質問1 -->
        <div class="box">
            <label for="l_goal">目標やゴールを設定しますか？</label>
            <input type="radio" name="l_goal" value="1" required>する
            <input type="radio" name="l_goal" value="2">どちらかといえばする
            <input type="radio" name="l_goal" value="3">どちらかといえばしない
            <input type="radio" name="l_goal" value="4">しない
        </div>
        <br>
        <!-- リーダーシップ判定質問2 -->
        <div class="box">
            <label for="l_prioritize">あなたは制作を優先することができますか？</label>
            <input type="radio" name="l_prioritize" value="1" required>できる
            <input type="radio" name="l_prioritize" value="2">どちらかといえばできる
            <input type="radio" name="l_prioritize" value="3">どちらかといえばできない
            <input type="radio" name="l_prioritize" value="4">できない
        </div>
        <br>
        <!-- 計画性判定質問1 -->
        <div class="box">
            <label for="p_achieve">目標を達成するためのステップを具体的に書き出すことがありますか？</label>
            <input type="radio" name="p_achieve" value="1" required>ある
            <input type="radio" name="p_achieve" value="2">どちらかといえばある
            <input type="radio" name="p_achieve" value="3">どちらかといえばない
            <input type="radio" name="p_achieve" value="4">ない
        </div>
        <br>
        <!-- 計画性判定質問2 -->
        <div class="box">
            <label for="p_precedence">あなたは、タスクの優先順位を決めてから仕事に取り掛かることができますか？</label>
            <input type="radio" name="p_precedence" value="1" required>できる
            <input type="radio" name="p_precedence" value="2">どちらかといえばできる
            <input type="radio" name="p_precedence" value="3">どちらかといえばできない
            <input type="radio" name="p_precedence" value="4">できない
        </div>
        <br>
        <!-- 報連相判定質問1 -->
        <div class="box">
            <label for="r_contact">問題や課題が発生したときに、すぐに関係者に連絡する習慣がありますか？</label>
            <input type="radio" name="r_contact" value="1" required>ある
            <input type="radio" name="r_contact" value="2">どちらかといえばある
            <input type="radio" name="r_contact" value="3">どちらかといえばない
            <input type="radio" name="r_contact" value="4">ない
        </div>
        <br>
        <!-- 報連相判定質問2 -->
        <div class="box">
            <label for="r_tool">コミュニケーションツールを積極的に活用していますか？</label>
            <input type="radio" name="r_tool" value="1" required>している
            <input type="radio" name="r_tool" value="2">どちらかといえばしている
            <input type="radio" name="r_tool" value="3">どちらかといえばしていない
            <input type="radio" name="r_tool" value="4">していない
        </div>
        <!--登録ボタン-->
        <div id="registration" class="button-item">
            <button class="registration" type="submit">提出する</button>
        </div>
    </form>
    <script src="../../js/formex.js"></script>
</body>

</html>