@extends('layouts.app')
<!-- Styles -->
<link href="{{asset('css/about.css')}}" rel="stylesheet">
<style>
    .gtco-cover{
        background: url("/images/about.jpg");
    }

</style>
<!--Js-->
<script type="text/javascript">

</script>
@section('content')
    <!--header-->
    <header id="gtco-header" class="gtco-cover" role="banner" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="wrap-hero-content">
                    <div class="hero-content">
                        <h1>Hello</h1>
                        <br>
                        <span class="typed"></span>
                    </div>
                </div>
            </div>
            <div class="mouse-icon margin-20">
                <div class="scroll"></div>
            </div>
        </div>
    </header>

    <!--content-->
    <div class="page">

    </div>
@endsection