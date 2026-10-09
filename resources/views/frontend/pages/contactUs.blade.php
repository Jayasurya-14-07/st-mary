@extends('frontend.layouts.subpage')
@section('title', 'Contact Us')
@section('content')

    <section class="page-banner text-center text-white">
        <div class="container position-relative z-10">
            <h2 class="display-4 sub-page-title mb-3" data-aos="fade-down">Contact Us</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0" data-aos="fade-up" data-aos-delay="100">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="contact-message-section py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="contact-panel h-100">
                        <span class="contact-eyebrow">Get in touch</span>
                        <h2>We'd love to hear from you</h2>
                        <p class="contact-intro">
                            Reach out to us for programme details, registration guidance and any other information about DBRC.
                        </p>

                        <div class="contact-info-list">
                            <div class="contact-info-item">
                                <i class="bi bi-geo-alt"></i>
                                <div>
                                    <h5>Visit us</h5>
                                    <p>Don Bosco Renewal Centre,<br>Bangalore - 560 076, India</p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <i class="bi bi-telephone"></i>
                                <div>
                                    <h5>Call us</h5>
                                    <p><a href="tel:+919353860013">+91 93538 60013</a></p>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <i class="bi bi-envelope"></i>
                                <div>
                                    <h5>Email us</h5>
                                    <p><a href="mailto:admitdbrc@gmail.com">admitdbrc@gmail.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left">
                    <div class="contact-panel">
                        <span class="contact-eyebrow">Send a message</span>
                        <h2>How can we help?</h2>

                        <div id="contactAlert" class="alert d-none" role="alert"></div>

                        <form id="contactForm" action="{{ route('frontend.pages.contactUs.store') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Your name <span>*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email address <span>*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control"
                                        oninput="this.value = this.value.replace(/[^0-9+ -]/g, '');" maxlength="20">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Subject</label>
                                    <input type="text" name="subject" value="{{ old('subject') }}" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" class="form-control" rows="5">{{ old('message') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <div class="g-recaptcha"
                                        data-sitekey="{{ env('RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI') }}"></div>
                                    @error('g-recaptcha-response')
                                        <div class="feedback-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" id="submitBtn" class="contact-submit-btn">
                                        <i class="bi bi-send-fill"></i>
                                        <span>Send Message</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="h-96 w-full" data-aos="fade-up">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3552.6310983582384!2d93.6245474!3d27.073390000000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x374407c460a90fdf%3A0xecbf93d0f6fdab4b!2sDon%20Bosco%20School%2C%20Itanagar!5e0!3m2!1sen!2sin!4v1779519185835!5m2!1sen!2sin"
            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <style>
        .contact-message-section {
            background: #fbf5ff;
        }

        .contact-panel {
            background: #fff;
            border: 1px solid #e3c9ff;
            border-radius: 8px;
            padding: 36px;
        }

        .contact-eyebrow {
            color: #7c35f2;
            display: inline-block;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .28em;
            margin-bottom: 14px;
            text-transform: uppercase;
        }

        .contact-panel h2 {
            color: #7736ee;
            font-size: 32px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 18px;
        }

        .contact-intro {
            color: #59697a;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .contact-info-list {
            display: grid;
            gap: 24px;
        }

        .contact-info-item {
            display: flex;
            gap: 18px;
        }

        .contact-info-item i {
            color: #7c35f2;
            font-size: 22px;
            line-height: 1;
            margin-top: 4px;
        }

        .contact-info-item h5,
        .contact-panel .form-label {
            color: #6f2fff;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .contact-info-item p {
            color: #172033;
            line-height: 1.65;
            margin: 0;
        }

        .contact-info-item a {
            color: inherit;
            text-decoration: none;
        }

        .contact-panel .form-label span {
            color: #dc3545;
        }

        .contact-panel .form-control {
            border: 1px solid #dfc5ff;
            border-radius: 6px;
            box-shadow: none;
            min-height: 50px;
        }

        .contact-panel textarea.form-control {
            min-height: 130px;
        }

        .contact-panel .form-control:focus {
            border-color: #7c35f2;
            box-shadow: 0 0 0 .2rem rgba(124, 53, 242, .12);
        }

        .contact-submit-btn {
            align-items: center;
            background: #8136e8;
            border: 0;
            border-radius: 6px;
            color: #fff;
            display: inline-flex;
            font-weight: 800;
            gap: 10px;
            min-height: 58px;
            padding: 0 34px;
        }

        .contact-submit-btn:disabled {
            opacity: .7;
        }

        .feedback-error {
            color: #dc3545;
            font-size: .85rem;
            margin-top: 6px;
        }

        @media (max-width: 767.98px) {
            .contact-panel {
                padding: 26px 20px;
            }

            .contact-panel h2 {
                font-size: 27px;
            }
        }
    </style>
@endsection

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');
            const alertBox = document.getElementById('contactAlert');
            const originalButtonHtml = submitBtn.innerHTML;
            let alertTimer = null;

            const showAlert = function(type, message) {
                alertBox.className = 'alert alert-' + type;
                alertBox.textContent = message;
                alertBox.classList.remove('d-none');

                clearTimeout(alertTimer);
                alertTimer = setTimeout(function() {
                    alertBox.classList.add('d-none');
                    alertBox.textContent = '';
                }, 6000);
            };

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span>Sending...</span>';

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: new FormData(form),
                })
                    .then(async function(response) {
                        const data = await response.json();

                        if (!response.ok) {
                            const errors = data.errors ? Object.values(data.errors).flat().join('\n') : data.message;
                            throw new Error(errors || 'Something went wrong. Please try again.');
                        }

                        showAlert('success', data.message || 'Your message has been sent successfully!');
                        form.reset();

                        if (window.grecaptcha) {
                            grecaptcha.reset();
                        }
                    })
                    .catch(function(error) {
                        showAlert('danger', error.message);

                        if (window.grecaptcha) {
                            grecaptcha.reset();
                        }
                    })
                    .finally(function() {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalButtonHtml;
                    });
            });
        });
    </script>
@endpush
