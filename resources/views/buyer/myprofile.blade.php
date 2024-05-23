@vite('resources/css/tabprofile.css')

@extends('layouts.app')

@section('content')
    <div style="margin-top: 62px;">
        <ul class="nav nav-pills" id="myTab">
            <li class="nav-item tab-link tab-active">
                <a class="" onclick="openTab('profile', this)">Profile</a>
            </li>
            <li class="nav-item tab-link">
                <a class="" onclick="openTab('change-password', this)">Change Password</a>
            </li>
            <li class="nav-item tab-link">
                <a class="" onclick="openTab('address', this)">Address</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div id="profile" class="tab-name text-white">
                Profile
            </div>
            <div id="change-password" class="tab-name text-white" style="display: none;">
                Change Password
            </div>
            <div id="address" class="tab-name text-white" style="display: none;">
                Address
            </div>
        </div>
    </div>

    <script>
        function openTab(tabName, element) {
            var tabs = document.getElementsByClassName("tab-name");
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].style.display = "none";
            }

            var tabLinks = document.getElementsByClassName("tab-link");
            for (var i = 0; i < tabLinks.length; i++) {
                tabLinks[i].classList.remove("tab-active");
            }

            document.getElementById(tabName).style.display = "block";
            element.parentNode.classList.add("tab-active");
        }

        document.addEventListener('DOMContentLoaded', function() {
            openTab('profile', document.querySelector('.tab-link.tab-active a'));
        });
    </script>
@endsection
