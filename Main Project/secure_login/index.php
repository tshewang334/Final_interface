<?php
// Start the session to manage user login state and error messages
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Interface</title>
    <!-- Link to your external stylesheet -->
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Background element - now acts as the container for animated flag slices -->
    <div id="flag-container" class="background-flag"></div>

    <!-- Main login container -->
    <div class="container">
        <img src="images/logo.png" alt="Logo" class="logo">
        <div class="disclaimer-title">DISCLAIMER</div>
        <div class="disclaimer-text">"This interface is not for normal user"</div>
        <div class="main-warning"><i class="fas fa-exclamation-triangle"></i>Warning: Unauthorized access.</div>

        <div class="warning-box">
            <i class="fas fa-exclamation-triangle warning-icon"></i>
            <div class="warning-content">
                <div class="warning-title">Important Note</div>
                <div class="warning-text">Warning icons help users quickly identify potential issues, errors, or important information that requires attention.</div>
            </div>
        </div>

        <!-- The form will submit data to login_process.php -->
        <form action="login_process.php" method="POST" style="margin: 0;">
            <?php
                // Check if an error message is set in the session and display it
                if (isset($_SESSION['error_message'])) {
                    echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
                    // Unset the error message so it doesn't show again on refresh
                    unset($_SESSION['error_message']);
                }
            ?>
            <div class="input-group">
                <label for="code">Enter Required Code</label>
                <input type="password" id="code" name="admin_code" placeholder="Enter Code" required>
            </div>

            <div class="button-group">
                <!-- A non-functional revert button for aesthetics, or link it somewhere else -->
                <a href="#" class="btn">Revert</a>
                <button type="submit" class="btn">Done</button>
            </div>
        </form>
    </div>

    <script>
        const flagContainer = document.getElementById('flag-container');
        const screenWidth = window.innerWidth;
        const sliceWidth = 2; // Width of each animated flag slice in pixels
        const animationDelayMultiplier = 8; // Adjust for wave speed and pattern (higher = slower, more pronounced wave)

        function generateFlagSlices() {
            flagContainer.innerHTML = ''; // Clear existing slices before regenerating
            const currentScreenWidth = window.innerWidth;
            for (let i = 0; i < currentScreenWidth; i += sliceWidth) {
                const flag_img = document.createElement('div');
                flag_img.className = 'flag_img';
                // Set background position to show the correct part of the flag
                flag_img.style.backgroundPosition = -i + 'px 0px';
                // Apply animation delay for a staggered wave effect
                flag_img.style.animationDelay = -(i * animationDelayMultiplier) + 'ms';
                flagContainer.append(flag_img);
            }
        }

        // Generate slices on initial load
        generateFlagSlices();

        // Optional: Regenerate slices on window resize for responsiveness
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(generateFlagSlices, 250); // Debounce resize event
        });
    </script>
</body>
</html>