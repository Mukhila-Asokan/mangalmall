@extends('layouts.guest')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">

 <style>
    .single-service-plane
    {
        border-top-right-radius: 100px!important;
        border-bottom-left-radius: 100px!important;
    }
    .bg-flower-bot {
        position: absolute;
        bottom: 0px;
        left: 0;
        opacity: .2;
        z-index: -1;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        pointer-events: none;
    }
 </style>

 @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<!--breadcrumb bar start-->
<div class="breadcrumb-bar py-3 gray-light-bg border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="custom-breadcrumb">
                        <ol class="breadcrumb d-inline-block bg-transparent list-inline py-0 pl-0">
                            <li class="list-inline-item breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="list-inline-item breadcrumb-item active"><a href="#">Blog</a></li>
                            
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumb bar end-->

<div class="container py-3">
    <div class="row">
        
<div class="mt-6 col-lg-10 col-md-10">
    <div id="all_contacts_container" class="content-section">
    <div class="row">
        <div class="mt-1 col-lg-8 col-md-8">
    <article class="post">
    <div class="post-preview"><img src="{{ url('/').Storage::url($userblog->image) }}" alt="article" class="img-fluid" /></div>
            <div class="post-wrapper">
                <div class="post-header">
				
				
                    
					<h1 class="post-title">{{ $userblog->title }}</h1>
					
					<div class="d-flex justify-content-between align-items-center mt-2">
					<div>
					
                    <ul class="post-meta">
                        <li>{{ $userblog->created_at->format('F d, Y') }}</li>
                        <li>In <a href="#">{{ $userblog->category->categoryname ?? 'No Category' }}</a></li>
                        <li><a href="#"><span class="fas fa-comments"></span> {{ $userblog->comments }} </a></li>
                        <li><span class="fas fa-thumbs-up"></span> <span id="like-count"> {{ $userblog->likes }} </span></li>
                    </ul>
					</div>
                    <div class="text-end">
					<a href = "{{ route('login') }}" class="btn btn-danger">❤️ Like</a>
				</div>
				</div>				
								
								
				
				
				</div>
                <div class="post-content">
                    {!! $userblog->content !!}
                </div>
                <div class="post-footer">
                  

                    <div class="d-flex justify-content-between align-items-center">
    <div>
    <div class="post-tags">
                      
                      @foreach(explode(',', $userblog->tags) as $tag)
                         <a href="#">{{ trim($tag) }}</a>
                      @endforeach
              </div>
    </div>

    <div class="post-share">
        <ul class="list-inline m-0">
            <li class="list-inline-item"><a href="#"><span class="fab fa-facebook-f"></span></a></li>
            <li class="list-inline-item"><a href="#"><span class="fab fa-twitter"></span></a></li>
            <li class="list-inline-item"><a href="#"><span class="fab fa-linkedin"></span></a></li>
            <li class="list-inline-item"><a href="#"><span class="fab fa-instagram"></span></a></li>
        </ul>
    </div>
</div>



                </div>
		 </div>
    </article>
       
	</div>
        <div class="col-lg-4 col-md-4">
        <div class="sidebar-right pl-4">
             <!-- Search widget-->
             <aside class="widget widget-search">
                <form>
                    <input class="form-control" type="search" placeholder="Type Search Words">
                    <button class="search-button" type="submit"><span class="ti-search"></span></button>
                </form>
            </aside>
             <!-- Categories widget-->
             <aside class="widget widget-categories">
                <div class="widget-title">
                    <h6>Categories</h6>
                </div>
                <ul>
                    @foreach($categories as $category)
                    <li><a href="#">{{ $category->categoryname }} <span class="float-right">{{ $category->blogs->count() }}</span></a></li>
                    @endforeach                  
                </ul>
            </aside>
              <!-- Tags widget-->
              <aside class="widget widget-tag-cloud">
                <div class="widget-title">
                    <h6>Tags</h6>
                </div>
                <div class="tag-cloud">
                @foreach($tags as $tag)
                    <a href="#">{{ $tag->tagname }}</a>
                @endforeach
                </div>
            </aside>

                <!-- Recent entries widget-->
                <aside class="widget widget-recent-entries-custom">
                    <div class="widget-title">
                        <h6>Recent Posts</h6>
                    </div>
                    <ul>
                        @foreach($recentpost as $recentblog)
                        <li class="clearfix">
                            <div class="wi"><a href="{{ route('guestblog.show', $recentblog->id) }}"><img src="{{ url('/').Storage::url($recentblog->image) }}" alt="{{ $recentblog->category->categoryname ?? 'No Category' }}" class="img-fluid rounded" /></a></div>
                            <div class="wb"><a href="{{ route('guestblog.show', $recentblog->id) }}">{{ $recentblog->title }}</a><span class="post-date">{{ $recentblog->created_at->format('F d, Y') }}</span></div>
                        </li>
                        @endforeach
                       
                    </ul>
                </aside>



        </div>
        </div>

        <hr>
    </div>    
</div>
</div>

<div class="col-lg-2 col-md-2">
@include('profile-layouts.rightside')
</div>
    </div>
</div>
@endsection