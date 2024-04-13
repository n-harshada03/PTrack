const projectForm = document.querySelector('#project-form');
const addProjectForm = document.querySelector('#add-project-form');

// Function to open the project form
function openProjectForm() {
    projectForm.style.display = 'block';
    projectForm.style.position = 'fixed';
    projectForm.style.top = '100px'; 
    projectForm.style.right = '100px'; 
    projectForm.style.padding = '50px'; 
}

// Function to close the project form
function closeProjectForm() {
    projectForm.style.display = 'none';
}

// Add event listener for the "Add Project" button
const addProjectButton = document.querySelector('#add-project-button');
addProjectButton.addEventListener('click', openProjectForm);

// Add event listener for project form submission
addProjectForm.addEventListener('submit', (event) => {
    event.preventDefault();

    // Get form data
    const projectTitle = document.querySelector('#project-title').value;
    const projectStartDate = document.querySelector('#project-Startdate').value;
    const numMembers = document.querySelector('#num-members').value;
    const projectGuide = document.querySelector('#project-guide').value;
    const projectLeader = document.querySelector('#project-leader').value;
    const tasks = Array.from(document.querySelectorAll('#task-list li')).map(item => item.textContent);

    // Create a new project object
    const newProject = {
        title: projectTitle,
        members: numMembers,
        progress: 0,
        startDate: projectStartDate,
        guide: projectGuide,
        leader: projectLeader,
        tasks: tasks,
    };

    // Add the new project to the list and render it
    projects.push(newProject);
    renderProject(newProject);

    // Hide the form after submission
    closeProjectForm(); 

    // Reset form fields
    addProjectForm.reset();
});
