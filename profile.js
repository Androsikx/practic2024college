document.addEventListener('DOMContentLoaded', function() {
    const profileSections = document.querySelectorAll('.profile-section h3');

    profileSections.forEach(function(section) {
        section.addEventListener('click', function() {
            const content = this.nextElementSibling;
            content.style.display = content.style.display === 'none' ? 'block' : 'none';
        });
    });
});
