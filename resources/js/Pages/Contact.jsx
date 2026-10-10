import { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import AppLayout from '../Layouts/AppLayout';
import SubpageHero from '../Components/SubpageHero';

export default function Contact({ flashNews = [] }) {
    const [submitted, setSubmitted] = useState(false);

    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        phone: '',
        subject: '',
        message: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/contact', {
            preserveScroll: true,
            onSuccess: () => {
                setSubmitted(true);
                reset();
                setTimeout(() => setSubmitted(false), 8000);
            },
        });
    };

    return (
        <AppLayout flashNews={flashNews}>
            <Head title="Contact Us — St. Mary's Convent School" />

            <SubpageHero 
                title="Get in Touch" 
                breadcrumbs={[{ name: 'Contact Us', url: '/contact' }]} 
            />

            {/* Contact Details Cards */}
            <section className="section py-5 bg-white">
                <div className="container">
                    <div className="row g-4">
                        <div className="col-lg-3 col-md-6">
                            <div className="contact-card-v2 text-center p-4 border rounded-4 bg-light h-100 shadow-sm">
                                <div className="contact-icon-box mx-auto mb-3 bg-navy text-gold rounded-circle d-flex align-items-center justify-content-center" style={{ width: '60px', height: '60px', fontSize: '24px' }}>
                                    <i className="fa-solid fa-location-dot"></i>
                                </div>
                                <h5 className="fw-bold text-navy mb-2">School Location</h5>
                                <p className="text-muted small mb-0" style={{ lineHeight: '1.6' }}>
                                    St. Mary’s Convent School<br />
                                    Vill. Chhallan, Ramkot, Teh. Ramkot,<br />
                                    Dist. Kathua, J&K (UT) – 184205
                                </p>
                            </div>
                        </div>

                        <div className="col-lg-3 col-md-6">
                            <div className="contact-card-v2 text-center p-4 border rounded-4 bg-light h-100 shadow-sm">
                                <div className="contact-icon-box mx-auto mb-3 bg-navy text-gold rounded-circle d-flex align-items-center justify-content-center" style={{ width: '60px', height: '60px', fontSize: '24px' }}>
                                    <i className="fa-solid fa-phone"></i>
                                </div>
                                <h5 className="fw-bold text-navy mb-2">Phone Helpline</h5>
                                <p className="text-muted small mb-0">
                                    <a href="tel:+918082171498" className="fw-bold text-navy text-decoration-none fs-6">+91 8082171498</a><br />
                                    <span className="text-muted">Admission Desk & Office</span>
                                </p>
                            </div>
                        </div>

                        <div className="col-lg-3 col-md-6">
                            <div className="contact-card-v2 text-center p-4 border rounded-4 bg-light h-100 shadow-sm">
                                <div className="contact-icon-box mx-auto mb-3 bg-navy text-gold rounded-circle d-flex align-items-center justify-content-center" style={{ width: '60px', height: '60px', fontSize: '24px' }}>
                                    <i className="fa-solid fa-envelope"></i>
                                </div>
                                <h5 className="fw-bold text-navy mb-2">Email Inquiries</h5>
                                <p className="text-muted small mb-0">
                                    <a href="mailto:school@smcsramkot.in" className="fw-bold text-navy text-decoration-none fs-6">school@smcsramkot.in</a><br />
                                    <span className="text-muted">Direct Official Correspondence</span>
                                </p>
                            </div>
                        </div>

                        <div className="col-lg-3 col-md-6">
                            <div className="contact-card-v2 text-center p-4 border rounded-4 bg-light h-100 shadow-sm">
                                <div className="contact-icon-box mx-auto mb-3 bg-navy text-gold rounded-circle d-flex align-items-center justify-content-center" style={{ width: '60px', height: '60px', fontSize: '24px' }}>
                                    <i className="fa-solid fa-clock"></i>
                                </div>
                                <h5 className="fw-bold text-navy mb-2">Visiting Hours</h5>
                                <p className="text-muted small mb-0">
                                    Mon – Sat: 8:00 AM – 3:00 PM<br />
                                    <span className="text-muted">Principal Meeting: By Appointment</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Contact Form & Map Section */}
            <section className="section py-5 bg-light-subtle">
                <div className="container">
                    <div className="row g-4 align-items-stretch">
                        {/* Contact Form Column */}
                        <div className="col-lg-7">
                            <div className="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white h-100">
                                <div className="mb-4">
                                    <span className="badge bg-navy-subtle text-navy px-3 py-2 rounded-pill fw-semibold text-uppercase tracking-wider" style={{ fontSize: '0.75rem' }}>
                                        Enquiry & Feedback
                                    </span>
                                    <h2 className="section-title text-navy fs-2 fw-bold mt-2 mb-1">Send Us a Message</h2>
                                    <p className="text-muted small mb-0">Fill out the form below and our office team will respond promptly.</p>
                                </div>

                                {submitted && (
                                    <div className="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center mb-4" role="alert">
                                        <i className="fa-solid fa-circle-check fs-4 me-3 text-success"></i>
                                        <div>
                                            <strong>Thank you!</strong> Your message has been sent successfully. We will get back to you soon.
                                        </div>
                                    </div>
                                )}

                                <form onSubmit={handleSubmit}>
                                    <div className="row g-3">
                                        <div className="col-md-6">
                                            <label className="form-label fw-semibold text-dark small mb-1">
                                                Full Name <span className="text-danger">*</span>
                                            </label>
                                            <input 
                                                type="text" 
                                                className={`form-control form-control-lg rounded-3 fs-6 ${errors.name ? 'is-invalid' : ''}`}
                                                placeholder="Enter full name"
                                                maxLength={100}
                                                value={data.name}
                                                onChange={(e) => setData('name', e.target.value)}
                                                required
                                            />
                                            {errors.name && <div className="invalid-feedback">{errors.name}</div>}
                                        </div>

                                        <div className="col-md-6">
                                            <label className="form-label fw-semibold text-dark small mb-1">
                                                Email Address <span className="text-danger">*</span>
                                            </label>
                                            <input 
                                                type="email" 
                                                className={`form-control form-control-lg rounded-3 fs-6 ${errors.email ? 'is-invalid' : ''}`}
                                                placeholder="example@domain.com"
                                                maxLength={100}
                                                value={data.email}
                                                onChange={(e) => setData('email', e.target.value)}
                                                required
                                            />
                                            {errors.email && <div className="invalid-feedback">{errors.email}</div>}
                                        </div>

                                        <div className="col-md-6">
                                            <label className="form-label fw-semibold text-dark small mb-1">
                                                Phone Number
                                            </label>
                                            <input 
                                                type="text"
                                                inputMode="numeric"
                                                className={`form-control form-control-lg rounded-3 fs-6 ${errors.phone ? 'is-invalid' : ''}`}
                                                placeholder="Digits only (e.g. 9876543210)"
                                                maxLength={15}
                                                value={data.phone}
                                                onChange={(e) => setData('phone', e.target.value.replace(/\D/g, ''))}
                                            />
                                            {errors.phone && <div className="invalid-feedback">{errors.phone}</div>}
                                        </div>

                                        <div className="col-md-6">
                                            <label className="form-label fw-semibold text-dark small mb-1">
                                                Subject
                                            </label>
                                            <input 
                                                type="text" 
                                                className={`form-control form-control-lg rounded-3 fs-6 ${errors.subject ? 'is-invalid' : ''}`}
                                                placeholder="Enter subject"
                                                maxLength={100}
                                                value={data.subject}
                                                onChange={(e) => setData('subject', e.target.value)}
                                            />
                                            {errors.subject && <div className="invalid-feedback">{errors.subject}</div>}
                                        </div>

                                        <div className="col-12">
                                            <div className="d-flex justify-content-between align-items-center mb-1">
                                                <label className="form-label fw-semibold text-dark small mb-0">
                                                    Message / Query <span className="text-danger">*</span>
                                                </label>
                                                <span className="text-muted extra-small" style={{ fontSize: '0.78rem' }}>
                                                    {data.message.length}/500 chars
                                                </span>
                                            </div>
                                            <textarea 
                                                rows="4" 
                                                className={`form-control rounded-3 fs-6 ${errors.message ? 'is-invalid' : ''}`}
                                                placeholder="Write your query or message here (max 500 characters)..."
                                                maxLength={500}
                                                value={data.message}
                                                onChange={(e) => setData('message', e.target.value)}
                                                required
                                            ></textarea>
                                            {errors.message && <div className="invalid-feedback">{errors.message}</div>}
                                        </div>

                                        <div className="col-12 mt-4">
                                            <button 
                                                type="submit" 
                                                className="btn btn-premium px-5 py-3 rounded-pill fw-bold w-100 d-flex align-items-center justify-content-center"
                                                disabled={processing}
                                            >
                                                {processing ? (
                                                    <>
                                                        <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                                        Sending Message...
                                                    </>
                                                ) : (
                                                    <>
                                                        Submit Inquiry <i className="fa-solid fa-paper-plane ms-2"></i>
                                                    </>
                                                )}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {/* Location Map & Info Column */}
                        <div className="col-lg-5">
                            <div className="card border-0 shadow-sm rounded-4 p-4 p-md-4 bg-white h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <h4 className="fw-bold text-navy mb-3">Visit Our Campus</h4>
                                    <p className="text-muted small mb-4" style={{ lineHeight: '1.6' }}>
                                        St. Mary’s Convent School is located in Chhallan, Ramkot. Visitors and parents are welcome during office hours.
                                    </p>

                                    <div className="mb-4 rounded-3 overflow-hidden shadow-sm" style={{ height: '320px' }}>
                                        <iframe 
                                            title="School Location Map"
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13452.146637877235!2d75.45!3d32.65!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzLCsDM5JzAwLjAiTiA3NcKwMjcnMDAuMCJF!5e0!3m2!1sen!2sin!4v1650000000000!5m2!1sen!2sin"
                                            width="100%" 
                                            height="100%" 
                                            style={{ border: 0 }} 
                                            allowFullScreen="" 
                                            loading="lazy" 
                                            referrerPolicy="no-referrer-when-downgrade"
                                        ></iframe>
                                    </div>
                                </div>

                                <div className="p-3 border rounded-3 bg-navy-subtle text-navy">
                                    <div className="d-flex align-items-center">
                                        <i className="fa-solid fa-headset fs-3 me-3 text-navy"></i>
                                        <div>
                                            <h6 className="fw-bold mb-1">Need Quick Help?</h6>
                                            <span className="small text-muted">Call our desk at </span>
                                            <a href="tel:+918082171498" className="fw-bold text-navy text-decoration-none">+91 8082171498</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </AppLayout>
    );
}
