    /*
     * Post the machine 1 span to update handler that checks 
     * database for status and changes status returning the 
     * text red or green to change the image displayed in machine status
     * based on the database change
     */
    function machineStatusChange(event) {
        event.preventDefault(); 
        fetch('MachineStatusUpdateHandler.php', {
            method: 'POST',
            body: new FormData(event.target),
        })
            .then(response => response.text())
            .then(data => {
        console.log('Response:', data);
        const selectElement = event.target.querySelector('select');
        const selectedOptionText = selectElement.options[selectElement.selectedIndex].text;

        console.log('Selected Option:', selectedOptionText);
        const correspondingSpan = findSpanByTextContent(selectedOptionText);
        const parentDiv = correspondingSpan.parentElement;
        const machineImage = parentDiv.querySelector('img');
        if (data.includes('red')) {
            correspondingSpan.parentElement.classList.remove('Available');
            machineImage.src = "img/washingred.png";
        } else if(data.includes("green")) {
            correspondingSpan.parentElement.classList.add('Available');
            machineImage.src = "img/washing.png";
        }
        else{
            console.log(data);
        }
        })
    }
        //find the machnine span that is equivalent to the selection text content
        function findSpanByTextContent(textContent) {
            const machineSpans = document.querySelectorAll('.Machine span');
            for (const span of machineSpans) {
                if (span.textContent === textContent) {
                    return span;
                }
            }
            return null;
        }
    