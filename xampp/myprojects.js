document.addEventListener('DOMContentLoaded', function () {
    const openProjectFormButton = document.getElementById('add-project-button');
    const projectForm = document.getElementById('project-form');
    const projectList = document.querySelector('.project-list');
    const searchInput = document.getElementById('search-input'); // New: Get the search input element

    openProjectFormButton.addEventListener('click', function () {
        projectForm.style.display = 'block';
        projectForm.classList.add('portrait-mode'); // New: Add portrait-mode class to project form
        projectList.style.pointerEvents = 'none'; // New: Disable pointer events for project list while form is open
        document.querySelector('.overlay').style.display = 'block'; // New: Show background overlay
    });

    document.getElementById('add-project-form').addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('addproject.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const projectBox = document.createElement('div');
            projectBox.classList.add('project');
            projectBox.innerHTML = `<h2>${formData.get('project-title')}</h2>
                                    <button class="open-button" data-project-id="${data.id}">Open Project</button>`;
            projectList.appendChild(projectBox);
            document.getElementById('add-project-form').reset();
            projectForm.style.display = 'none';
            projectForm.classList.remove('portrait-mode'); // New: Remove portrait-mode class
            projectList.style.pointerEvents = 'auto'; // New: Enable pointer events for project list
            document.querySelector('.overlay').style.display = 'none'; // New: Hide background overlay
        })
        .catch(error => console.error('Error:', error));
    });

    function fetchProjects() {
        fetch('getproject.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(project => {
                const projectBox = document.createElement('div');
                projectBox.classList.add('project');
                projectBox.innerHTML = `<h2>${project.title}</h2>
                                        <button class="open-button" data-project-id="${project.id}">Open Project</button>`;
                projectList.appendChild(projectBox);
            });
        })
        .catch(error => console.error('Error:', error));
    }

    fetchProjects();

    // New: Add event listener for search input
    searchInput.addEventListener('input', function () {
        const searchQuery = this.value.toLowerCase();
        const projectBoxes = document.querySelectorAll('.project');

        projectBoxes.forEach(box => {
            const title = box.querySelector('h2').textContent.toLowerCase();
            if (title.includes(searchQuery)) {
                box.style.display = 'block'; // Show box if title matches search query
            } else {
                box.style.display = 'none'; // Hide box if title doesn't match search query
            }
        });
    });
});
