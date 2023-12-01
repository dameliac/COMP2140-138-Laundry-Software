// Initialize default products and quantities
var inventory = [
    { productName: 'Bleach', quantity: 100 },
    { productName: 'Detergent', quantity: 100 },
    { productName: 'Dryer Sheets', quantity: 100 },
    { productName: 'Fabric Softener', quantity: 100 }
];

// Function to populate the initial table
function populateTable() {
    var table = document.getElementById("inventoryTable");
    var tbody = table.getElementsByTagName("tbody")[0];

    inventory.forEach(function(product) {
        var newRow = tbody.insertRow(tbody.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        cell1.innerText = product.productName;
        cell2.innerText = product.quantity;
    });
}

// Function to update inventory based on form input
function updateInventory() {
    var productName = document.getElementById("productName").value;
    var cyclesUsed = parseInt(document.getElementById("cyclesUsed").value);

    if (productName && !isNaN(cyclesUsed)) {
        // Check if the product already exists in the inventory
        var found = false;

        for (var i = 0; i < inventory.length; i++) {
            if (inventory[i].productName.toLowerCase() === productName.toLowerCase()) {
                found = true;
                // Update the quantity
                inventory[i].quantity += cyclesUsed;
                break;
            }
        }

        // If the product is not in the inventory, add a new entry
        if (!found) {
            inventory.push({ productName: productName, quantity: cyclesUsed });
        }

        // Update the table
        updateTable();

        // Clear the form
        document.getElementById("inventoryForm").reset();
        toggle();
    } else {
        alert("Please enter valid data.");
    }
}

// Function to update the table based on the current inventory
function updateTable() {
    var table = document.getElementById("inventoryTable");
    var tbody = table.getElementsByTagName("tbody")[0];

    // Clear the table
    tbody.innerHTML = "";

    // Populate the table with the updated inventory
    inventory.forEach(function(product) {
        var newRow = tbody.insertRow(tbody.rows.length);
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        cell1.innerText = product.productName;
        cell2.innerText = product.quantity;
    });
}

function toggle(){
    let blurcontent =document.getElementById("display");
    blurcontent.classList.toggle('active');
    let popup =document.getElementById("form");
    popup.classList.toggle('active');
    
    //document.getElementsByClassName("container2")[0].style.display ="block";

}

// Call populateTable when the script loads
populateTable();
