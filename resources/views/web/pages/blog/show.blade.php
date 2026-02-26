@extends('web.layouts.main')

@section('content')

<!--==============================
    Breadcumb
============================== -->
<div class="breadcumb-wrapper " data-bg-src="assets/img/bg/breadcumb-bg.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Blog Details</h1>
            <ul class="breadcumb-menu">
                <li><a href="home-medical-clinic.html">Home</a></li>
                <li>Blog Details</li>
            </ul>
        </div>
    </div>
</div><!--==============================
        Blog Area
    ==============================-->
<section class="th-blog-wrapper blog-details space-top space-extra-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 col-lg-7">
                <div class="th-blog blog-single">
                    <div class="blog-img">
                        <img src="assets/img/blog/blog-s-1-1.jpg" alt="Blog Image">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <a class="author" href="blog.html"><i class="fal fa-user"></i>By Tata Medical</a>
                            <a href="blog.html"><i class="fal fa-calendar"></i>21 June, 2024</a>
                            <a href="blog-details.html"><i class="fal fa-comments"></i>Comments (3)</a>
                        </div>
                        <h2 class="blog-title">How Business Is Taking Over & What to Do About It</h2>
                        <p>We offer flexible appointment scheduling options to accommodate your busy lifestyle. Whether you prefer to book in advance or need a same-day appointment, we strive to make the process as seamless as possible.</p>
                        <p>Especially in light of the ongoing COVID-19 pandemic, we maintain rigorous safety protocols and hygiene standards to ensure the well-being of our patients and staff. Your health and safety are our utmost priority.</p>

                        <blockquote>
                            <p>Choose organic food, not only for a healthier you but for a happier planet too. It's a conscious choice that nourishes both body and Earth.</p>
                            <cite>Michel Clarck</cite>
                        </blockquote>

                        <div class="row pt-2 mt-5">
                            <div class="col-md-6 mb-4">
                                <img class="w-100 rounded-20" src="assets/img/blog/blog_inner_1.jpg" alt="Blog Image">
                            </div>
                            <div class="col-md-6 mb-4">
                                <img class="w-100 rounded-20" src="assets/img/blog/blog_inner_2.jpg" alt="Blog Image">
                            </div>
                        </div>
                        <h3 class="h5 mt-1">The medical experts transplant the heart</h3>
                        <p class="mb-4">Our clinic is equipped with modern facilities and advanced medical technology to ensure accurate diagnoses and effective treatments. This enables us to provide you with the highest standard of care.</p>
                        <div class="checklist mb-25">
                            <ul>
                                <li><i class="fas fa-check-circle"></i> That extremely painful or again is there anyone.</li>
                                <li><i class="fas fa-check-circle"></i> Indignation and dislike men who are so beguiled and demoralized.</li>
                                <li><i class="fas fa-check-circle"></i> Desires these cases are perfectly simple easy distinguish.</li>
                                <li><i class="fas fa-check-circle"></i> That extremely painful or again that is there anyone.</li>
                            </ul>
                        </div>
                        <p class="mb-n2">From primary care and pediatrics to specialized services like dermatology, orthopedics, and women's health, we offer a wide spectrum of medical services under one roof.</p>

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
                <aside class="sidebar-area">
                    <div class="widget widget_search  ">
                        <form class="search-form">
                            <input type="text" placeholder="Enter Keyword">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>
                    <div class="widget widget_categories  ">
                        <h3 class="widget_title">Categories</h3>
                        <ul>
                            <li>
                                <a href="blog.html">Cardiology</a>
                            </li>
                            <li>
                                <a href="blog.html">Gastroenterologist</a>
                            </li>
                            <li>
                                <a href="blog.html">Dental Care</a>
                            </li>
                            <li>
                                <a href="blog.html">Ophthalmology</a>
                            </li>
                            <li>
                                <a href="blog.html">Orthopedics</a>
                            </li>
                            <li>
                                <a href="blog.html">Plastic Surgeons</a>
                            </li>
                            <li>
                                <a href="blog.html">Neurology</a>
                            </li>
                        </ul>
                    </div>
                    <div class="widget  ">
                        <h3 class="widget_title">Recent Posts</h3>
                        <div class="recent-post-wrap">
                            <div class="recent-post">
                                <div class="media-img">
                                    <a href="blog-details.html"><img src="assets/img/blog/recent-post-1-1.jpg" alt="Blog Image"></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="post-title"><a class="text-inherit" href="blog-details.html">How Business Is Taking Over & What to Do About It</a></h4>
                                    <div class="recent-post-meta">
                                        <a href="blog.html"><i class="fal fa-calendar"></i>21 Jun, 2024</a>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-post">
                                <div class="media-img">
                                    <a href="blog-details.html"><img src="assets/img/blog/recent-post-1-2.jpg" alt="Blog Image"></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="post-title"><a class="text-inherit" href="blog-details.html">Health vs. Wealth Navigate Business in Medicine</a></h4>
                                    <div class="recent-post-meta">
                                        <a href="blog.html"><i class="fal fa-calendar"></i>22 Jun, 2024</a>
                                    </div>
                                </div>
                            </div>
                            <div class="recent-post">
                                <div class="media-img">
                                    <a href="blog-details.html"><img src="assets/img/blog/recent-post-1-3.jpg" alt="Blog Image"></a>
                                </div>
                                <div class="media-body">
                                    <h4 class="post-title"><a class="text-inherit" href="blog-details.html">Preserving Care Strategy Amidst Food Changes</a></h4>
                                    <div class="recent-post-meta">
                                        <a href="blog.html"><i class="fal fa-calendar"></i>23 Jun, 2024</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget widget_tag_cloud  ">
                        <h3 class="widget_title">Popular Tags</h3>
                        <div class="tagcloud">
                            <a href="blog.html">Skin Care</a>
                            <a href="blog.html">Advice</a>
                            <a href="blog.html">Solution</a>
                            <a href="blog.html">Doctors</a>
                            <a href="blog.html">Medical</a>
                            <a href="blog.html">Hospital</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@endsection