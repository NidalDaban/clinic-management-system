@extends('theme.master')
@section('home-active', 'active')

@section('title', 'WELCOME TO RafiqCare')
@section('subtitle')
    Your trusted partner in mental health and wellness across Jordan.<br>
    Book sessions, get prescriptions, and connect with<br>
    licensed professionals — all in one place.
@endsection

@section('content')
    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container">

            <div class="row gy-4 gx-5">

                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('assets') }}/img/about.jpg" class="img-fluid" alt="">
                </div>

                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <h3>About Us</h3>
                    <p>
                        RafiqCare is a compassionate mental health platform dedicated to enhancing the psychological
                        well-being of individuals across Jordan.
                        Through our hybrid model—combining in-clinic visits with online services—we ensure accessible,
                        confidential, and professional care for every patient.
                    </p>
                    <ul>
                        <li>
                            <i class="fa-solid fa-vial-circle-check"></i>
                            <div>
                                <h5>Expert Diagnosis & Personalized Prescriptions</h5>
                                <p>Our certified doctors provide accurate diagnoses and tailored prescriptions to support
                                    every patient’s unique journey.
                                </p>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-pump-medical"></i>
                            <div>
                                <h5>Live Therapy Sessions with Trusted Psychologists</h5>
                                <p>Patients can book real-time sessions with top psychologists—whether online or in
                                    person—for continuous emotional support.</p>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-heart-circle-xmark"></i>
                            <div>
                                <h5>Comprehensive Care & Progress Tracking</h5>
                                <p>Our platform securely stores medical records, therapy notes, and instructions to ensure
                                    consistent and informed care.
                                    veniam</p>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Clinic & Doctors Slider -->
    <!-- Clinic & Doctors Slider -->
    <section class="section py-3" id="clinic-slider">
        <div class="container">
            <div class="section-title text-center mb-3">
                <h2>Our Clinic & Team</h2>
                <p>Take a glimpse into our caring environment and meet some of our trusted professionals.</p>
            </div>

            <div id="clinicCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000"
                data-bs-wrap="true">
                <div class="carousel-inner rounded-4 shadow-sm">

                    <div class="carousel-item active">
                        <img src="{{ asset('assets/img/about.jpg') }}" class="d-block w-100 slider-img" alt="Clinic View 1">
                    </div>

                    <div class="carousel-item">
                        <img src="{{ asset('assets/img/departments-2.jpg') }}" class="d-block w-100 slider-img"
                            alt="Clinic View 2">
                    </div>

                    <div class="carousel-item">
                        <img src="{{ asset('assets/img/departments-3.jpg') }}" class="d-block w-100 slider-img"
                            alt="Dr. Ahmad – Psychiatrist">
                    </div>

                    <div class="carousel-item">
                        <img src="{{ asset('assets/img/psycology-image.png') }}" class="d-block w-100 slider-img"
                            alt="Dr. Lina – Psychologist">
                    </div>

                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#clinicCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#clinicCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>



    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Common Questions About RafiqCare</h2>
            <p>Here you'll find answers to the most frequently asked questions about RafiqCare — Jordan's digital
                psychiatric clinic. Whether you're a patient, doctor, or admin, we’re here to help you understand how
                RafiqCare works, how to book appointments, manage sessions, and get the support you need.</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                    <div class="faq-container">

                        <div class="faq-item faq-active">
                            <h3>What is RafiqCare and how does it work?</h3>
                            <div class="faq-content">
                                <p>RafiqCare is a hybrid (both online and offline) psychiatric clinic management system
                                    designed specifically for Jordan. It offers a secure and user-friendly platform where
                                    patients can book therapy sessions, consult with mental health professionals, and access
                                    their medical records and prescriptions. Doctors can manage their appointments, provide
                                    live consultations, and track patient progress. Admins or secretaries use the system to
                                    oversee operations, schedule sessions, and handle records. The platform ensures smooth
                                    coordination between all parties while maintaining data privacy and offering real-time
                                    updates and support.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Who can use RafiqCare — patients, doctors, or psychologists?</h3>
                            <div class="faq-content">
                                <p>RafiqCare is designed for three main users: patients, doctors, and psychologists.
                                    Patients use the platform to book appointments, attend sessions, and view their medical
                                    records. Doctors are responsible for making diagnoses and issuing prescriptions.
                                    Psychologists focus on conducting therapy sessions and providing mental health support.
                                    The system allows seamless communication and coordination among all users, ensuring
                                    quality care and privacy for everyone involved.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>How do I book an appointment through RafiqCare?</h3>
                            <div class="faq-content">
                                <p>If you're a patient using RafiqCare for the first time, you'll need to register by
                                    creating an account and filling in your personal and medical information. Once your
                                    profile is set up, you can easily browse available doctors or psychologists, choose the
                                    one that fits your needs, and book an appointment at a suitable time. The platform will
                                    guide you through the entire process, from registration to session confirmation.
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>What kind of support does RafiqCare provide?</h3>
                            <div class="faq-content">
                                <p>RafiqCare offers comprehensive support for patients, psychologists, and doctors. Patients
                                    receive assistance with registration, appointment booking, and accessing medical records
                                    or prescriptions. Psychologists are supported with tools to manage therapy sessions,
                                    notes, and patient communication. Doctors are equipped to provide diagnoses, issue
                                    prescriptions, and monitor patient progress. Our platform also includes live session
                                    capabilities, reminders, and technical help to ensure a smooth and secure experience for
                                    all users.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Is my data and personal information secure on RafiqCare?</h3>
                            <div class="faq-content">
                                <p>Your data and personal information are completely secure on RafiqCare. We use advanced
                                    encryption protocols, secure authentication methods, and strict privacy policies to
                                    ensure that all your medical records, session notes, and personal details are protected.
                                    Only authorized doctors and psychologists have access to your information, and we never
                                    share your data with third parties without your explicit consent. Your privacy and
                                    safety are our top priorities.
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        {{-- <div class="faq-item">
                            <h3>Perspiciatis quod quo quos nulla quo illum ullam?</h3>
                            <div class="faq-content">
                                <p>Enim ea facilis quaerat voluptas quidem et dolorem. Quis et consequatur non sed
                                    in suscipit sequi. Distinctio ipsam dolore et.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item--> --}}

                    </div>

                </div><!-- End Faq Column-->

            </div>

        </div>

    </section><!-- /Faq Section -->


@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
