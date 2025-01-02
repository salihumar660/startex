<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Star Tex</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo/logo.png') }}">

    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Pignose Calender -->
    <link href="{{ asset('./plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('./plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .form-control,.form-select{
            outline: none !important;
            border: 2px solid rgb(0, 0, 0)  !important;
        }
        .form-control:active ,.form-select:active{
            outline: none !important;
            border: 2px solid rgba(0, 0, 0, 0.3) !important;
            box-shadow: none !important;
        }
        .form-control:focus ,.form-select:focus{
            outline: none !important;
            border: 2px solid rgba(0, 0, 0, 0.3)  !important;
            box-shadow: none !important;
        }
    </style>
</head>

<body style="background-image: url('{{asset("images/logo/oil2.jpg")}}'); background-position: center;background-repeat:no-repeat;background-size:cover">
