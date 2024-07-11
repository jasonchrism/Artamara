@extends('layouts.app')
@push('styles')
    @vite('resources/css/buyer/order/afterPayment.css')
@endpush

@section('content')
    @if ($status == 'settlement')
        <div class="pt-5 w-100 text-center">
            <h2 class="text-white">Your order has been successful</h2>
            <svg width="256" height="256" viewBox="0 0 256 256" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M221.76 69.6606L133.76 21.4806C131.994 20.5143 130.013 20.0078 128 20.0078C125.987 20.0078 124.006 20.5143 122.24 21.4806L34.24 69.6606C32.3522 70.6935 30.7769 72.2151 29.6791 74.0659C28.5812 75.9167 28.0013 78.0287 28 80.1806V175.821C28.0013 177.973 28.5812 180.084 29.6791 181.935C30.7769 183.786 32.3522 185.308 34.24 186.341L122.24 234.521C124.005 235.491 125.986 236 128 236C130.014 236 131.995 235.491 133.76 234.521L221.76 186.341C223.648 185.308 225.223 183.786 226.321 181.935C227.419 180.084 227.999 177.973 228 175.821V80.1806C227.999 78.0287 227.419 75.9167 226.321 74.0659C225.223 72.2151 223.648 70.6935 221.76 69.6606ZM126.08 28.5006C126.667 28.1731 127.328 28.0011 128 28.0011C128.672 28.0011 129.333 28.1731 129.92 28.5006L216.67 76.0006L178.5 96.8906C178.319 96.7405 178.125 96.6066 177.92 96.4906L89.92 48.3106L126.08 28.5006ZM128 124.501L39.33 76.0006L81.56 52.8706L170.23 101.411L128 124.501ZM38.08 179.301C37.4517 178.957 36.9273 178.451 36.5614 177.835C36.1955 177.219 36.0016 176.517 36 175.801V83.2906L124 131.451V226.361L38.08 179.301ZM217.92 179.301L132 226.301V131.451L172 109.561V152.001C173.5 152 172.5 152 173.5 152C175 152 173.939 152 175 152C176.061 152 176 152 177 152C178 152 180 152.001 180 152.001V105.181L220 83.2906V175.821C219.998 176.537 219.804 177.239 219.439 177.855C219.073 178.471 218.548 178.977 217.92 179.321V179.301Z"
                    fill="#CEFE06" />
            </svg>
            <div class="d-flex justify-content-center">
                <p class="text-secondary-txt mt-2 mb-5 w-50">Your order is being packed by our team and will be
                    shipped to the address you provided shortly</p>
            </div>

            <div class="mt-3 mb-3">
                <a href="{{ route('front.catalog') }}" class="btn btn-primary btn-after me-3">Buy Another Artwork</a>
                <a href="{{ route('front.mytransactions', 'PACKING') }}" class="btn btn-primary btn-after btn-details">See
                    Details</a>
            </div>
        </div>
    @elseif ($status == 'pending')
        <div class="pt-5 w-100 text-center">
            <h2 class="text-white">Your order has been recorded</h2>
            <svg width="256" height="256" viewBox="0 0 256 256" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M221.76 69.6606L133.76 21.4806C131.994 20.5143 130.013 20.0078 128 20.0078C125.987 20.0078 124.006 20.5143 122.24 21.4806L34.24 69.6606C32.3522 70.6935 30.7769 72.2151 29.6791 74.0659C28.5812 75.9167 28.0013 78.0287 28 80.1806V175.821C28.0013 177.973 28.5812 180.084 29.6791 181.935C30.7769 183.786 32.3522 185.308 34.24 186.341L122.24 234.521C124.005 235.491 125.986 236 128 236C130.014 236 131.995 235.491 133.76 234.521L221.76 186.341C223.648 185.308 225.223 183.786 226.321 181.935C227.419 180.084 227.999 177.973 228 175.821V80.1806C227.999 78.0287 227.419 75.9167 226.321 74.0659C225.223 72.2151 223.648 70.6935 221.76 69.6606ZM126.08 28.5006C126.667 28.1731 127.328 28.0011 128 28.0011C128.672 28.0011 129.333 28.1731 129.92 28.5006L216.67 76.0006L178.5 96.8906C178.319 96.7405 178.125 96.6066 177.92 96.4906L89.92 48.3106L126.08 28.5006ZM128 124.501L39.33 76.0006L81.56 52.8706L170.23 101.411L128 124.501ZM38.08 179.301C37.4517 178.957 36.9273 178.451 36.5614 177.835C36.1955 177.219 36.0016 176.517 36 175.801V83.2906L124 131.451V226.361L38.08 179.301ZM217.92 179.301L132 226.301V131.451L172 109.561V152.001C173.5 152 172.5 152 173.5 152C175 152 173.939 152 175 152C176.061 152 176 152 177 152C178 152 180 152.001 180 152.001V105.181L220 83.2906V175.821C219.998 176.537 219.804 177.239 219.439 177.855C219.073 178.471 218.548 178.977 217.92 179.321V179.301Z"
                    fill="#CEFE06" />
            </svg>
            <div class="d-flex justify-content-center">
                <p class="text-secondary-txt mt-2 mb-5 w-50">Your order is being recorded by our team and dont forget to pay
                </p>
            </div>

            <div class="mt-3 mb-3">
                <a href="{{ route('front.catalog') }}" class="btn btn-primary btn-after me-3">Buy Another Artwork</a>
                <a href="{{ route('front.mytransactions', 'UNPAID') }}" class="btn btn-primary btn-after btn-details">See
                    Details</a>
            </div>
        </div>
    @elseif ($status == 'failure')
        <div class="pt-5 w-100 text-center">
            <h2 class="text-white">Your order has been recorded</h2>
            <svg width="256" height="256" viewBox="0 0 256 256" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M221.76 69.6606L133.76 21.4806C131.994 20.5143 130.013 20.0078 128 20.0078C125.987 20.0078 124.006 20.5143 122.24 21.4806L34.24 69.6606C32.3522 70.6935 30.7769 72.2151 29.6791 74.0659C28.5812 75.9167 28.0013 78.0287 28 80.1806V175.821C28.0013 177.973 28.5812 180.084 29.6791 181.935C30.7769 183.786 32.3522 185.308 34.24 186.341L122.24 234.521C124.005 235.491 125.986 236 128 236C130.014 236 131.995 235.491 133.76 234.521L221.76 186.341C223.648 185.308 225.223 183.786 226.321 181.935C227.419 180.084 227.999 177.973 228 175.821V80.1806C227.999 78.0287 227.419 75.9167 226.321 74.0659C225.223 72.2151 223.648 70.6935 221.76 69.6606ZM126.08 28.5006C126.667 28.1731 127.328 28.0011 128 28.0011C128.672 28.0011 129.333 28.1731 129.92 28.5006L216.67 76.0006L178.5 96.8906C178.319 96.7405 178.125 96.6066 177.92 96.4906L89.92 48.3106L126.08 28.5006ZM128 124.501L39.33 76.0006L81.56 52.8706L170.23 101.411L128 124.501ZM38.08 179.301C37.4517 178.957 36.9273 178.451 36.5614 177.835C36.1955 177.219 36.0016 176.517 36 175.801V83.2906L124 131.451V226.361L38.08 179.301ZM217.92 179.301L132 226.301V131.451L172 109.561V152.001C173.5 152 172.5 152 173.5 152C175 152 173.939 152 175 152C176.061 152 176 152 177 152C178 152 180 152.001 180 152.001V105.181L220 83.2906V175.821C219.998 176.537 219.804 177.239 219.439 177.855C219.073 178.471 218.548 178.977 217.92 179.321V179.301Z"
                    fill="#CEFE06" />
            </svg>
            <div class="d-flex justify-content-center">
                <p class="text-secondary-txt mt-2 mb-5 w-50">Your order is being recorded by our team and dont forget to pay
                </p>
            </div>

            <div class="mt-3 mb-3">
                <a href="{{ route('front.catalog') }}" class="btn btn-primary btn-after me-3">Buy Another Artwork</a>
                <a href="{{ route('front.mytransactions', 'CANCELLED') }}" class="btn btn-primary btn-after btn-details">See
                    Details</a>
            </div>
        </div>
    @endif
@endsection
