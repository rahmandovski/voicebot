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
    <title>Voice Bot -  PLTI Kelompok 11</title>
    
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
        <!-- <div class="container">
            <div class="row">
            </div> 
        </div> -->
    </header> 
    <!-- end of header -->
        <div class="container">
            <div class="card">

                <div class="card-body">
                    <br>
                 <div class="col-md-12" style="text-align: center;">
                    <h1>Voicebot Keluhan Pelanggan</h1>
                    <p>Dirancang sebagai pra-syarat untuk mendapatkan nilai tugas akhir PLTI</p>
                </div>
                    <br>
                    <div id="controls" style="text-align: center;">
                        <button id="recordButton" class="form-control-submit-button">Record</button>
                         <button id="stopButton" class="form-control-submit-button" disabled>Stop</button>
                        <div>
                            <small id="formats">Format: mulai merekam untuk melihat sample rate</small>
                        </div>
                        
                    </div>
                    <br>
                    <div class="card border-left-4 border-left-accent card-sm mb-lg-32pt" id="section">
                        <div class="card-body pl-16pt">
                            <div class="media flex-wrap align-items-center">
                                <div class="media flex-wrap align-items-center">
                                    <div class="media-body" style="min-width: 180px">
                                        <strong>Anda:   </strong><small id="outputYou">...</small>
                                         <a href="#myModal" id="buttonIya" data-toggle="modal" data-target="#myModal"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-left-4 border-left-accent card-sm mb-lg-32pt" id="section">
                        <div class="card-body pl-16pt">
                            <div class="media flex-wrap align-items-center">
                                <div class="media flex-wrap align-items-center">
                                    <div class="media-body" style="min-width: 180px">
                                        <strong>Bot:    </strong><small id="outputBot"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer id="controls">
                        <audio id="outputBotAudio" autoplay controls></audio>
                    </div>
                </div>
            </div>
        </div>
<!-- Modal -->
  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Kalimat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formKalimat">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="kalimat">Kalimat</label>
                        <input type="text" class="form-control" name ="kalimat" placeholder="Kalimat">
                    </div>
                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Submit</button>
            </div>
                </form>
        </div>
    </div>
</div>

@extends('layouts._footer')
<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>

<script src="//code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="{{asset('assets/scripts/app.js')}}"></script>
