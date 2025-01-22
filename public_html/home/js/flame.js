document.addEventListener('DOMContentLoaded', function () {
    // ボタン要素を取得
    var addButton = document.getElementById('addButton');

    // ボタンがクリックされたときの処理
    addButton.addEventListener('click', function () {
        // 新しいボタン要素を生成
        var newButton = document.createElement('button');
        newButton.textContent = 'New Button';
        newButton.className = 'button'; // スタイルを適用するクラスを追加

        // ボタンコンテナに新しいボタンを追加
        document.getElementById('buttonContainer').appendChild(newButton);
    });
});