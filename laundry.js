function updateLocalTime(){
    const timeNow = new Date();
    const current = timeNow.toLocaleString();

    document.getElementById("currTime").textContent = current;
}

setInterval(updateLocalTime,1000);
