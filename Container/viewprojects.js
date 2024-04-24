document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const projectId = urlParams.get('id');

    fetchProjectData(projectId);

    // Function to fetch and display project data
    function fetchProjectData(id) {
        fetch(`getproject.php?id=${id}`)
            .then(response => response.json())
            .then(projectData => {
                displayProjectData(projectData);
            })
            .catch(error => console.error('Error:', error));
    }

    // Function to display project data in the HTML
    function displayProjectData(project) {
        // Project details
        document.getElementById('project-title').textContent = project.title;
        document.getElementById('project-description').textContent = project.description;
        document.getElementById('start-date').textContent = `Start Date: ${project.start_date}`; 
        document.getElementById('deadline').textContent = `Deadline: ${project.deadline}`; // Assuming you have a deadline field 
        document.getElementById('project-guide').textContent = `Project Guide: ${project.guide}`;
        document.getElementById('project-leader').textContent = `Project Leader: ${project.leader}`;

        // Additional project details
        document.getElementById('member1').textContent = `Member 1: ${project.member1}`;
        document.getElementById('member2').textContent = `Member 2: ${project.member2}`;
        document.getElementById('member3').textContent = `Member 3: ${project.member3}`;
        document.getElementById('member4').textContent = `Member 4: ${project.member4}`;
        document.getElementById('member5').textContent = `Member 5: ${project.member5}`;
        

        // ... (Similarly for other members, deadline, etc.) ...

        // Members display using a grid layout (example)
        const memberList = document.getElementById('member-list');
        memberList.innerHTML = ''; // Clear previous members
        for (let i = 1; i <= 5; i++) { // Assuming up to 5 members
            const member = project[`member${i}`];
            if (member) {
                const memberDiv = document.createElement('div');
                memberDiv.textContent = member;
                memberList.appendChild(memberDiv);
            }
        }

        // Task progress
        const totalTasks = project.tasks.length;
        const completedTasks = project.tasks.filter(task => task.completed).length; // Assuming tasks have a 'completed' property
        document.getElementById('task-progress').textContent = `Tasks: ${completedTasks} of ${totalTasks} Completed`;

        // Project progress (example calculation based on tasks)
        const progressPercentage = Math.round((completedTasks / totalTasks) * 100);
        document.getElementById('project-progress').textContent = `Progress: ${progressPercentage}%`;

        // Recent activities
        const activityList = document.getElementById('activity-list');
        activityList.innerHTML = ''; 
        project.activities.forEach(activity => {
            const listItem = document.createElement('li');
            listItem.textContent = activity;
            activityList.appendChild(listItem);
        });
    }

    // ... (Existing code for fetching project ID and data remains the same) ...

    const projectForm = document.querySelector('#project-form');
    const addProjectForm = document.querySelector('#add-project-form');
    const taskList = document.getElementById('task-list');

    // Function to open the project form
    function openProjectForm() {
        projectForm.style.display = 'block';
        // ... (Styling for project form position, padding, etc.) ...
    }

    // Function to close the project form
    function closeProjectForm() {
        projectForm.style.display = 'none';
    }

    // Add event listener for the "Add Project" button
    const addProjectButton = document.querySelector('#add-project-button');
    addProjectButton.addEventListener('click', openProjectForm);

    // Function to add a new task to the task list
    function addTask() {
        const taskInput = document.getElementById('add-task');
        const taskText = taskInput.value.trim();
        if (taskText !== '') {
            const listItem = document.createElement('li');
            listItem.textContent = taskText;
            taskList.appendChild(listItem);
            taskInput.value = ''; // Clear the input field
        }
    }

    // Add event listener for project form submission
    addProjectForm.addEventListener('submit', (event) => {
        event.preventDefault();

        // Get form data
        // ... (Get project title, start date, members, guide, leader as before) ...
        const tasks = Array.from(document.querySelectorAll('#task-list li')).map(item => item.textContent);

        // Create a new project object
        const newProject = {
            // ... (Set project properties as before) ...
            tasks: tasks,
        };

        // Send project data to the server (using fetch or XMLHttpRequest)
        // ... (Implement logic to send data to addproject.php) ...

        // Handle successful project creation (e.g., display success message, update project list)
        // ... (Implement logic to handle successful response from server) ...
    });

    const generateff180 = document.getElementById("#generate-ff180");
    generateff180.addEventListener("click", function() {
        window.location.href = "ff180.html";
    });
});