var checkboxes = document.querySelectorAll('input[type="checkbox"]');

// Add event listener to each checkbox
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('click', function(ev) {
        // Toggle the 'completed-card' class on the parent card element
        var card = ev.target.closest('.card');
        if (card) {
            card.classList.toggle('completed-card');
        }
    });
});