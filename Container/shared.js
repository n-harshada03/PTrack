// Function to open the project form
function openProjectForm() {
    const projectForm = document.querySelector('#project-form');
    projectForm.style.display = 'block';
    projectForm.style.position = 'fixed';
    projectForm.style.top = '100px'; // Adjust as needed
    projectForm.style.right = '100px'; // Adjust as needed
    projectForm.style.padding = '50px'; // Add padding
}

// Function to close the project form
function closeProjectForm() {
    const projectForm = document.querySelector('#project-form');
    projectForm.style.display = 'none';
}

// Other shared functions or variables can be added here
