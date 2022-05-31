@extends('index')
@section('it')
<div class="masthead">
    <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#bs-carousel" data-slide-to="1"></li>
            <li data-target="#bs-carousel" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item slides active">
                <div class="slide-1"></div>
                <div class="hero">
                    <hgroup>
                    <h1>We are creative</h1>
                    <h3>Get start your next awesome project</h3>
                    </hgroup>
                    <button class="btn btn-hero btn-lg hidden" role="button">See all features</button>
                </div>
            </div>
            <div class="item slides">
                <div class="slide-2"></div>
                <div class="hero">
                    <hgroup>
                    <h1>We are smart</h1>
                    <h3>Get start your next awesome project</h3>
                    </hgroup>
                    <button class="btn btn-hero btn-lg hidden" role="button">See all features</button>
                </div>
            </div>
            <div class="item slides">
                <div class="slide-3"></div>
                <div class="hero">
                    <hgroup>
                    <h1>We are amazing</h1>
                    <h3>Get start your next awesome project</h3>
                    </hgroup>
                    <button class="btn btn-hero btn-lg hidden" role="button">See all features</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection