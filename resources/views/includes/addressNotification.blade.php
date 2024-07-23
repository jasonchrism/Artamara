<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/addressnotification.css')
</head>

<body>
    <div class="notification {{ session('status') == 'error' ? 'error' : '' }} {{ session('address_title') ? '' : 'no-title' }} " id="notif">
        <div class="d-flex notif-container">
            @if(session('status') != 'error')
            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 2.16669C7.04163 2.16669 2.16663 7.04169 2.16663 13C2.16663 18.9584 7.04163 23.8334 13 23.8334C18.9583 23.8334 23.8333 18.9584 23.8333 13C23.8333 7.04169 18.9583 2.16669 13 2.16669ZM13 21.6667C8.22246 21.6667 4.33329 17.7775 4.33329 13C4.33329 8.22252 8.22246 4.33335 13 4.33335C17.7775 4.33335 21.6666 8.22252 21.6666 13C21.6666 17.7775 17.7775 21.6667 13 21.6667ZM17.9725 8.21169L10.8333 15.3509L8.02746 12.5559L6.49996 14.0834L10.8333 18.4167L19.5 9.75002L17.9725 8.21169Z" fill="#CEFE06"/>
            </svg>
            @else
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 16.4167C11.3069 16.4167 11.5644 16.3127 11.7724 16.1047C11.9804 15.8967 12.084 15.6396 12.0833 15.3334C12.0826 15.0271 11.9786 14.77 11.7713 14.562C11.564 14.354 11.3069 14.25 11 14.25C10.693 14.25 10.4359 14.354 10.2286 14.562C10.0213 14.77 9.91735 15.0271 9.91663 15.3334C9.9159 15.6396 10.0199 15.897 10.2286 16.1058C10.4373 16.3145 10.6945 16.4181 11 16.4167ZM9.91663 12.0834H12.0833V5.58335H9.91663V12.0834ZM11 21.8334C9.50135 21.8334 8.09302 21.5488 6.77496 20.9797C5.45691 20.4106 4.31038 19.6389 3.33538 18.6646C2.36038 17.6903 1.58868 16.5438 1.02029 15.225C0.451905 13.9062 0.16735 12.4979 0.166627 11C0.165905 9.50213 0.450461 8.0938 1.02029 6.77502C1.59013 5.45624 2.36182 4.30972 3.33538 3.33544C4.30893 2.36116 5.45546 1.58947 6.77496 1.02035C8.09446 0.451243 9.50279 0.166687 11 0.166687C12.4971 0.166687 13.9055 0.451243 15.225 1.02035C16.5445 1.58947 17.691 2.36116 18.6645 3.33544C19.6381 4.30972 20.4102 5.45624 20.9807 6.77502C21.5513 8.0938 21.8355 9.50213 21.8333 11C21.8311 12.4979 21.5466 13.9062 20.9796 15.225C20.4127 16.5438 19.641 17.6903 18.6645 18.6646C17.6881 19.6389 16.5416 20.4109 15.225 20.9808C13.9083 21.5506 12.5 21.8348 11 21.8334ZM11 19.6667C13.4194 19.6667 15.4687 18.8271 17.1479 17.1479C18.827 15.4688 19.6666 13.4195 19.6666 11C19.6666 8.58058 18.827 6.53127 17.1479 4.8521C15.4687 3.17294 13.4194 2.33335 11 2.33335C8.58052 2.33335 6.53121 3.17294 4.85204 4.8521C3.17288 6.53127 2.33329 8.58058 2.33329 11C2.33329 13.4195 3.17288 15.4688 4.85204 17.1479C6.53121 18.8271 8.58052 19.6667 11 19.6667Z" fill="#FC2D2D"/>
            </svg>
            @endif
            <p class="title fw-semibold">{{ session('address_title') }}</p>
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

            // Hide the div after 1 secondp
            setTimeout(function() {
                myDiv.style.visibility = "hidden";
                myDiv.style.opacity = "0";
            }, 3000); // 1000 milliseconds = 1 second
        });
    </script>
</body>

</html>