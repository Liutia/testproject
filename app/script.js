// Function to sort the table by Name
function sortTable() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("table");
    switching = true;

    while (switching) {
        switching = false;
        rows = table.getElementsByTagName("tr");

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;

            x = rows[i].getElementsByTagName("td")[0];
            y = rows[i + 1].getElementsByTagName("td")[0];

            // Use localeCompare to compare Cyrillic strings
            if (x.innerHTML.toLowerCase().localeCompare(y.innerHTML.toLowerCase(), 'ua') > 0) {
                shouldSwitch = true;
                break;
            }
        }

        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

// JavaScript function to search the table by title
function searchTableByTitle() {
    let titleInput, filter, table, tr, td, i, txtValue;
    titleInput = document.getElementById("titleInput");
    filter = titleInput.value.toLowerCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; // The first column is "Title"
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

// JavaScript function to search the table by Stars
function searchTableByStars() {
    let starsInput, filter, table, tr, td, i, txtValue;
    starsInput = document.getElementById("starsInput");
    filter = starsInput.value.toLowerCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3]; // The first column is "Title"
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

window.addEventListener('load', function () {
    sortTable();
});