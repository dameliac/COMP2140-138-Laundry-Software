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
    const daysOfWeek = {
        "Sunday": 0,
        "Monday": 1,
        "Tuesday": 2,
        "Wednesday": 3,
        "Thursday": 4,
        "Friday": 5,
        "Saturday": 6
      };
      
    
    
    function menuLister(){
        if (menuList.readyState === XMLHttpRequest.DONE){
            if (menuList.status === 200){
                let menuItemz = menuList.responseText;
                side.innerHTML = menuItemz; 

                menuItemer = document.querySelectorAll(".sideLinks");
                menuItemers = document.querySelectorAll(".sideLinks a");
                
                menuItemers.forEach((item, index) => {
                    item.addEventListener("click", function (event) {
                      event.preventDefault();
                      handleMenuItemClick(item,index);
                    });
                  });

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
                handleBasePage();
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
                setupEventListeners();
            }
        }
    }

    menuList.onreadystatechange = menuLister;
    menuList.open("GET", "RoleManagement.php", true);
    menuList.send();






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

    function handleBasePage(){
        const menuItemer = document.querySelectorAll(".sideLinks");
        switch (menuItemer[0].children[0].textContent) {
          case "Reservation Schedule":
            schedule.onreadystatechange = scheduleDynam;
            schedule.open("GET","MachineBooking.php",true);
            schedule.send();        
            break;
          case "Ticket Overview":
            getPage("TicketGenerator.php"); 
            break;
          default:
            getPage("MaintenanceRequestView.php")
            break;
        }
    }


    function handleMenuItemClick(clickedItem,selection) {
        const menuItemer = document.querySelectorAll(".sideLinks");
        menuItemer.forEach((item) => item.classList.remove("selected"));
        menuItemer.forEach((item) => item.children[0].classList.remove("selected"));
        clickedItem.parentElement.classList.add("selected");
        clickedItem.classList.add("selected");
 
        switch (menuItemer[0].children[0].textContent) {
          case "Reservation Schedule":
            handleResidentAction(selection);
            break;
          case "Ticket Overview":
            handleStaffAction(selection);
            break;
          default:
            handleMaintenanceAction(selection);
            break;
        }
      }

      function handleResidentAction(action) {
        switch (action) {
          case 0:
            schedule.onreadystatechange = scheduleDynam;
            schedule.open("GET","MachineBooking.php",true);
            schedule.send();
            break;
          case 1:
            getPage("WaitlistDisplay.php");
            break;
          case 2:
            getPage("TicketGenerator.php");
            break;
          case 3:
            getPage("MaintenanceRequest.php");
            break;
          case 4:
            getPage("BookingCancellation.php");
            break;
        }
      }

      function handleMaintenanceAction(action){
        switch(action){
            case 0:
                getPage("MaintenanceRequestView.php");
                break;
            case 1:
                getPage("MachineStatusUpdate.php");
                break;
        }
      }

      function handleStaffAction(action){
        switch(action){
            case 0:
                getPage("TicketGenerator.php")
                break;
            case 1:
                getPage("MaintenanceRequest.php");
                break;
        }
      }


      function setupEventListeners() {
        const days = document.querySelectorAll(".days");
        days.forEach(day => {
            day.addEventListener("click", function () {
                let dayName = this.textContent.trim();
                let dayNumber = daysOfWeek[dayName];
                const scheduleRequest = new XMLHttpRequest();
                scheduleRequest.open('POST', 'MachineBooking.php', true);
                scheduleRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                scheduleRequest.onreadystatechange = function () {
                    if (scheduleRequest.readyState === XMLHttpRequest.DONE) {
                        if (scheduleRequest.status === 200) {
                            let scheduletimes = scheduleRequest.responseText;
                            console.log(scheduletimes);
                            dynamic.innerHTML = scheduletimes;
                            setupEventListeners(); // Re-attach event listeners
                        } else {
                            alert("Error Occurred");
                        }
                    }
                };
                let datas = "selectedDay=" + encodeURIComponent(dayNumber);
                scheduleRequest.send(datas);
            });
        });
    
        const timeSlots = document.querySelectorAll(".timeSlot");
        timeSlots.forEach(slot => {
            slot.addEventListener("click", function () {
                const fixed = this;
                let timeSlot = this.textContent.trim();
    
                //Find the span element to determine which machine in the database's timeslot
                let machineFinder = findMachineElement(this);
                let machine = machineFinder.querySelector('span').textContent;
    
                let timeRequest = new XMLHttpRequest();
                timeRequest.open('POST', 'MachineBookingHandler.php', true);
                timeRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
                timeRequest.onreadystatechange = function () {
                    if (timeRequest.readyState === XMLHttpRequest.DONE) {
                        if (timeRequest.status === 200) {
                            let scheduler = timeRequest.responseText;
                            if (scheduler == "success") {
                                alert("Timeslot Reserved")
                                fixed.classList.add('selected');
                            } else if (scheduler == "unavailable") {
                                alert("Timeslot Not Available");
                            } else if (scheduler = "limited") {
                                alert("Timeslot Reservation Limit Reached")
                            } else {
                                console.log(scheduler);
                                alert("Failed To Reserve Timeslot.");
                            }
                        } else {
                            alert("Error Occurred");
                        }
                    }
                };
    
                let data = "timeslot=" + encodeURIComponent(timeSlot) + "&machine=" + encodeURIComponent(machine);
                timeRequest.send(data);
            });
        });
    }

});




function updateLocalTime(){
    const timeNow = new Date();
    const current = timeNow.toLocaleString();

    document.getElementById("currTime").textContent = current;
}

setInterval(updateLocalTime,1000);



