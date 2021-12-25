
<link href="{{ URL::asset('https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css') }}" rel='stylesheet'>
<link rel="stylesheet" href=" {{ asset('sidebar/css/style.css') }} ">
<style> #app{display: none}</style>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<div class="sidebar">
    <div class="logo-details">
      
        <i class='bx bx-home icon'></i>
        <div class="logo_name">alamera</div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">

        <li>
            <a href="/depots">
                <i class='bx bxs-brightness'></i>
                <span class="links_name">Add-Depot</span>
            </a>
            <span class="tooltip">Add-Depot</span>
        </li>
        
        <li>
            <a href="/laboratorys">
                <i class='bx bxs-brightness'></i>
                <span class="links_name">Add-Laboratory</span>
            </a>
            <span class="tooltip">Add-Laboratory</span>
        </li>
        <li>
            <a href="/crus">
                <i class='bx bxs-brightness'></i>
                <span class="links_name">Add-cru</span>
            </a>
            <span class="tooltip">Add-cru</span>
        </li>

 
       
            <li>
                <a  href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                                  <i class='bx bx-log-out' id="log_out" ></i>
                                  <span class="links_name">logout</span>
           
             </a>
                
        
            <span class="tooltip">logout</span>
            </li>
          
    </ul>
</div>







<script type="text/javascript" src="{{ URL::asset('sidebar/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js') }}"></script>