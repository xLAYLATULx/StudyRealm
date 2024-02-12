var sHours = document.getElementById('sessionHours');
var sMinutes = document.getElementById('sessionMinutes');
var sSeconds = document.getElementById('sessionSeconds');
var bMinutes = document.getElementById('breakMinutes');
var bSeconds = document.getElementById('breakSeconds');
var start = document.getElementById('start');
var pause = document.getElementById('pause');
var reset = document.getElementById('reset');
var startTimer;

function timer() {
    if (sSeconds.value != 0) {
        sSeconds.value--;
    } else if (sMinutes.value != 0 || sHours.value != 0) {
        if (sMinutes.value == 0 && sHours.value != 0) {
            sMinutes.value = 59;
            sHours.value--;
        } else if (sMinutes.value != 0 && sSeconds.value == 0) {
            sSeconds.value = 59;
            sMinutes.value--;
        }
    }
    if (sHours.value == 0 && sMinutes.value == 0 && sSeconds.value == 0) {
        alert("Session time is over!");
        if (bSeconds.value != 0) {
            bSeconds.value--;
        } else if (bMinutes.value != 0 && bSeconds.value == 0) {
            bMinutes.value--;
            bSeconds.value = 59;
        
        } else if (bMinutes.value == 0 && bSeconds.value == 0) {
            clearInterval(startTimer);
            alert("Break time is over!");
        }
    }
}


function pauseTimer() {
    clearInterval(startTimer);
}

start.addEventListener('click', function () {
    if (startTimer === undefined) {
        startTimer = setInterval(timer, 1000);
    } else {
        alert("Timer is already running");
    }
});

reset.addEventListener('click', function () {
    sHours.value = 0;
    sMinutes.value = 25;
    sSeconds.value = 0;

    bMinutes.value = 5;
    bSeconds.value = 0;

    pauseTimer();
    startTimer = undefined;
});

pause.addEventListener('click', function () {
    pauseTimer()
    startTimer = undefined;
});