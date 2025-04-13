"use strict";

document.addEventListener('readystatechange', event => {
    if (event.target.readyState === "complete") {
        const clockdivs = document.getElementsByClassName("clockdiv");
        const countdownData = [];

        for (let i = 0; i < clockdivs.length; i++) {
            countdownData.push({
                el: clockdivs[i],
                time: new Date(clockdivs[i].getAttribute('data-date')).getTime(),
                days: 0,
                hours: 0,
                minutes: 0,
                seconds: 0
            });
        }

        const countdownFunction = setInterval(() => {
            let allCountdownsComplete = true;

            for (let i = 0; i < countdownData.length; i++) {
                const now = new Date().getTime();
                const distance = countdownData[i].time - now;

                countdownData[i].days = Math.floor(distance / (1000 * 60 * 60 * 24));
                countdownData[i].hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                countdownData[i].minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                countdownData[i].seconds = Math.floor((distance % (1000 * 60)) / 1000);

                if (distance < 0) {
                    countdownData[i].el.querySelector('.days').innerHTML = 0;
                    countdownData[i].el.querySelector('.hours').innerHTML = 0;
                    countdownData[i].el.querySelector('.minutes').innerHTML = 0;
                    countdownData[i].el.querySelector('.seconds').innerHTML = 0;
                } else {
                    allCountdownsComplete = false;
                    countdownData[i].el.querySelector('.days').innerHTML = countdownData[i].days;
                    countdownData[i].el.querySelector('.hours').innerHTML = countdownData[i].hours;
                    countdownData[i].el.querySelector('.minutes').innerHTML = countdownData[i].minutes;
                    countdownData[i].el.querySelector('.seconds').innerHTML = countdownData[i].seconds;
                }
            }

            if (allCountdownsComplete) {
                clearInterval(countdownFunction);
            }
        }, 1000);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const countdownElement = document.getElementById('countdown2');

    if (countdownElement) {
        const targetDate = countdownElement.getAttribute('data-date');
        const targetTime = countdownElement.getAttribute('data-time');
        const targetDateTime = new Date(`${targetDate} ${targetTime}`);

        function updateCountdown() {
            const now = new Date();
            const timeDifference = targetDateTime - now;

            if (timeDifference <= 0) {
                countdownElement.innerHTML = '<h3>Event has started!</h3>';
                return;
            }

            const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            countdownElement.querySelector('.day .num').textContent = days;
            countdownElement.querySelector('.day .word').textContent = days === 1 ? 'Day' : 'Days';

            countdownElement.querySelector('.hour .num').textContent = hours;
            countdownElement.querySelector('.hour .word').textContent = hours === 1 ? 'Hour' : 'Hours';

            countdownElement.querySelector('.min .num').textContent = minutes;
            countdownElement.querySelector('.min .word').textContent = minutes === 1 ? 'Minute' : 'Minutes';

            countdownElement.querySelector('.sec .num').textContent = seconds;
            countdownElement.querySelector('.sec .word').textContent = seconds === 1 ? 'Second' : 'Seconds';
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    }
});