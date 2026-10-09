 <footer class="site-footer">
     <div class="footer-main">
         <div class="footer-grid">
             <!-- Brand -->
             <div class="footer-brand-col">
                 <img src="{{ asset('frontend/logo/logo.png') }}" alt="DBRC Logo" class="footer-logo-img">
                 <p class="footer-tagline-text">Don Bosco Renewal Centre, Bangalore — A Salesian International
                     Training
                     Centre offering courses in ongoing formation for Priests, Religious and Laity.</p>
                 <div class="footer-socials-row">
                     <a href="https://facebook.com" target="_blank" aria-label="Facebook"><i
                             class="ri-facebook-fill"></i></a>
                     <a href="https://instagram.com" target="_blank" aria-label="Instagram"><i
                             class="ri-instagram-line"></i></a>
                     <a href="https://youtube.com" target="_blank" aria-label="YouTube"><i
                             class="ri-youtube-fill"></i></a>
                 </div>
             </div>
             <!-- Quick Links -->
             <div class="footer-links-col">
                 <h5 class="footer-col-heading">Quick Links</h5>
                 <ul class="footer-link-list">
                     <li><a href="#">About Us</a></li>
                     <li><a href="#">Facilities</a></li>
                     <li><a href="#">Courses</a></li>
                     <li><a href="#">Registration</a></li>
                     <li><a href="#">Alumni</a></li>
                     <li><a href="{{ url('gallery') }}">Gallery</a></li>
                 </ul>
             </div>
             <!-- Courses -->
             <div class="footer-links-col">
                 <h5 class="footer-col-heading">Our Courses</h5>
                 <ul class="footer-link-list">
                     <li><a href="#">Personal Growth &amp; Renewal</a></li>
                     <li><a href="#">Animation of Lay Mission Partners</a></li>
                     <li><a href="#">Spiritual Direction</a></li>
                     <li><a href="#">Guided Retreat</a></li>
                     <li><a href="#">Formation of Formators</a></li>
                     <li><a href="#">Preparation for Final Vows</a></li>
                 </ul>
             </div>
             <!-- Contact -->
             <div class="footer-contact-col">
                 <h5 class="footer-col-heading">Contact Us</h5>
                 <ul class="footer-contact-info">
                     <li><i class="ri-map-pin-line"></i> Don Bosco Renewal Centre,<br>Bangalore – 560 076, India
                     </li>
                     <li><i class="ri-phone-line"></i> <a href="tel:+919353860013">+91 93538 60013</a></li>
                     <li><i class="ri-mail-line"></i> <a href="mailto:admitdbrc@gmail.com">admitdbrc@gmail.com</a>
                     </li>
                 </ul>
                 <a href="#" class="btn-directions-footer"><i class="ri-map-pin-2-line"></i> Get
                     Directions</a>
             </div>
         </div>
     </div>
     <div class="footer-bottom-bar">
         <span>&copy; <span id="footer-year"></span> Don Bosco Renewal Centre, Bangalore. All Rights
             Reserved.</span>
         <span>Designed by <a href="https://boscosofttech.com" target="_blank" rel="noopener">Bosco
                 Soft</a></span>
     </div>
 </footer>

 <button type="button" id="back-to-top" class="back-to-top visible" aria-label="Back to top"
     onclick="window.scrollTo({ top: 0, behavior: 'smooth' });"><i class="ri-arrow-up-s-line"></i></button>

 <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
 <script>
     (function() {
         var _OrigSwiper = window.Swiper;
         window.Swiper = function(selector, opts) {
             try {
                 if (!selector || (typeof selector === 'string' && !document.querySelector(selector))) return {};
                 return new _OrigSwiper(selector, opts);
             } catch (e) {
                 return {};
             }
         };
         if (_OrigSwiper) {
             window.Swiper.prototype = _OrigSwiper.prototype;
             Object.keys(_OrigSwiper).forEach(function(k) {
                 window.Swiper[k] = _OrigSwiper[k];
             });
         }
     })();
 </script>
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         // Footer year
         document.getElementById('footer-year').textContent = new Date().getFullYear();

         // Hero Swiper
         if (typeof Swiper !== 'undefined' && document.querySelector('.hero-swiper')) {
             new Swiper('.hero-swiper', {
                 loop: true,
                 speed: 2000,
                 autoplay: {
                     delay: 5000,
                     disableOnInteraction: false
                 },
                 pagination: {
                     el: '.hero-pagination',
                     clickable: true
                 },
                 navigation: {
                     nextEl: '.hero-next',
                     prevEl: '.hero-prev'
                 },
                 effect: 'fade',
                 fadeEffect: {
                     crossFade: true
                 }
             });
         }

         // Testimonials Swiper
         if (typeof Swiper !== 'undefined' && document.querySelector('.testimonials-swiper')) {
             new Swiper('.testimonials-swiper', {
                 loop: true,
                 autoplay: {
                     delay: 6000,
                     disableOnInteraction: false
                 },
                 pagination: {
                     el: '.testimonials-pagination',
                     clickable: true
                 },
                 navigation: {
                     nextEl: '.testimonials-next',
                     prevEl: '.testimonials-prev'
                 },
                 spaceBetween: 30,
                 breakpoints: {
                     320: {
                         slidesPerView: 1
                     },
                     992: {
                         slidesPerView: 2
                     }
                 }
             });
         }

         // Scroll reveal
         const reveals = document.querySelectorAll('.reveal');
         if ('IntersectionObserver' in window) {
             const observer = new IntersectionObserver((entries) => {
                 entries.forEach(entry => {
                     if (entry.isIntersecting) {
                         entry.target.classList.add('revealed');
                         observer.unobserve(entry.target);
                     }
                 });
             }, {
                 threshold: 0.1
             });
             reveals.forEach(el => observer.observe(el));
         } else {
             reveals.forEach(el => el.classList.add('revealed'));
         }

         // Back to top
         const backToTop = document.getElementById('back-to-top');
         if (backToTop) {
             window.addEventListener('scroll', function() {
                 const scrollPosition = window.scrollY || document.documentElement.scrollTop;
                 backToTop.classList.toggle('visible', scrollPosition > 300);
             });
             backToTop.addEventListener('click', function() {
                 window.scrollTo({
                     top: 0,
                     behavior: 'smooth'
                 });
             });
         }
     });
 </script>
