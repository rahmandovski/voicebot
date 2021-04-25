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
                 <h1>Prediksi</h1>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</header> <!-- end of ex-header -->
<div class="basic-1">
        <div class="container">
              <div class="panel-body">
                <div id="controls" style="text-align: center;">
                    <a class= "form-control-submit-buttone" type="button"href="/tes">Rekam</a>
                </div>
                
              </div>
            </div>
        </div>
 <!-- Request -->
    <div id="request" class="form-1">
        <div class="container">
            <div class="row">
                <table class=table>
                    <tr>
                        <th>No</th>
                        <th >File Record</th>
                        <th class="col-6">Transcript</th>
                        <th class="col-6">Model</th>
                        <th class="col-6">Prediksi</th>

                    </tr>
                    <tr>
                    @foreach($file as $key =>$obj)
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{$obj->path_audio}}</td>
                        <td>
                            @if(is_null($obj->script))
                                <a class= "btn btn-blue" type="button"href="transcript/{{$obj->id}}">Transcript</a>
                            @else
                                {{$obj->script}}
                            @endif
                        </td>
                        <td>{{$obj->model}}</td>
                        <td>
                            @if(is_null($obj->konteks1))
                            <form method="post" action="/cekprediksi/{{$obj->id}}">
                                {{csrf_field()}}
                                <div class="row">
                                <select class="form-control col-md-6" name="model">
                                    <option value="0" disabled selected>Pilih Model</option>
                                    <option value="1">DT - Test Acc : 89</option>
                                    <option value="4">4 - Test Acc : 77</option>
                                    <option value="5">5 - Test Acc : 76</option>
                                    <option value="6">6 - Test Acc : 75</option>
                                    <option value="7">7 - Test Acc : 75</option>
                                    <option value="8">8 - Test Acc : 74</option>
                                    <option value="13">13 - Test Acc : 77</option>
                                </select>
                                <button type="submit">Predict</button>
                                </div>
                            </form>
                            @else
                                {{$obj->konteks1}}<br>
                                {{$obj->konteks2}}<br>
                                {{$obj->konteks3}}<br>
                                {{$obj->konteks4}}<br>
                            @endif
                        </td>
                    </tr>
                        @endforeach
                </table>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of form-1 -->

    <!-- end of request -->


      
                
@extends('layouts._footer')