document.addEventListener("DOMContentLoaded", function() {
    const timeSlots = document.querySelectorAll(".timeSlot");
    const menu = document.getElementById("menu");
    const side = document.getElementById("sidebar")
    const close = document.getElementById("close")
    const menuItems = document.querySelectorAll(".sideLinks");
    const menuItem = document.querySelectorAll(".sideLinks a")
    const menuList = new XMLHttpRequest();
    let currLocation = window.location.pathname
    let menuItemer;
    let menuItemers;
    let sider;
    
    
    function menuLister(){
        if (menuList.readyState === XMLHttpRequest.DONE){
            if (menuList.status === 200){
                let menuItemz = menuList.responseText;
                side.innerHTML = menuItemz; 
                menuItemer = document.querySelectorAll(".sideLinks");
                menuItemers = document.querySelectorAll(".sideLinks a");
                closers = document.getElementById("close");
                sider = document.getElementById("sidebar");
                if(currLocation == "/groupproj/COMP2140-138-Laundry-Software/base.html"){
                    menuItemer[0].classList.toggle('selected');
                    menuItemers[0].classList.toggle('selected');
                }            
                function closer(){
                    sider.style.left ="-300px";
                }
                closers.addEventListener("click",closer);
            }
            else{
                alert("A mistake was made with the code.");
            }
        }
    }

    menuList.onreadystatechange = menuLister;
    menuList.open("GET", "userBind.php", true);
    menuList.send();



    function slideBar(){
        side.style.left = "0";
    }



    menu.addEventListener("click",slideBar)


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



