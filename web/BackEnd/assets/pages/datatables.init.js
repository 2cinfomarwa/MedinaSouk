/*
 Template Name: Canvab - Bootstrap 4 Admin Dashboard & Frontend
 Author: Themesbrand
 File: Datatable js
 */

$(document).ready(function(){$("#datatable").DataTable(),$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","pdf","colvis"]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")});