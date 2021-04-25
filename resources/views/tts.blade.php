<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Create a stylish landing page for your business startup and get leads for the offered services with this HTML landing page template.">
    <meta name="author" content="Inovatik">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>Telkom & PT. EU ITB</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&amp;subset=latin-ext" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/fontawesome-all.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/swiper.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet">
    
</head>
<body data-spy="scroll" data-target=".fixed-top">
    
    <!-- Preloader -->
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->

@extends('layouts._navbar')

 <!-- Header -->
    <header id="header" class="ex-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Text To Speech</h1>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of ex-header -->
<div class="basic-1" style="text-align: center;">
        <div class="container">
            <div id="request" class="form-1">	
                <div class="form-container">
                            <div id="player">
                            @isset($audio)
                               <audio controls='controls' autoplay='autoplay'>{!! $audio !!}</audio>
                            @endisset
                            </div>
                                <form method="post" action="/konversi">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                            <input type="textarea" class="form-control-textarea" id="txt" name="txt" required>
                                            <label class="label-control" for="rname">Masukkan teks yang ingin diubah menjadi audio</label>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    <br>
                                    <button type="submit" class="form-control-submit-button">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@extends('layouts._footer')