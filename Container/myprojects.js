document.addEventListener('DOMContentLoaded', function () {
    const openProjectFormButton = document.getElementById('add-project-button');
    const projectForm = document.getElementById('project-form');
    const projectList = document.querySelector('.project-list');
    const searchInput = document.getElementById('search-input');

    openProjectFormButton.addEventListener('click', function () {
        if (projectForm.style.display === 'block') {
            // If form is currently displayed, hide it and remove portrait mode class
            projectForm.style.display = 'none';
            projectForm.classList.remove('portrait-mode');
            projectList.style.pointerEvents = 'auto'; // Enable pointer events for project list
            document.querySelector('.overlay').style.display = 'none'; // Hide background overlay
        } else {
            // If form is currently hidden, show it and add portrait mode class
            projectForm.style.display = 'block';
            projectForm.classList.add('portrait-mode');
            projectList.style.pointerEvents = 'none'; // Disable pointer events for project list
            document.querySelector('.overlay').style.display = 'block'; // Show background overlay
        }
    });

    // Function to add members dynamically
    function addMember() {
        const memberContainer = document.querySelector('.member-container');
        const newMemberInput = document.createElement('input');
        newMemberInput.type = 'text';
        newMemberInput.name = `member${memberContainer.children.length + 1}`;
        newMemberInput.placeholder = `Member ${memberContainer.children.length + 1}`;
        memberContainer.appendChild(newMemberInput);
    }

    // Function to add tasks dynamically
    let taskCount = 0;
    function addTask() {
        const taskList = document.getElementById('task-list');
        const newTaskInput = document.createElement('input');
        newTaskInput.type = 'text';
        newTaskInput.name = `task${++taskCount}`;
        newTaskInput.placeholder = `Task ${taskCount}`;
        const listItem = document.createElement('li');
        listItem.appendChild(newTaskInput);
        taskList.appendChild(listItem);
    }

    // Update form submission logic
    document.getElementById('add-project-form').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        // Collect task data
        const tasks = [];
        for (let i = 1; ; i++) {
            const taskInput = formData.get(`task${i}`);
            if (!taskInput) break;
            tasks.push(taskInput);
        }
        formData.append('tasks', JSON.stringify(tasks)); // Send tasks as JSON 

        fetch('addproject.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error); // Show the error message
            } else {
                // Proceed with adding the project
                const projectBox = document.createElement('div');
                projectBox.classList.add('project');
                projectBox.innerHTML = `<h2>${formData.get('project-title')}</h2>
                                        <button class="open-button" data-project-id="${data.id}">Open Project</button>`;
                projectList.appendChild(projectBox);
                document.getElementById('add-project-form').reset();
                projectForm.style.display = 'none'; 
                projectForm.classList.remove('portrait-mode');
                projectList.style.pointerEvents = 'auto';
                document.querySelector('.overlay').style.display = 'none'; 
            }
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

    searchInput.addEventListener('input', function () {
        const searchQuery = this.value.toLowerCase();
        const projectBoxes = document.querySelectorAll('.project');

        projectBoxes.forEach(box => {
            const title = box.querySelector('h2').textContent.toLowerCase(); 
            if (title.includes(searchQuery)) {
                box.style.display = 'block';
            } else {
                box.style.display = 'none';
            } 
        }); 
    }); 

    projectList.addEventListener('click', function (event) {
        const button = event.target; 
        if (button.classList.contains('open-button')) { 
            const projectId = button.dataset.projectId;
            window.location.href = `viewprojects.html?id=${projectId}`; 
        }
    });
});