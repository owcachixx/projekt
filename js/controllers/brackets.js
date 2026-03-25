function checkWinner(match) {
    const score1 = parseInt(match.dataset.score1);
    const score2 = parseInt(match.dataset.score2);

    const participants = match.querySelectorAll('.participant');

    participants.forEach(p => p.classList.remove('winner'));

    if (score1 === 5) {
        participants[0].classList.add('winner');
    } else if (score2 === 5) {
        participants[1].classList.add('winner');
    }
}
function checkAllWinners() {
    const matches = document.querySelectorAll('.matchup');

    matches.forEach(match => {
        checkWinner(match);
    });
}
