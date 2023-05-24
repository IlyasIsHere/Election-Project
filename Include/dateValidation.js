const startDate = document.getElementById("input3");
const endDate = document.getElementById("input4");
const alert = document.getElementById("alert");
const form = document.getElementById("form");

form.addEventListener("submit", function (event) {
    const startDateValue = new Date(startDate.value);
    const endDateValue = new Date(endDate.value);

    if (startDateValue > endDateValue) {
        alert.style.display = 'block';
        event.preventDefault();
    }
})