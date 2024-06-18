<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/notification.css')
</head>
<body> -->
    <!-- {{ session('message') }} -->
    
    <!-- <div class="notification {{ session('status') == 'error' ? 'error' : '' }} {{ session('title') ? '' : 'no-title' }} " id="notif">
        <div class="d-flex">
            <div>
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="notification-icon">
                    <path d="M11.0003 0.166016C5.04199 0.166016 0.166992 5.04102 0.166992 10.9993C0.166992 16.9577 5.04199 21.8327 11.0003 21.8327C16.9587 21.8327 21.8337 16.9577 21.8337 10.9993C21.8337 5.04102 16.9587 0.166016 11.0003 0.166016ZM8.83366 16.416L3.41699 10.9993L4.94449 9.47185L8.83366 13.3502L17.0562 5.12768L18.5837 6.66602L8.83366 16.416Z" fill="#CEFE06"/>
                </svg>
            </div>
            <div class="notification-title text-center">
                <div class="title-container">
                    <p class="title fw-semibold">{{ session('title') }}</p>
                </div>
                <div>
                    <p class="notification-art-name fw-semibold">{{ session('art-name') }}</p>
                    <p class="notification-artist-name fw-semibold">{{ session('artist-name') }}</p>
                </div>
            </div>
            <div class="notification-price">
                <p class="fw-regular">{{ session('art-price') }}</p>
            </div>
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="notification-close-icon">
                <path d="M1.4 14L0 12.6L5.6 7L0 1.4L1.4 0L7 5.6L12.6 0L14 1.4L8.4 7L14 12.6L12.6 14L7 8.4L1.4 14Z" fill="#464646"/>
            </svg>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myDiv = document.getElementById("notif");

            // Show the div
            myDiv.style.visibility = "visible";
            myDiv.style.opacity = "1";
            setTimeout(function() {
                myDiv.classList.add("show-animate");
            }, 50);

            // Hide the div after 1 second
            setTimeout(function() {
                myDiv.style.visibility = "hidden";
                myDiv.style.opacity = "0";
            }, 3000); // 1000 milliseconds = 1 second
        });
    </script>
</body>
</html> -->