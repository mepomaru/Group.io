document.getElementById("addButton").addEventListener("click", function () {
    // テキスト入力フィールドを追加するコンテナを取得
    var container = document.getElementById("textContainer");

    // 新しいテキスト入力フィールドの作成
    var newInput = document.createElement("input");
    newInput.type = "text";
    newInput.name = "dynamicInput[]";

    // 新しいテキスト入力フィールドをコンテナの最後に追加
    container.appendChild(newInput);
});
