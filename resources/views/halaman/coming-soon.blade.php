@extends('layouts.app')

@section('title', 'Coming Soon')

@section('description', 'Coming Soon')

@section('content')

    <!-- Static Backdrop Modal -->
    <div class="cs-newsletter-form modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <h6 class="mb-3">Subscribe our newsletter.</h6>
                    <form action="#">
                        <input class="form-control mb-3" type="email" placeholder="Enter your email">
                        <button class="btn btn-primary w-100" type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content Wrapper -->
    <div class="coming-soon-wrapper bg-white text-center bg-overlay"
        style="background-image: url('{{ asset('img/bg-img/26.jpg') }}')">
        <div class="container">
            <div class="cs-logo">
                <a href="{{asset('home')}}">
                    <img src="{{ asset('img/core-img/icon.png') }}" alt="">
                </a>
            </div>

            <h1 class="text-white display-3">Coming Soon</h1>
            <p>Fitur ini sedang dalam pengembangan. Nantikan segera!</p>

            <div class="countdown2 justify-content-center" id="countdown2" data-date="12-31-2025" data-time="23:59">
                <div class="day">
                    <span class="num"></span>
                    <span class="word"></span>
                </div>
                <div class="hour">
                    <span class="num"></span>
                    <span class="word"></span>
                </div>
                <div class="min">
                    <span class="num"></span>
                    <span class="word"></span>
                </div>
                <div class="sec">
                    <span class="num"></span>
                    <span class="word"></span>
                </div>
            </div>

            <div class="notify-email mt-5">
                <button class="btn btn-warning" type="button" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">Notify via
                    Email</button>
            </div>
        </div>
    </div>

@endsection
