//Duración de la oferta en días, horas, minutos y segundos
const duracionOferta = {
    days: 2,
    hours: 20,
    minutes: 0,
    seconds: 0,
};

function countdownTimer(days, hours, minutes, seconds) {
    const temporizadorElement = document.getElementById("temporizador");
    const temporizadorElementMobile = document.getElementById("temporizadorMobile");
    if (temporizadorElement === null || temporizadorElementMobile === null) {
        return;
    }

    let tiempoRestante = ((days * 24 + hours) * 60 + minutes) * 60 + seconds; // Convertir todo a segundos
    let intervalo;

    // Función para formatear el tiempo en dígitos de dos cifras
    function formatTime(time) {
        return time < 10 ? `0${time}` : `${time}`;
    }

    // Función para actualizar el temporizador
    function updateTemporizador() {
        const remainingDays = Math.floor(tiempoRestante / (60 * 60 * 24));
        const remainingHours = Math.floor(
                (tiempoRestante % (60 * 60 * 24)) / (60 * 60)
                );
        const remainingMinutes = Math.floor((tiempoRestante % (60 * 60)) / 60);
        const remainingSeconds = Math.floor(tiempoRestante % 60);

        temporizadorElement.innerHTML = `${formatTime(
                remainingDays
                )} días ${formatTime(remainingHours)} Hrs ${formatTime(
                remainingMinutes
                )} Min ${formatTime(remainingSeconds)} Seg`;
        temporizadorElementMobile.innerHTML = `${formatTime(
                remainingDays
                )} días ${formatTime(remainingHours)} Hrs ${formatTime(
                remainingMinutes
                )} Min ${formatTime(remainingSeconds)} Seg`;

        if (tiempoRestante <= 0) {
            clearInterval(intervalo);
            // Reiniciar el temporizador a 1 día y 20 horas
            countdownTimer(2, 20, 0, 0);
        } else {
            tiempoRestante--;
        }
    }
    intervalo = setInterval(updateTemporizador, 1000);
}

countdownTimer(
        duracionOferta.days,
        duracionOferta.hours,
        duracionOferta.minutes,
        duracionOferta.seconds
        );
