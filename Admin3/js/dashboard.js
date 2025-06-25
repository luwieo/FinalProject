const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");
if (menuBar && sidebar) {
    menuBar.addEventListener("click", function () {
        sidebar.classList.toggle("hide");
    });
}

// Selects all elements with the ID 'switch-mode' (assuming there might be multiple, though ID should be unique).
const switchModeElements = document.querySelectorAll('#switch-mode');
switchModeElements.forEach(switchMode => {
    // Retrieves the dark mode preference from local storage.
    const darkMode = localStorage.getItem('darkMode');

    // Applies dark mode if previously enabled in local storage.
    if (darkMode === 'enabled') {
        document.body.classList.add('dark'); // Adds 'dark' class to the body.
        switchMode.checked = true; // Checks the switch.
    }

    // Adds an event listener for changes on the dark mode switch.
    switchMode.addEventListener('change', function() {
        if (this.checked) {
            document.body.classList.add('dark'); // Enables dark mode.
            localStorage.setItem('darkMode', 'enabled'); // Stores preference in local storage.
        } else {
            document.body.classList.remove('dark'); // Disables dark mode.
            localStorage.setItem('darkMode', 'disabled'); // Stores preference in local storage.
        }
    });
});