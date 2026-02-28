<div class="bg-smoke space" data-bg-src="{{ asset('assets/img/bg/pattern_bg_8.jpg') }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6">
                <div class="pe-xxl-5 mb-40 mb-xl-0">
                    <div class="comparison-dental">
                        <div class="comparison-img">
                            <div class="img background-img" data-bg-src="{{ asset('assets/img/normal/before_2.jpg') }}"></div>
                            <div class="img foreground-img" data-bg-src="{{ asset('assets/img/normal/after_2.jpg') }}"></div>
                            <input type="range" min="1" max="100" value="50" class="compslider" name="compslider" id="compslider">
                            <div class="slider-button" style="left: calc(50% - 28px);"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <form action="mail.php" method="POST" class="faq-form2">
                    <h4 class="box-title text-center">Make An Appointment</h4>
                    <div class="row">
                        <div class="form-group col-12">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
                            <i class="fal fa-user"></i>
                        </div>
                        <div class="form-group col-12">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                            <i class="fal fa-envelope"></i>
                        </div>
                        <div class="form-group col-12">
                            <input type="tel" class="form-control" name="number" id="number" placeholder="Phone Number">
                            <i class="fal fa-phone"></i>
                        </div>
                        <div class="form-group col-12">
                            <select name="subject" id="subject" class="form-select">
                                <option value="" disabled selected hidden>Select Subject</option>
                                <option value="Make Appointment">Make Appointment</option>
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Medicine Help">Medicine Help</option>
                                <option value="Consultation">Consultation</option>
                            </select>
                            <i class="fal fa-chevron-down"></i>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" class="date-pick form-control" name="date" id="date-pick" placeholder="Date">
                            <i class="fal fa-calendar"></i>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" class="time-pick form-control" name="time" id="time-pick" placeholder="Time">
                            <i class="fal fa-clock"></i>
                        </div>
                        <div class="form-btn col-12">
                            <button class="th-btn btn-fw">BOOK AN APPOINTMENT</button>
                        </div>
                    </div>
                    <p class="form-messages mb-0 mt-3"></p>
                </form>
            </div>
        </div>
    </div>
</div>