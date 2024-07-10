@vite('resources/css/admin/home.css')
@extends('layouts.dashboard')
@section('header_title')
Welcome, Admin
@endsection
@section('header_title')
Welcome, Admin
@endsection
@section('content')
<div class="mr-left">
    <div class="total-earnings-container">
        <div class="d-flex">
            <input type="text" value="Rp1.121.140.000.000" class="text-primary fw-semibold total-earnings" id="currencyInput" disabled>
            <i class="bi d-flex justify-content-center align-items-center" id="togglePassword">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" id="eyeIcon">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                </svg>
            </i>
        </div>
        <p class="text-secondary">Total Earnings</p>
    </div>
    <span id="widthCalculator" style="visibility:hidden; white-space:pre; position:absolute;"></span>

    <div class="count-container d-flex">
        <div class="item-container d-flex flex-column justify-content-center">
            <div style="margin-left: 24px;">
                <h3 class="text-primary">5.040</h3>
                <p class="text-white">Artwork Collections</p>
            </div>
        </div>
        <div class="item-container d-flex flex-column justify-content-center">
            <div style="margin-left: 24px;">
                <h3 class="text-primary">102</h3>
                <p class="text-white">Auctions Held</p>
            </div>
        </div>
        <div class="item-container d-flex flex-column justify-content-center">
            <div style="margin-left: 24px;">
                <h3 class="text-primary">102.320</h3>
                <p class="text-white">Total Orders</p>
            </div>
        </div>
        <div class="item-container d-flex flex-column justify-content-center" style="margin-bottom: 0;">
            <div style="margin-left: 24px;">
                <h3 class="text-primary">230.302</h3>
                <p class="text-white">Total Customers</p>
            </div>
        </div>
    </div>

    <div class="third-container d-flex">
        <div class="monthly">
            <p>Monthly Earnings</p>
            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="return">
            <p>Return Requests</p>
            <div class="return-container d-flex justify-content-center align-items-center">
                <div class="return-table-border">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col" style="color: var(--text-secondary); border: none;">No</th>
                                <th scope="col" style="color: var(--text-secondary); border: none;">Id</th>
                                <th scope="col" style="border: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i < 8; $i++) <tr>
                                <td scope="row">{{ $i }}</td>
                                <td>12345678</td>
                                <td class="p-0"><a href="" class="btn btn-primary check-btn">Check</a></td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="fourth-container d-flex">
        <div class="on-going-auctions">
            <p>On Going Auctions</p>
            <div class="on-going-auctions-container d-flex justify-content-center align-items-center">
                <div class="on-going-auctions-border">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col" style="color: var(--text-secondary);">No</th>
                                <th scope="col" style="color: var(--text-secondary);">Title</th>
                                <th scope="col" style="color: var(--text-secondary);">Last Price</th>
                                <th scope="col" style="color: var(--text-secondary);">Ends in</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i < 8; $i++) <tr>
                                <td scope="row">{{ $i }}</td>
                                <td>Senja Kemala</td>
                                <td>Rp200.000.000</td>
                                <td>1d : 4h : 30s</td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="verification-requests">
            <p>Verification Requests</p>
            <div class="verification-requests-container d-flex justify-content-center align-items-center">
                <div class="verification-requests-border">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col" style="color: var(--text-secondary); border: none;">No</th>
                                <th scope="col" style="color: var(--text-secondary); border: none;">Id</th>
                                <th scope="col" style="color: var(--text-secondary); border: none;">Name</th>
                                <th scope="col" style="border: none;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i < 8; $i++) <tr>
                                <td scope="row">{{ $i }}</td>
                                <td>12345678</td>
                                <td>Senja Kemala</td>
                                <td class="p-0"><a href="" class="btn btn-primary check-btn">Check</a></td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateInputWidth() {
            const input = document.getElementById('currencyInput');
            const widthCalculator = document.getElementById('widthCalculator');

            widthCalculator.textContent = input.value;
            widthCalculator.style.font = window.getComputedStyle(input).font;

            input.style.width = widthCalculator.offsetWidth + 'px';
        }

        document.getElementById('togglePassword').addEventListener('click', function() {
            const input = document.getElementById('currencyInput');
            const eyeIcon = document.getElementById('eyeIcon');

            if (input.type === 'text') {
                input.type = 'password';
                eyeIcon.outerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16" id="eyeIcon">
                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                        <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                        <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
                    </svg>
                `;
            } else {
                input.type = 'text';
                eyeIcon.outerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" id="eyeIcon">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                    </svg>
                `;
            }

            updateInputWidth();
        });

        updateInputWidth();
    });
</script>

<script>
    const ctx = document.getElementById('myChart');

    function getLast6Months() {
        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let result = [];
        let date = new Date();

        for (let i = 0; i < 6; i++) {
            result.push(months[date.getMonth()]);
            date.setMonth(date.getMonth() - 1);
        }

        return result.reverse();
    }

    const last6Months = getLast6Months();

    var totalPrice = @json($totalPrice);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: last6Months,
            datasets: [{
                label: 'Monthly Earnings',
                data: totalPrice,
                borderWidth: 1,
                fill: true,
                backgroundColor: 'rgba(206, 254, 6, 0.2)',
                borderColor: 'rgba(206, 254, 6, 1)',
                tension: 0.4
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection