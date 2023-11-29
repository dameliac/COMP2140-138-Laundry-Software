    function machineStatusChange(event) {
        event.preventDefault(); 
        fetch('status.php', {
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
        const commentSection = parentDiv.querySelector('.commentSection');
        const machineImage = parentDiv.querySelector('img');
        if (data.includes('red')) {
            correspondingSpan.parentElement.classList.remove('Available');
            machineImage.src = "washingred.png";
            commentSection.style.display = "flex";
        } else {
            correspondingSpan.parentElement.classList.add('Available');
            machineImage.src = "washing.png";
            commentSection.style.display = "none";
        }
        })
    }


        function submitComment(machineNumber) {
            var commentSection = document.querySelector('.commentSection[data-machine-number="' + machineNumber + '"]');
            var commentsDisplay = commentSection.querySelector('.commentsDisplay');
            var commentsTextarea = commentSection.querySelector('textarea');
            var commentText = commentsTextarea.value;
            commentsDisplay.innerHTML += '<p>' + commentText + '</p>';
            commentsTextarea.value = '';
        }


        function findSpanByTextContent(textContent) {
            const machineSpans = document.querySelectorAll('.Machine span');
            for (const span of machineSpans) {
                if (span.textContent === textContent) {
                    return span;
                }
            }
            return null;
        }
    