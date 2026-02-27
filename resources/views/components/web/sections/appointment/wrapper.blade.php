<div class="overflow-hidden space">
    <div class="container">
        <div class="appointment-row">
            <div class="schedule-box">
                <div class="shape"></div>
                <h3 class="box-title">Working Hours</h3>
                <p class="box-text">Variations of passages amt available are anything embarrassing.</p>
                <p class="box-timing">Monday - Tuesday: <span>9am - 6pm</span></p>
                <p class="box-timing">Wednesday - Thursday: <span>8am - 5pm </span></p>
                <p class="box-timing">Friday: <span>7am - 10pm</span></p>
                <p class="box-timing">Saturday: <span>10am - 7pm </span></p>
                <p class="box-timing">Sunday: <span>Colsed</span></p>
            </div>
            <div class="form-wrap">
                <div class="img-box4">
                    <div class="img1">
                        <img src="{{ asset('assets/img/normal/form_1_1.jpg') }}" alt="Image">
                    </div>
                    <div class="img2">
                        <img src="{{ asset('assets/img/normal/form_1_2.jpg') }}" alt="Image">
                    </div>
                </div>
                <form action="mail.php" method="POST" class="appointment-form">
                    <h4 class="form-title">Make An Appointment</h4>
                    <div class="row">
                        <div class="form-group col-12">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
                        </div>
                        <div class="form-group col-12">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                        </div>
                        <div class="form-group col-12">
                            <input type="tel" class="form-control" name="number" id="number" placeholder="Phone Number">
                        </div>
                        <div class="form-group col-12">
                            <select name="subject" id="subject" class="form-select">
                                <option value="" disabled selected hidden>Choose Department</option>
                                <option value="Make Appointment">Make Appointment</option>
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Medicine Help">Medicine Help</option>
                                <option value="Consultation">Consultation</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" class="date-pick form-control" name="date" id="date-pick" placeholder="Date">
                        </div>
                        <div class="form-group col-6">
                            <input type="text" class="time-pick form-control" name="time" id="time-pick" placeholder="Time">
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