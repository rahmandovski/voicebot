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

 <!-- Request -->
    <div id="request" class="form-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                        <form  method="post" action="/cekprediksi">
                            {{csrf_field()}}
                            <label for="sel1">Pilih Model:</label>
                            <select class="form-control" name="model">
                                <option value="1">DT - Test Acc : 89</option>
                                <option value="4">4 - Test Acc : 77</option>
                                <option value="5">5 - Test Acc : 76</option>
                                <option value="6">6 - Test Acc : 75</option>
                                <option value="7">7 - Test Acc : 75</option>
                                <option value="8">8 - Test Acc : 74</option>
                                <option value="13">13 - Test Acc : 77</option>

                            </select>
                </div>
                        <div class="col-lg-6">
                            <!-- Request Form -->
                            <div class="text-container">
                                <h2>Kalimat</h2>
                        
                                    <div class="form-group">
                                
                                        <input type="textarea" class="form-control-textarea" id="kalimat" name="kalimat" required value="<?php echo $kalimat ?? '' ?>">
                                        <label class="label-control" for="rname">Masukkan kalimat yang ingin diketahui kelasnya</label>
                                        <div class="help-block with-errors"></div>
                                        <br>
                                        <button type="submit" class="form-control-submit-button">Submit</button>
                                    </div>
                        
                            </div> <!-- end of form-container -->

                        </div> <!-- end of col -->
                </form>
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2>Kelas:</h2>
                        <ul class="list-unstyled li-space-lg">
                            @isset($kelas)
                                @foreach ($kelas as $kelass)
                                    <li class="media">
                                        <i class="fas fa-check"></i>
                                        <div class="media-body">{{ $kelass }}</div>
                                    </li>
                                @endforeach
                            @endisset
                        </ul>
                    </div> <!-- end of text-container -->
                    
                    <!-- end of request form -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of form-1 -->

    <!-- end of request -->


      
                
@extends('layouts._footer')