function createTeams() {
    const teamCount = document.getElementById('teamCount').value;
    const membersPerTeam = document.getElementById('membersPerTeam').value;
    const teamsContainer = document.getElementById('teams');
    teamsContainer.innerHTML = ''; // 既存のチームをクリア

    for (let i = 0; i < teamCount; i++) {
        const teamDiv = document.createElement('div');
        teamDiv.className = 'team';
        teamDiv.innerText = `チーム${String.fromCharCode(65 + i)}`; // チームA、チームB、...

        const membersList = document.createElement('ul');
        for (let j = 0; j < membersPerTeam; j++) {
            const memberItem = document.createElement('li');
            memberItem.innerText = `メンバー${j + 1}`;
            membersList.appendChild(memberItem);
        }
        
        teamDiv.appendChild(membersList);
        teamsContainer.appendChild(teamDiv);
    }
}
