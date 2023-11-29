function openMaintenanceForm() {
    document.getElementById("maintenance-form").style.display = "block";
}

function submitForm() {
    const issueDescription = document.getElementById('issue').value;

    fetch('/submit-request',{
        method: 'POST',
        headers:{
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({issue: issueDescription}),
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucess){
            document.getElementById("requestForm").style.display = "none";
            document.getElementById("confirmationMessage").style.display = "block";
        } else{
            console.error('Error submitting request:', data.error);
        }
    })
    .catch(error => {
        console.error('Error submitting request:', error);
    })
    
}
