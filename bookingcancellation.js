// function confirmCancellation(){
//     var confirmationMessage = confirm ("Are you sure you want to cancel?");

//     if (confirmationMessage){
//         cancelBooking();
//     }
//         else {
//             alert("Reservation is cancelled");
//         }
// } 

window.addEventListener("load", (event) => {
    const Form= document.querySelector("form");
    const msg= document.querySelector(".message");

    Form.addEventListener("submit", function(e){
        e.preventDefault();

        // const emailadd= document.getElementById("email").value; 
        const bookingID = document.getElementById("bookingID").value;
        
        if (bookingID !== "") {
            msg.textContent = "Are you sure you want to cancel?";

            // bookingID.value = "";
            document.getElementById("bookingID").value = "";
        }
        else {
            msg.textContent = "Reservation is cancelled";
        }
    });
});