<div class="space-bottom">
    <div class="container">
        <form action="{{ route('inquiry.store') }}" method="POST" class="contact-form  ajax-form" data-bg-src="{{ asset('assets/img/bg/contact_form_bg.png') }}">
            @csrf
            <div class="input-wrap">
                <h2 class="sec-title">Get In Touch!</h2>
                <div class="row">
                    <div class="form-group col-12">
                        <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Your Name" required>
                        <i class="fal fa-user"></i>
                    </div>
                    <div class="form-group col-12">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                        <i class="fal fa-envelope"></i>
                    </div>
                    <div class="form-group col-12">
                        <input type="tel" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number">
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
                    <div class="form-group col-12">
                        <textarea name="message" id="message" cols="30" rows="3" class="form-control" placeholder="Type Appointment Note..." required></textarea>
                        <i class="fal fa-pencil"></i>
                    </div>
                    <div class="form-btn col-12">
                        <button type="submit" class="th-btn btn-fw">BOOK AN APPOINTMENT</button>
                    </div>
                </div>
                <p class="form-messages mb-0 mt-3"></p>
            </div>

        </form>
    </div>
</div>