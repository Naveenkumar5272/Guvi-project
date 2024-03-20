$(document).ready(function() {
    $('#loginForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        var formData = $(this).serialize(); // Serialize form data
        $.ajax({
            type: 'POST', // Using POST method
            url: 'php/login.php', // PHP file to handle form submission
            data: formData, // Form data to be sent to the server
            success: function(response) { // Callback function to handle server response
                $('#message').html(response); // Display server response in the message div
                if (response.indexOf('successful') !== -1) { // Check if login is successful
                    localStorage.setItem('loggedIn', 'true'); // Set loggedIn key in local storage
                    window.location.href = 'profile.html'; // Redirect to profile page
                }
            }
        });
    });
});
