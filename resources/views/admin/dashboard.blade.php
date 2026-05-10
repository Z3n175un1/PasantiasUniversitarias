<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('uworkflow-logo.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen w-screen">

@include('navbar')

@extends('adminlte::page')

@section('title', 'Admin | Dashboard')

@section('content_header')
    <h1>Bienvenido al panel de administración</h1>
@stop

@section('content')
    <p>Aquí puedes gestionar las pasantías y empresas.</p>
@stop