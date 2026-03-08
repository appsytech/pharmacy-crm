@props([
'activity'
])

<section class="th-blog-wrapper blog-details space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 col-lg-7">
                <div class="th-blog blog-single">
                    <div class="blog-img">
                        <img src="{{ asset('assets/img/blog/blog-s-1-1.jpg') }}" alt="Blog Image">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <!-- <a class="author" href="#">
                                <i class="fal fa-user"></i>
                                By Tata Medical
                            </a> -->
                            <a href="{{ route('web.activity.index') }}">
                                <i class="fal fa-calendar"></i>
                                {{ $activity->created_at }}
                            </a>
                            <!-- <a href="#">
                                <i class="fal fa-comments"></i>
                                Comments (3)
                            </a> -->
                        </div>

                        <h2 class="blog-title">{{ $activity->title ?? '' }}</h2>

                        <p>{!! $activity->description ?? '' !!}</p>

                        <div class="share-links clearfix ">
                            <div class="row justify-content-between">
                                <div class="col-sm-auto">
                                    <span class="share-links-title">Tags:</span>
                                    <div class="tagcloud">
                                        <a href="blog.html">Medical</a>
                                        <a href="blog.html">Renovations</a>
                                    </div>
                                </div>
                                <div class="col-sm-auto text-xl-end">
                                    <span class="share-links-title">Share:</span>
                                    <div class="th-social">
                                        <a href="https://facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                        <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                                        <a href="https://linkedin.com/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                                    </div><!-- End Social Share -->
                                </div><!-- Share Links Area end -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="th-comments-wrap ">
                    <h2 class="blog-inner-title h4"><i class="fal fa-comments"></i> Comments (03)</h2>
                    <ul class="comment-list">
                        <li class="th-comment-item">
                            <div class="th-post-comment">
                                <div class="comment-avater">
                                    <img src="assets/img/blog/comment-author-1.jpg" alt="Comment Author">
                                </div>
                                <div class="comment-content">
                                    <span class="commented-on"><i class="fal fa-calendar"></i>14 March, 2023</span>
                                    <h3 class="name">Adam Jhon</h3>
                                    <p class="text">Your health and well-being are our top priorities. We take the time to listen to your concerns, answer your questions.</p>
                                    <div class="reply_and_edit">
                                        <a href="blog-details.html" class="reply-btn"><i class="fas fa-reply"></i>Reply</a>
                                    </div>
                                </div>
                            </div>
                            <ul class="children">
                                <li class="th-comment-item">
                                    <div class="th-post-comment">
                                        <div class="comment-avater">
                                            <img src="assets/img/blog/comment-author-2.jpg" alt="Comment Author">
                                        </div>
                                        <div class="comment-content">
                                            <span class="commented-on"><i class="fal fa-calendar"></i>15 March, 2023</span>
                                            <h3 class="name">Jusctin Dacon</h3>
                                            <p class="text">We understand that every patient is unique, and their healthcare needs may vary. That's why we create individualized treatment plans.</p>
                                            <div class="reply_and_edit">
                                                <a href="blog-details.html" class="reply-btn"><i class="fas fa-reply"></i>Reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="th-comment-item">
                            <div class="th-post-comment">
                                <div class="comment-avater">
                                    <img src="assets/img/blog/comment-author-3.jpg" alt="Comment Author">
                                </div>
                                <div class="comment-content">
                                    <span class="commented-on"><i class="fal fa-calendar"></i>16 March, 2023</span>
                                    <h3 class="name">Jacklin July</h3>
                                    <p class="text">Our clinic is strategically located for easy access, ensuring that you can reach us conveniently from various parts of the community.</p>
                                    <div class="reply_and_edit">
                                        <a href="blog-details.html" class="reply-btn"><i class="fas fa-reply"></i>Reply</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div> <!-- Comment end --> <!-- Comment Form -->

                <div class="th-comment-form ">
                    <div class="form-title">
                        <h3 class="blog-inner-title h4 mb-2"><i class="fa-solid fa-reply"></i> Leave a Comment</h3>
                        <p class="form-text">Your email address will not be published. Required fields are marked *</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" placeholder="Your Name*" class="form-control">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" placeholder="Your Email*" class="form-control">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div class="col-12 form-group">
                            <input type="text" placeholder="Website" class="form-control">
                            <i class="far fa-globe"></i>
                        </div>
                        <div class="col-12 form-group">
                            <textarea placeholder="Write a Comment*" class="form-control"></textarea>
                            <i class="far fa-pencil"></i>
                        </div>
                        <div class="col-12 form-group mb-0">
                            <button class="th-btn">Post Comment</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-4 col-lg-5">
                <x-web.pages.common-ui.side-category-widget.wrapper>
                    <x-slot>
                        <!-- <x-web.pages.common-ui.recent-post.wrapper /> -->
                        <x-web.pages.common-ui.tags.wrapper />
                    </x-slot>
                </x-web.pages.common-ui.side-category-widget.wrapper>
            </div>
        </div>
    </div>
</section>