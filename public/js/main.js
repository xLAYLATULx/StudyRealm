var sHours = document.getElementById('sessionHours');
var sMinutes = document.getElementById('sessionMinutes');
var sSeconds = document.getElementById('sessionSeconds');
var bMinutes = document.getElementById('breakMinutes');
var bSeconds = document.getElementById('breakSeconds');
var cycle = document.getElementById('cycle');
var start = document.getElementById('start');
var pause = document.getElementById('pause');
var reset = document.getElementById('reset');
var startTimer;
var sessionAlert = false;
var sHours1;
var sMinutes1;
var sSeconds1;
var bMinutes1;
var bSeconds1;
var cycle1;
ringtone = new Audio('../assets/audio/alarm-ringtone-short.mp4');

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
        if (sessionAlert == false) {
            ringtone.play();
            alert("Session time is over!");
            sessionAlert = true;
        }
        if (bSeconds.value != 0 && sessionAlert == true) {
            ringtone.stop();
            bSeconds.value--;
        } else if (bMinutes.value != 0 && bSeconds.value == 0) {
            bMinutes.value--;
            bSeconds.value = 59;
        } else if (bMinutes.value == 0 && bSeconds.value == 0) {
            clearInterval(startTimer);
            ringtone.play();
            alert("Break time is over!");
        }
    }
    if (sHours.value == 0 && sMinutes.value == 0 && sSeconds.value == 0 && bMinutes.value == 0 && bSeconds.value == 0) {
        if (cycle1 > 1) {
            cycle1--;
            sHours.value = sHours1;
            sMinutes.value = sMinutes1;
            sSeconds.value = sSeconds1;
            bMinutes.value = bMinutes1;
            bSeconds.value = bSeconds1;
            cycle.value = cycle1;
            alert("Cycle is over! Starting new cycle.");
        } else {
            clearInterval(startTimer);
            ringtone.play();
            alert("All cycles completed!");
        }
    }
}

function pauseTimer() {
    clearInterval(startTimer);
}

start.addEventListener('click', function () {
    if (startTimer === undefined) {
        sHours1 = sHours.value;
        sMinutes1 = sMinutes.value;
        sSeconds1 = sSeconds.value;
        bMinutes1 = bMinutes.value;
        bSeconds1 = bSeconds.value;
        cycle1 = cycle.value;
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
