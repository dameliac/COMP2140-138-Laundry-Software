window.onload = function() {
  // Sample waitlist data with timestamps and days
  const waitlistData = [
    { name: "John Doe", daysAvailable: ["Monday", "Wednesday", "Sunday"], status: "Active", Machine:"1", ticket:"B34" },
    { name: "Jane Smith",  daysAvailable: ["Tuesday", "Thursday"] , status: "Pendiing", Machine: "2", ticket:"C01"},
    { name: "Bob Johnson", daysAvailable: ["Monday", "Friday"], status: "Pending",  Machine: "1", ticket:"E104" },
    {name: "Sharian Johnson", daysAvailable:["Thursday", "Friday", "Saturday"],status: "Active", Machine: "5", ticket:"F04" },
    {name: "David Malcolm", daysAvailable:["Wednesday", "Friday", "Sunday"], status: "Pending", Machine: "4", ticket:"C05" },
    {name: "Ashleigh McLean", daysAvailable:["Mondayday", "Tuesday", "Saturday"], status: "Pending", Machine: "6", ticket: "A105"},
    {name: "Tajeka Johnson", daysAvailable:["Thursday", "Friday", "Saturday"], status: "Active", Machine: "3", ticket: "B65"},
    {name: "Hosea Nicols", daysAvailable:["Sunday", "Friday", "Saturday"], status: "Pending", Machine: "5",ticket: "A99"},
    // Add more names with timestamps and days as needed
  ];

  // Get the current day
  const currentDay = getCurrentDay();

  // Get the waitlist container
  const servingContainer = document.getElementById("serving");
  const waitlistContainer = document.getElementById("Waitlist");

  // Filter and populate the waitlist for the current day
  waitlistData.forEach((item) => {
    if(item.daysAvailable.includes(currentDay))
        if (item.status === "Active"){
       
            nowServing(item.name, item.status, item.Machine, item.ticket);
        }
        else if (item.status === "Pending"){
            addWaitlistItem(item.name, item.Machine, item.status, item.ticket)
        }
    });

  // Function to add an item to the waitlist
  function nowServing ( name,status, machine, ticknum){
    const row = servingContainer.insertRow();
    const cellTicket = row.insertCell(0);
    const cellName = row.insertCell(1);
    const cellMachine = row.insertCell(2);
    const cellStatus = row.insertCell(3);
    cellMachine.textContent = machine;
    cellName.textContent = name;
    cellTicket.textContent = ticknum;
    cellStatus.textContent = status;
  }

  function addWaitlistItem(name ,machine, status, ticketnum) {
    const row = waitlistContainer.insertRow(-1);
    const Ticketnum = row.insertCell(0);
    const Name = row.insertCell(1);
    const Machine = row.insertCell(2);
    const Status = row.insertCell(3);
    Name.textContent = name;
    Machine.textContent = machine;
    Status.textContent = status;
    Ticketnum.textContent = ticketnum;

}



  // Function to get the current day
  function getCurrentDay() {
    const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const today = new Date().getDay(); // Returns a number between 0 (Sunday) and 6 (Saturday)
    return daysOfWeek[today];
  }
};
