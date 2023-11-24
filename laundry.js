document.addEventListener("DOMContentLoaded", function() {
    const timeSlots = document.querySelectorAll(".timeSlot");
    const menu = document.getElementById("menu");
    const side = document.getElementById("sidebar")
    const close = document.getElementById("close")
    const menuItems = document.querySelectorAll(".sideLinks");
    const menuItem = document.querySelectorAll(".sideLinks a")
    let currLocation = window.location.pathname;
    
    
    if(currLocation == "/base.html"){
        menuItems[0].classList.toggle('selected');
        menuItem[0].classList.toggle('selected')
    }

    function slideBar(){
        side.style.left = "0";
    }

    function closer(){
        side.style.left ="-300px";
    }

    menu.addEventListener("click",slideBar)

    close.addEventListener("click",closer)
    timeSlots.forEach( slot => {
        slot.addEventListener("click",function(){
            this.classList.toggle('selected');
            
            //const selectedSlots = Array.from(timeSlots).filter(slot => slot.classList.contains('selected')).map()
        })    
    });
});




function updateLocalTime(){
    const timeNow = new Date();
    const current = timeNow.toLocaleString();

    document.getElementById("currTime").textContent = current;
}

setInterval(updateLocalTime,1000);



