
@php
            $Review_with_login = optional(siteSettings()->settings)->reviews_enable_with_login;

                $averageRating = $product->reviews->avg('rating');
                $totalReviews = $product->reviews->count();
                $recommendedCount = $product->reviews->where('rating', '>=', 4)->count();
                $recommendedPercentage = $totalReviews > 0 ? ($recommendedCount / $totalReviews) * 100 : 0;
    
            $totalReviews = $product->reviews->count();
            $ratings = [
                5 => $product->reviews->where('rating', 5)->count(),
                4 => $product->reviews->where('rating', 4)->count(),
                3 => $product->reviews->where('rating', 3)->count(),
                2 => $product->reviews->where('rating', 2)->count(),
                1 => $product->reviews->where('rating', 1)->count(),
            ];
        @endphp
        
<div class="tab-pane" id="product-tab-reviews">
    <div class="row mb-4">

        <div class="col-xl-4 col-lg-5 mb-4"> 
            <div class="ratings-wrapper">
    
            
            <div class="avg-rating-container">
                <h4 class="avg-mark font-weight-bolder ls-50">{{ number_format($averageRating, 1) }}</h4>
                <div class="avg-rating">
                    <p class="text-dark mb-1">Average Rating</p>
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: {{ ($averageRating / 5) * 100 }}%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="#" class="rating-reviews">{{ $totalReviews }} (Reviews)</a>
                    </div>
                </div>
            </div>
            <div class="ratings-value d-flex align-items-center text-dark ls-25">
                <span class="text-dark font-weight-bold">{{ number_format($recommendedPercentage, 1) }}%</span> Recommended
                <span class="count">({{ $recommendedCount }} of {{ $totalReviews }})</span>
            </div>
    
        <div class="ratings-list">
            @foreach($ratings as $rating => $count)
                @php
                    $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                @endphp
                <div class="ratings-container">
                    <div class="ratings-full">
                        <span class="ratings" style="width: {{ $rating * 20 }}%;"></span>
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <div class="progress-bar progress-bar-sm ">
                        <span style="width: {{ $percentage }}%;"></span>
                    </div>
                    <div class="progress-value">
                        <mark>{{ number_format($percentage, 1) }}%</mark>
                    </div>
                </div>
            @endforeach
        </div>
        
            </div>
        </div>

        
        
        @if(!$Review_with_login)
            @if(!auth () -> check () )
                <h3 class="col-xl-8 col-lg-7 mb-4">Login to add your reviews.</h3>
            @else
                <div class="col-xl-8 col-lg-7 mb-4">
                    <div class="review-form-wrapper">
                        <h3 class="title tab-pane-title font-weight-bold mb-1">
                            Submit Your Review 
                        </h3>
                        <form action="{{ route ('reviews.store', ['product' => $product -> slug]) }}" method="POST"
                            class="review-form">
                            @csrf
                            <div class="rating-form">
                                <label for="rating">Your Rating Of This Product :</label>
                                <span class="rating-stars">
                                <a class="star-1" href="#">1</a>
                                <a class="star-2" href="#">2</a>
                                <a class="star-3" href="#">3</a>
                                <a class="star-4" href="#">4</a>
                                <a class="star-5" href="#">5</a>
                            </span>
                                <select name="rating" id="rating" required=""
                                        style="display: none;">
                                    <option value="">Rate…</option>
                                    <option value="5">Perfect</option>
                                    <option value="4">Good</option>
                                    <option value="3">Average</option>
                                    <option value="2">Not that bad</option>
                                    <option value="1">Very poor</option>
                                </select>
                            </div>
                            <textarea cols="30" rows="6" name="review"
                                    placeholder="Write Your Review Here..."
                                    class="form-control"
                                    id="review"></textarea>
                            <button type="submit" class="btn btn-dark">Submit Review</button>
                        </form>
                    </div>
                </div>
            @endif
        @endif

        @if($Review_with_login)
            @if(!auth () -> check () )
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="review-form-wrapper">
                    <h3 class="title tab-pane-title font-weight-bold mb-1">
                        Submit Your Review
                    </h3>
                    <form id="review-form" action="{{ route('reviews.store', ['product' => $product->slug]) }}" method="POST" class="review-form">
                        @csrf
                        <div class="rating-form">
                            <label for="rating">Your Rating Of This Product :</label>
                            <span class="rating-stars">
                                <a class="star-1" href="#">1</a>
                                <a class="star-2" href="#">2</a>
                                <a class="star-3" href="#">3</a>
                                <a class="star-4" href="#">4</a>
                                <a class="star-5" href="#">5</a>
                            </span>
                            <select name="rating" id="rating" required="" style="display: none;">
                                <option value="">Rate…</option>
                                <option value="5">Perfect</option>
                                <option value="4">Good</option>
                                <option value="3">Average</option>
                                <option value="2">Not that bad</option>
                                <option value="1">Very poor</option>
                            </select>
                        </div>
                        <textarea cols="30" rows="6" name="review" placeholder="Write Your Review Here..." class="form-control" id="review"></textarea>
            
                        <div class="row gutter-md">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="author" placeholder="Your Name" id="author" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" placeholder="Your Email" id="email" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark">Submit Review</button>
                    </form>
                </div>
            </div>
            

            
            
            @else
                <div class="col-xl-8 col-lg-7 mb-4">
                    <div class="review-form-wrapper">
                        <h3 class="title tab-pane-title font-weight-bold mb-1">
                            Submit Your Review 
                        </h3>
                        <form action="{{ route ('reviews.store', ['product' => $product -> slug]) }}" method="POST"
                            class="review-form">
                            @csrf
                            <div class="rating-form">
                                <label for="rating">Your Rating Of This Product :</label>
                                <span class="rating-stars">
                                <a class="star-1" href="#">1</a>
                                <a class="star-2" href="#">2</a>
                                <a class="star-3" href="#">3</a>
                                <a class="star-4" href="#">4</a>
                                <a class="star-5" href="#">5</a>
                            </span>
                                <select name="rating" id="rating" required=""
                                        style="display: none;">
                                    <option value="">Rate…</option>
                                    <option value="5">Perfect</option>
                                    <option value="4">Good</option>
                                    <option value="3">Average</option>
                                    <option value="2">Not that bad</option>
                                    <option value="1">Very poor</option>
                                </select>
                            </div>
                            <textarea cols="30" rows="6" name="review"
                                    placeholder="Write Your Review Here..."
                                    class="form-control"
                                    id="review"></textarea>
                            <button type="submit" class="btn btn-dark">Submit Review</button>
                        </form>
                    </div>
                </div>
            @endif
    @endif


    </div>
    
    <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
        <div class="tab-content">
            <div class="tab-pane active" id="show-all">
                <ul class="comments list-style-none">
                    @if($product -> reviews -> count() > 0)
                        @foreach($product -> reviews as $review)
                            <li class="comment">
                                <div class="comment-body">
                                    <div class="comment-content">
                                        <h4 class="comment-author">
                                            <a href="#">
                                                @if ($review->user_id )
                                                 {{ $review -> user ?-> name }}
                                                @endif
                                                @if($review -> user_id == 0)
                                                {{ $review ->user_name }}
                                                @endif

                                            </a>
                                            <span class="comment-date">
                                                {{ $review -> created_at -> diffForHumans() }}
                                            </span>
                                        </h4>
                                        <div class="ratings-container comment-rating">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: {{ ($review -> rating * 20) }}%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                        </div>
                                        <p>{{ $review -> review }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>