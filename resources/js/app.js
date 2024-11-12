import './bootstrap';

import Alpine from 'alpinejs';

import exportToExcel from './exportToExcel.js';
import exportToExcel_branch from './exportToExcel_branch.js';

window.exportToExcel = exportToExcel;
window.exportToExcel_branch = exportToExcel_branch;

window.Alpine = Alpine;

Alpine.start();
