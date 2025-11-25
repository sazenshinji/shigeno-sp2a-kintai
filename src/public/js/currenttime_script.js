document.addEventListener("DOMContentLoaded", function () {
    const currentTimeElement = document.getElementById("current-time");

    function updateCurrentTime() {
        const now = new Date();
        const hh = String(now.getHours()).padStart(2, "0");
        const mm = String(now.getMinutes()).padStart(2, "0");
        currentTimeElement.textContent = `${hh}:${mm}`;
    }

    updateCurrentTime();
    setInterval(updateCurrentTime, 1000);
});
