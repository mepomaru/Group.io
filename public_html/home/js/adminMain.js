document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.delete-button');
    const createTeamButton = document.querySelectorAll('.create-team-button');

    // ユーザー削除ボタンのイベントリスナー
    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            const userId = row.children[0].textContent;

            if (confirm(`ユーザーID ${userId} を削除してもよろしいですか？`)) {
                console.log(`ユーザーID ${userId} を削除しました。`);
                // 行を削除する
                row.remove();
            }
        });
    });

    // チーム作成ボタンのイベントリスナー
    createTeamButton.addEventListener('click', () => {
        // 別ページに遷移
        window.location.href = 'userList.php';
    });
});
