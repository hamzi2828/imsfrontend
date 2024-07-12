<div class="tab-pane" id="product-tab-reviews">
    <div class="row mb-4">
        @if(!auth () -> check ())
            <h1 class="mt-3">Login to add your reviews.</h1>
        @else
            <div class="col-xl-12 col-lg-12 mb-4">
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
                                            <a href="#">{{ $review -> user ?-> name }}</a>
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