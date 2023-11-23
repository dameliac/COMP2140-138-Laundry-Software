function openMaintenanceForm() {
    document.getElementById("maintenance-form").style.display = "block";
}

function submitForm() {
    // You can add logic here to send the maintenance request to the server/database.
    // For this example, we'll just show a confirmation message.
    document.getElementById("requestForm").style.display = "none";
    document.getElementById("confirmationMessage").style.display = "block";
}
