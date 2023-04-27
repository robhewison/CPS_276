<?php
// Start the session to handle user access and authorization
session_start();

// Check if the 'page' parameter is set in the URL
if (isset($_GET['page'])) {
    // Get the value of the 'page' parameter from the URL
    $page = $_GET['page'];

    // Based on the value of the 'page' parameter, include the appropriate page
    switch ($page) {
        case 'login':
            // Include the login page
            require_once 'pages/login.php';
            break;

        case 'welcome':
            // Include the welcome page
            require_once 'pages/welcome.php';
            break;

        case 'addContact':
            // Include the add contact page
            require_once 'pages/addContact.php';
            break;

        case 'deleteContacts':
            // Include the delete contacts page
            require_once 'pages/deleteContacts.php';
            break;

        case 'addAdmin':
            // Include the add admin page
            require_once 'pages/addAdmin.php';
            break;

        case 'deleteAdmins':
            // Include the delete admins page
            require_once 'pages/deleteAdmins.php';
            break;

        default:
            // Redirect to the login page if an invalid 'page' parameter is provided
            header('Location: index.php?page=login');
            break;
    }
} else {
    // Redirect to the login page if the 'page' parameter is not provided
    header('Location: index.php?page=login');
}