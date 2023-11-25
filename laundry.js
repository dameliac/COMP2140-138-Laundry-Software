document.addEventListener("DOMContentLoaded", function() {
    const menu = document.getElementById("menu");
    const side = document.getElementById("sidebar")
    const close = document.getElementById("close")
    const menuItem = document.querySelectorAll(".sideLinks a")
    const menuList = new XMLHttpRequest();
    const schedule = new XMLHttpRequest();
    const dynamic = document.getElementById("dynamic");
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

                menuItemers[0].addEventListener("click",function(event){
                    event.preventDefault()
                    schedule.onreadystatechange = scheduleDynam;
                    schedule.open("GET","reservations.php",true);
                    schedule.send();
                    menuItemers.forEach(item => item.classList.remove('selected'));
                    menuItemer.forEach(item => item.classList.remove('selected'));
                    menuItemer[0].classList.toggle("selected");
                    menuItemers[0].classList.toggle("selected");

                })

                menuItemers[3].addEventListener("click",function(event){
                    event.preventDefault();
                    getPage("maintenance.html");
                    menuItemers.forEach(item => item.classList.remove('selected'));
                    menuItemer.forEach(item => item.classList.remove('selected'));
                    menuItemer[3].classList.toggle("selected");
                    menuItemers[3].classList.toggle("selected");
                })

                closers = document.getElementById("close");
                sider = document.getElementById("sidebar");
                if(currLocation.includes("base.html")){
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

    function scheduleDynam(){
        if (schedule.readyState === XMLHttpRequest.DONE){
            if (schedule.status === 200){
                let scheduletimes = schedule.responseText;
                dynamic.innerHTML = scheduletimes;

                const timeSlots = document.querySelectorAll(".timeSlot");
                timeSlots.forEach( slot => {
                    slot.addEventListener("click",function(){
                        const fixed = this;
                        let timeSlot = this.textContent.trim();
                        
                        //Find the span element to determine which machine in the database's timeslot
                        let machineFinder = findMachineElement(this);
                        let machine = machineFinder.querySelector('span').textContent;
                        
                        let timeRequest = new XMLHttpRequest();
                        timeRequest.open('POST','timeSlot.php',true);
                        timeRequest.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                        
                        timeRequest.onreadystatechange = function(){
                            if (timeRequest.readyState === XMLHttpRequest.DONE){
                                if (timeRequest.status===200){
                                    let scheduler = timeRequest.responseText;
                                    if (scheduler=="success"){
                                        alert("Timeslot Reserved")
                                        fixed.classList.add('selected');
                                    }

                                    else if (scheduler =="unavailable"){
                                        alert("Timeslot Not Available");
                                    }
                                    else if(scheduler="limited"){
                                        alert("Timeslot Reservation Limit Reached")
                                    }
                                    else{
                                        console.log(scheduler);
                                        alert("Failed To Reserve Timselot.");
                                    }
                                }
                                else{
                                    alert("Error Occured");
                                }
                            }

                        };

                        let data = "timeslot=" + encodeURIComponent(timeSlot) +"&machine=" + encodeURIComponent(machine);
                        timeRequest.send(data);
                        

                    })    
                });
            }
        }
    }

    menuList.onreadystatechange = menuLister;
    menuList.open("GET", "userBind.php", true);
    menuList.send();


    schedule.onreadystatechange = scheduleDynam;
    schedule.open("GET","reservations.php",true);
    schedule.send();



    function slideBar(){
        side.style.left = "0";
    }



    menu.addEventListener("click",slideBar)

    function getPage(url){
        fetch(url)
            .then(response => response.text())
            .then(html=>{
                document.getElementById('dynamic').innerHTML = html;
            })
    }


    function findMachineElement(element) {
    while (element && !element.querySelector('span')) {
        element = element.previousElementSibling;
    }
    return element;
    }



});




function updateLocalTime(){
    const timeNow = new Date();
    const current = timeNow.toLocaleString();

    document.getElementById("currTime").textContent = current;
}

setInterval(updateLocalTime,1000);



