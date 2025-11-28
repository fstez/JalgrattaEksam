const API_BASE = "../api/exams";

function renderExams(data) {
    let html = "<table border='1' cellpadding='5'><tr>" +
        "<th>ID</th><th>Date</th><th>Place</th><th>Time</th>" +
        "<th>Duration</th><th>Examiner</th><th>Category</th>" +
        "</tr>";

    data.forEach(e => {
        html += `
            <tr>
                <td>${e.id}</td>
                <td>${e.date}</td>
                <td>${e.place}</td>
                <td>${e.time}</td>
                <td>${e.duration}</td>
                <td>${e.examiner}</td>
                <td>${e.category}</td>
            </tr>
        `;
    });

    html += "</table>";
    document.getElementById("examList").innerHTML = html;
}

function loadExams() {
    fetch(API_BASE)
        .then(r => r.json())
        .then(renderExams);
}

/* ---------- USER: search by place ---------- */
function searchByPlace() {
    const place = document.getElementById("searchPlace").value.trim();

    fetch(API_BASE)
        .then(r => r.json())
        .then(data => {
            const filtered = data.filter(e =>
                e.place.toLowerCase().includes(place.toLowerCase())
            );
            renderExams(filtered);
        });
}

/* ---------- USER: sort by time ---------- */
function sortByTime() {
    fetch(API_BASE)
        .then(r => r.json())
        .then(data => {
            data.sort((a, b) => a.time.localeCompare(b.time));
            renderExams(data);
        });
}

/* ---------- USER: sort by date ---------- */
function sortByDate() {
    fetch(API_BASE)
        .then(r => r.json())
        .then(data => {
            data.sort((a, b) => a.date.localeCompare(b.date));
            renderExams(data);
        });
}

/* ---------- ADMIN: delete exam ---------- */
function deleteExam() {
    const id = document.getElementById("deleteId").value;

    fetch(`${API_BASE}/${id}`, { method: "DELETE" })
        .then(() => loadExams());
}

/* ---------- ADMIN: change examiner ---------- */
function changeExaminer() {
    const id = document.getElementById("changeId").value;
    const examiner = document.getElementById("changeExaminer").value;

    fetch(`${API_BASE}/${id}/examiner`, {
        method: "PATCH",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ examiner })
    }).then(() => loadExams());
}
