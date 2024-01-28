import './shared.js';
// This assumes that shared.js is in the same directory as viewprojects.js
// Adjust the path accordingly if the file is in a different location

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

// Add event listener to edit project button
const editProjectButton = document.getElementById('edit-project-button');
const openEditFormLink = document.getElementById('open-edit-form');

editProjectButton.addEventListener('click', () => {
    openProjectForm();
});

openEditFormLink.addEventListener('click', (event) => {
    event.preventDefault();
    openProjectForm();
});

// Your other viewprojects.js logic goes here
