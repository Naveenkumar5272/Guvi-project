$(document).ready(function() {
    // Retrieve user data from MongoDB
    $.ajax({
        type: 'POST',
        url: 'php/profile.php',
        success: function(response) {
            $('#profileData').html(response);
        }
    });
});
