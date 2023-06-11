@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="../../scss/dashboard.scss">
@endsection
@section('content')
    <div id="app" class="dashboard d-flex">
            
            <div class="sidebar">
                <h2>Admin Dashboard</h2>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="{{ route('admin.profile')}}">Profile</a></li>
                    <li><a href="{{ route('admin.projects.index')}}">Projects</a></li>
                    <li><a href="{{ route('admin.settings')}}">Settings</a></li>
                </ul>
            </div>
        
            <div class="main-content">
                <header>
                    <h1>Welcome {{auth()->user()->name }}</h1>
                    <div class="user-profile">
                        <img src="profile-picture.png" alt="Profile Picture">
                        <span>John Doe</span>
                    </div>
                </header>
        
                <div class="content">
                    <h2>Dashboard Overview</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel urna non dolor finibus cursus.</p>
                </div>
            </div>>
    </div>
@endsection
