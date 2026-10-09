@php
    $courseOptions = [
        'Personal Growth and Renewal',
        'Animation of Lay Mission Partners',
        'Preparation for the Salesian Rector',
        'Renewal Course and Retreat for Silver Jubilarians',
        'Counselling Skills and Practice',
        'Spiritual Direction and Pastoral Accompaniment',
        'Guided Retreat',
        'Formation of Formators',
        'Preparation for Final Vows',
        'Animation of Young Salesian Priests and Brothers',
    ];
@endphp

<section class="registration-section">
    <div class="container">
        <div class="registration-shell">
            <div id="registrationAlert" class="alert d-none" role="alert"></div>
            <div id="registrationSuccessPopup" class="registration-popup d-none" role="status" aria-live="polite">
                <div class="registration-popup-card">
                    <div class="registration-popup-icon">✓</div>
                    <h4>Registration Submitted</h4>
                    <p id="registrationSuccessMessage">Your registration has been submitted successfully!</p>
                </div>
            </div>

            <form id="registrationForm" action="{{ route('frontend.registration.store') }}" method="POST">
                @csrf

                <h3>Basic Details</h3>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Title and Dates of the Course <span>*</span></label>
                        <select name="course_title_dates" class="form-select" required>
                            <option value="">Select</option>
                            @foreach ($courseOptions as $course)
                                <option value="{{ $course }}">{{ $course }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Name <span>*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email <span>*</span></label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact Address <span>*</span></label>
                        <textarea name="contact_address" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone <span>*</span></label>
                        <input type="tel" name="phone" class="form-control" required oninput="this.value = this.value.replace(/[^0-9+ -]/g, '');" maxlength="30">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Country <span>*</span></label>
                        <input type="text" name="country" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth <span>*</span></label>
                        <input type="date" name="date_of_birth" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Diocese/Congregation <span>*</span></label>
                        <input type="text" name="diocese_congregation" class="form-control" required>
                    </div>
                </div>

                <h3>Education Details</h3>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Religious/Theological (Non academic) <span>*</span></label>
                        <input type="text" name="religious_theological_non_academic" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Religious/Theological (Academic) <span>*</span></label>
                        <textarea name="religious_theological_academic" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Secular</label>
                        <textarea name="secular" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Present Ministry <span>*</span></label>
                        <textarea name="present_ministry" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Your Interests</label>
                        <textarea name="interests" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-12">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI') }}"></div>
                        <div id="registrationRecaptchaError" class="registration-field-error d-none"></div>
                    </div>
                    <div class="col-12">
                        <button type="submit" id="registrationSubmitBtn" class="registration-submit-btn">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
