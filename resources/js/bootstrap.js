import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let lastScan = null;

function onScanSuccess(decodedText) {

    if (decodedText === lastScan) return;
    lastScan = decodedText;

    let audio = new Audio('https://www.soundjay.com/buttons/sounds/button-3.mp3');
    audio.play();

    fetch('/scan/' + decodedText)
        .then(res => res.text())
        .then(data => {
            document.getElementById('result').innerText = data;
        });

    // reset biar bisa scan lagi
    setTimeout(() => {
        lastScan = null;
    }, 2000);
}