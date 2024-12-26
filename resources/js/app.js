import './bootstrap';
import Alpine from 'alpinejs';

import '../css/app.css';   // Import app.css
import '../css/style.css'; // Import style.css


import exportToExcel from './exportToExcel.js';
import exportToExcel_branch from './exportToExcel_branch.js';


// Make sure Echo is properly initialized before this code
document.addEventListener('DOMContentLoaded', () => {
    // Add a console log to verify the code is running
    console.log('DOMContentLoaded event fired');


    if (typeof window.Echo === 'undefined') {
        console.error('Echo is not initialized');
        return;
    }

    window.Echo.channel('test-progress')
        .listen('.test.progress', (event) => {
            console.log('Event received:', event);

            // Update the progress bar
            const progressBar = document.getElementById('progressBar');
            if (progressBar) {
                progressBar.style.width = event.progress + '%';
                progressBar.innerText = event.progress + '%';
            } else {
                console.error('Progress bar element not found');
            }
        });
});

window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('Successfully connected to Pusher');
});

window.Echo.connector.pusher.connection.bind('error', (error) => {
    console.error('Pusher connection error:', error);
});


window.exportToExcel = exportToExcel;
window.exportToExcel_branch = exportToExcel_branch;

window.Alpine = Alpine;

Alpine.start();
