let exams = [];
let currentSort = { column: null, direction: "asc" };

// 1. Load JSON data
fetch("../api/exams.json")
    .then(response => response.json())
    .then(data => {
        exams = data;
        renderTable(exams);
    });


// 2. Render table
function renderTable(list) {
    const tbody = document.getElementById("exam-body");
    tbody.innerHTML = "";

    list.forEach(e => {
        tbody.innerHTML += `
            <tr>
                <td>${e.id}</td>
                <td>${e.date}</td>
                <td>${e.place}</td>
                <td>${e.time}</td>
                <td>${e.examiner}</td>
                <td>${e.category}</td>
                <td>
                    <a class="btn" href="view.php?id=${e.id}">Vaata</a>
                    <a class="btn" href="edit.php?id=${e.id}">Muuda</a>
                    <a class="btn" href="delete.php?id=${e.id}">Kustuta</a>
                </td>
            </tr>
        `;
    });
}


// 3. Filter handler
function applyFilters() {
    let filtered = [...exams];

    let examiner = document.getElementById("filter-examiner").value.toLowerCase();
    let place = document.getElementById("filter-place").value.toLowerCase();
    let category = document.getElementById("filter-category").value.toLowerCase();
    let date = document.getElementById("filter-date").value;

    if (examiner) filtered = filtered.filter(e => e.examiner.toLowerCase().includes(examiner));
    if (place) filtered = filtered.filter(e => e.place.toLowerCase().includes(place));
    if (category) filtered = filtered.filter(e => e.category.toLowerCase().includes(category));
    if (date) filtered = filtered.filter(e => e.date === date);

    // Reapply sorting
    if (currentSort.column) {
        sortBy(currentSort.column);
        filtered = sortedExams;
    }

    renderTable(filtered);
}


// 4. Real-time filtering
document.querySelectorAll("#filter-examiner, #filter-place, #filter-category, #filter-date")
    .forEach(input => input.addEventListener("input", applyFilters));


// 5. Reset button
document.getElementById("filter-reset").addEventListener("click", () => {
    document.getElementById("filter-examiner").value = "";
    document.getElementById("filter-place").value = "";
    document.getElementById("filter-category").value = "";
    document.getElementById("filter-date").value = "";
    renderTable(exams);
});


// 6. Sorting
let sortedExams = [];

function sortBy(column) {
    sortedExams = [...exams];

    sortedExams.sort((a, b) => {
        let x = a[column];
        let y = b[column];

        if (column == "id") {
            x = Number(x);
            y = Number(y);
        }

        if (currentSort.direction === "asc") {
            return x > y ? 1 : -1;
        } else {
            return x < y ? 1 : -1;
        }
    });

    renderTable(sortedExams);
}


// 7. Click on table header → sort
document.querySelectorAll(".sortable").forEach(th => {
    th.addEventListener("click", () => {
        const column = th.dataset.column;

        // toggle ascending / descending
        if (currentSort.column === column) {
            currentSort.direction = currentSort.direction === "asc" ? "desc" : "asc";
        } else {
            currentSort.direction = "asc";
        }

        currentSort.column = column;
        sortBy(column);

        updateArrows();
    });
});


// 8. Update arrow icons in table header
function updateArrows() {
    document.querySelectorAll(".sortable").forEach(th => {
        th.innerHTML = th.innerHTML.replace(" ▲", "").replace(" ▼", "");

        if (th.dataset.column === currentSort.column) {
            th.innerHTML += currentSort.direction === "asc" ? " ▲" : " ▼";
        }
    });
}
