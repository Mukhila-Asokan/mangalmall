@extends('profile-layouts.profile')
@section('content')
<div class="mt-1 col-lg-10 col-md-10">
    <div id="all_contacts_container" class="content-section">

         <!--why choose us section start-->
         <section class="why-choose-us">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-8">
                        <div class="section-heading mb-5">
                            <h2>Hello, Curious Minds!</h2>
                            <h6>Unveiling Ideas, Insights, and Inspiration</h6>
                        
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-lg-3">
                        <a href="#">
                            <div class="single-promo-2 custom-shadow single-promo-hover rounded-custom text-center white-bg p-5 h-100">
                                <div class="circle-icon">
                                    <span class="fas fa-newspaper text-white"></span>
                                </div>
                                <h5>Blog Count</h5>
                                <p id = "blogcount">{{ $blogcount }}</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <a href="#">
                            <div class="single-promo-2 custom-shadow single-promo-hover rounded-custom text-center white-bg p-5 h-100">
                                <div class="circle-icon">
                                    <span class="fas fa-eye text-white"></span>
                                </div>
                                <h5>Views Count</h5>
                                <p id = "viewcount">{{ $viewcount }}</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <a href="#">
                            <div class="single-promo-2 custom-shadow single-promo-hover rounded-custom text-center white-bg p-5 h-100">
                                <div class="circle-icon">
                                    <span class="fas fa-thumbs-up text-white"></span>
                                </div>
                                <h5>Likes</h5>
                                <p id = "likescount">{{ $likescount }}</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <a href="#">
                            <div class="single-promo-2 custom-shadow single-promo-hover rounded-custom text-center white-bg p-5 h-100">
                                <div class="circle-icon">
                                    <span class="fas fa-comments text-white"></span>
                                </div>
                                <h5>Total Comments</h5>
                                <p id = "totalcomments">{{ $commentscount }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>


            <!--blog section start-->
        <section class="our-blog-section gray-light-bg mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading mb-5">
                            <h2>Our Blog List</h2>
                          
                                <a href = "{{ route('blog.create') }}" class="btn btn-primary waves-effect waves-light mb-4 text-end" style = "float:right"><span class="fas fa-pencil text-white"></span> Add Blog </a> 
</div>
                       
                    </div>
                </div>
                <div class="row">
                    @foreach($blogs as $blog)
                    <div class="col-md-4">
                    <div class="single-blog-card card border-0 shadow-sm">
                            <span class="category position-absolute badge badge-pill badge-primary">{{ $blog->category->categoryname ?? 'No Category' }}</span>
                            <img src="{{ url('/').Storage::url($blog->image) }}" class="card-img-top position-relative" alt="blog">
                            <div class="card-body">
                                <div class="post-meta mb-2">
                                    <ul class="list-inline meta-list">
                                        <li class="list-inline-item">{{ $blog->created_at->format('F d, Y') }}</li>
                                        <li class="list-inline-item"><span class="fas fa-comments"></span> <span>{{ $blog->comments }}</span></li>
                                        <li class="list-inline-item"><span class="fas fa-thumbs-up"></span> <span>{{ $blog->likes }}</span></li>
                                        <li class="list-inline-item"><span class="fas fa-eye"></span> <span>{{ $blog->views }}</span> </li>
                                    </ul>
                                </div>
                                <h3 class="h5 card-title"><a href="{{ route('blog.show', $blog->id) }}">{{ $blog->title }}</a></h3>
                                
                                <a href="{{ route('blog.show', $blog->id) }}" class="detail-link">Read more <span class="ti-arrow-right"></span></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
             

       
    </div>
</div>
<div class="col-lg-2 col-md-2">
    @include('profile-layouts.rightside')
</div>
@endsection