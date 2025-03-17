<!--blog-section section start-->
<section class="feature-promo-seciton ptb-50">
        <div class="container">
            <div class="row justify-content-center">

            @foreach($userblog as $blog)
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
                            <h3 class="h5 card-title"><a href="{{ route('guestblog.show', $blog->id) }}">{{ $blog->title }}</a></h3>
                            
                            <a href="{{ route('guestblog.show', $blog->id) }}" class="detail-link">Read more <span class="ti-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
</section>