<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>School Vehicle Management — Professional Transportation Solution</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/school-vehicle-logo.svg') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
        <meta name="description" content="Professional School Vehicle Management System - Comprehensive solution for managing students, vehicles, drivers, and transportation routes with real-time tracking capabilities." />
        <style>
            :root {
                --primary: #6366f1;
                --primary-dark: #4f46e5;
                --secondary: #8b5cf6;
                --success: #10b981;
                --warning: #f59e0b;
                --danger: #ef4444;
                --info: #06b6d4;
                --dark: #1f2937;
                --light: #f8fafc;
                --muted: #6b7280;
                --border: #e5e7eb;
                --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
                --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
                --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
                --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
                --radius-sm: 0.375rem;
                --radius-md: 0.5rem;
                --radius-lg: 0.75rem;
                --radius-xl: 1rem;
            }
            
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
            
            html, body {
                min-height: 100vh;
                font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                line-height: 1.6;
                color: var(--dark);
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                background-attachment: fixed;
            }
            
            .hero-section {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
                position: relative;
                overflow: hidden;
            }
            
            .hero-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
                opacity: 0.3;
                z-index: 1;
            }
            
            .container {
                max-width: 1200px;
                width: 100%;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 4rem;
                align-items: center;
                position: relative;
                z-index: 2;
            }
            
            @media (max-width: 968px) {
                .container {
                    grid-template-columns: 1fr;
                    gap: 2rem;
                    text-align: center;
                }
            }
            
            .hero-content {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: var(--radius-xl);
                padding: 3rem;
                box-shadow: var(--shadow-xl);
                border: 1px solid rgba(255, 255, 255, 0.2);
                animation: fadeInUp 0.8s ease-out;
            }
            
            .hero-brand {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 2rem;
            }
            
            .hero-logo {
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, var(--primary), var(--secondary));
                border-radius: var(--radius-lg);
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: var(--shadow-lg);
            }
            
            .hero-logo img {
                width: 40px;
                height: 40px;
                border-radius: var(--radius-md);
                object-fit: cover;
            }
            
            .hero-brand-text h2 {
                font-size: 1.5rem;
                font-weight: 700;
                color: var(--dark);
                margin: 0;
            }
            
            .hero-brand-text p {
                font-size: 0.875rem;
                color: var(--muted);
                margin: 0;
            }
            
            .hero-title {
                font-size: 3.5rem;
                font-weight: 800;
                line-height: 1.1;
                margin-bottom: 1rem;
                background: linear-gradient(135deg, var(--primary), var(--secondary));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                animation: fadeInUp 0.8s ease-out 0.2s both;
            }
            
            .hero-subtitle {
                font-size: 1.25rem;
                color: var(--muted);
                margin-bottom: 2rem;
                animation: fadeInUp 0.8s ease-out 0.4s both;
            }
            
            .hero-description {
                font-size: 1.1rem;
                color: var(--muted);
                margin-bottom: 2rem;
                line-height: 1.7;
                animation: fadeInUp 0.8s ease-out 0.6s both;
            }
            
            .features-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
                margin-bottom: 2rem;
                animation: fadeInUp 0.8s ease-out 0.8s both;
            }
            
            @media (max-width: 640px) {
                .features-grid {
                    grid-template-columns: 1fr;
                }
            }
            
            .feature-item {
                display: flex;
                align-items: flex-start;
                gap: 0.75rem;
                padding: 1rem;
                background: rgba(255, 255, 255, 0.5);
                border-radius: var(--radius-lg);
                border: 1px solid rgba(255, 255, 255, 0.2);
                transition: all 0.3s ease;
            }
            
            .feature-item:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-lg);
                background: rgba(255, 255, 255, 0.8);
            }
            
            .feature-icon {
                width: 40px;
                height: 40px;
                background: linear-gradient(135deg, var(--primary), var(--secondary));
                border-radius: var(--radius-md);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.2rem;
                flex-shrink: 0;
            }
            
            .feature-content h4 {
                font-size: 1rem;
                font-weight: 600;
                color: var(--dark);
                margin-bottom: 0.25rem;
            }
            
            .feature-content p {
                font-size: 0.875rem;
                color: var(--muted);
                margin: 0;
            }
            
            .hero-actions {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
                animation: fadeInUp 0.8s ease-out 1s both;
            }
            
            .btn {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 1rem 2rem;
                border-radius: var(--radius-lg);
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
                font-size: 1rem;
            }
            
            .btn-primary {
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                color: white;
                box-shadow: var(--shadow-lg);
            }
            
            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-xl);
            }
            
            .btn-secondary {
                background: rgba(255, 255, 255, 0.9);
                color: var(--dark);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            
            .btn-secondary:hover {
                background: white;
                transform: translateY(-2px);
                box-shadow: var(--shadow-lg);
            }
            
            .contact-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border-radius: var(--radius-xl);
                padding: 2.5rem;
                box-shadow: var(--shadow-xl);
                border: 1px solid rgba(255, 255, 255, 0.2);
                animation: fadeInUp 0.8s ease-out 1.2s both;
            }
            
            .contact-title {
                font-size: 1.75rem;
                font-weight: 700;
                color: var(--dark);
                margin-bottom: 0.5rem;
            }
            
            .contact-subtitle {
                color: var(--muted);
                margin-bottom: 2rem;
                font-size: 1.1rem;
            }
            
            .contact-form {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
            
            .form-group {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .form-input {
                padding: 1rem;
                border: 2px solid var(--border);
                border-radius: var(--radius-lg);
                font-size: 1rem;
                transition: all 0.3s ease;
                background: rgba(255, 255, 255, 0.8);
            }
            
            .form-input:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
                background: white;
            }
            
            .form-textarea {
                resize: vertical;
                min-height: 120px;
            }
            
            .stats-section {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border-radius: var(--radius-xl);
                padding: 2rem;
                margin-top: 2rem;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
                text-align: center;
            }
            
            @media (max-width: 640px) {
                .stats-grid {
                    grid-template-columns: 1fr;
                    gap: 1rem;
                }
            }
            
            .stat-item h3 {
                font-size: 2rem;
                font-weight: 700;
                color: white;
                margin-bottom: 0.5rem;
            }
            
            .stat-item p {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.875rem;
            }
            
            .toast {
                position: fixed;
                top: 2rem;
                right: 2rem;
                background: var(--dark);
                color: white;
                padding: 1rem 1.5rem;
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-xl);
                z-index: 1000;
                display: none;
                animation: slideInRight 0.3s ease-out;
            }
            
            .toast.show {
                display: block;
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(30px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            
            .floating-elements {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                pointer-events: none;
                z-index: 1;
            }
            
            .floating-element {
                position: absolute;
                background: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                animation: float 6s ease-in-out infinite;
            }
            
            .floating-element:nth-child(1) {
                width: 80px;
                height: 80px;
                top: 20%;
                left: 10%;
                animation-delay: 0s;
            }
            
            .floating-element:nth-child(2) {
                width: 60px;
                height: 60px;
                top: 60%;
                right: 15%;
                animation-delay: 2s;
            }
            
            .floating-element:nth-child(3) {
                width: 100px;
                height: 100px;
                bottom: 20%;
                left: 20%;
                animation-delay: 4s;
            }
            
            @keyframes float {
                0%, 100% {
                    transform: translateY(0px);
                }
                50% {
                    transform: translateY(-20px);
                }
            }
        </style>
    </head>
    <body>
        <div class="hero-section">
            <!-- Floating Background Elements -->
            <div class="floating-elements">
                <div class="floating-element"></div>
                <div class="floating-element"></div>
                <div class="floating-element"></div>
            </div>
            
            <div class="container">
                <!-- Hero Content -->
                <div class="hero-content">
                    <div class="hero-brand">
                        <div class="hero-logo">
                            <img src="{{ asset('images/school-vehicle-logo.svg') }}" alt="School Vehicle Management logo" />
                        </div>
                        <div class="hero-brand-text">
                            <h2>School Vehicle Management</h2>
                            <p>Professional Transportation Solution</p>
                    </div>
                    </div>

                    <h1 class="hero-title">Transform Your School Transportation</h1>
                    <p class="hero-subtitle">Professional, Safe, and Efficient</p>
                    <p class="hero-description">
                        Comprehensive solution for managing students, vehicles, drivers, and transportation routes with real-time tracking capabilities. 
                        Make school transportation reliable, safe, and easy to manage.
                    </p>

                    <div class="features-grid">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Student & Guardian Management</h4>
                                <p>Complete profiles with contact information and permissions</p>
                    </div>
                </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-bus"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Vehicle & Driver Management</h4>
                                <p>Maintain vehicles, assignments and maintenance logs</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-route"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Route Planning & Tracking</h4>
                                <p>Plan routes, schedule trips and track real-time status</p>
                            </div>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Reports & Analytics</h4>
                                <p>Comprehensive reports and safety monitoring</p>
                            </div>
                        </div>
                    </div>

                    <div class="hero-actions">
                    @if (Route::has('login'))
                        @auth
                                <a href="{{ url('/admin/dashboard') }}" class="btn btn-primary">
                                    <i class="fas fa-tachometer-alt"></i>
                                    Go to Dashboard
                                </a>
                        @else
                                <a href="{{ route('login') }}" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Login
                                </a>
                        @endauth
                    @endif
                        <a href="mailto:info@example.com?subject=School%20Vehicle%20Management%20Inquiry" class="btn btn-secondary">
                            <i class="fas fa-envelope"></i>
                            Contact Us
                        </a>
                    </div>
                </div>

                <!-- Contact Card -->
                <div class="contact-card">
                    <h3 class="contact-title">Get in Touch</h3>
                    <p class="contact-subtitle">Have questions or feedback? Send us a message and we'll get back to you.</p>

                    <form id="contact-form" class="contact-form" aria-label="Contact form">
                        <div class="form-group">
                            <input id="contact-name" name="name" type="text" placeholder="Your name (optional)" class="form-input" />
                        </div>
                        <div class="form-group">
                            <input id="contact-email" name="email" type="email" placeholder="Your email address" required class="form-input" />
                        </div>
                        <div class="form-group">
                            <textarea id="contact-message" name="message" placeholder="How can we help you?" rows="4" class="form-input form-textarea"></textarea>
                        </div>
                        <button id="contact-submit" type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="stats-section">
                <div class="stats-grid">
                    <div class="stat-item">
                        <h3>100%</h3>
                        <p>Safety First</p>
                    </div>
                    <div class="stat-item">
                        <h3>24/7</h3>
                        <p>Real-time Tracking</p>
                    </div>
                    <div class="stat-item">
                        <h3>99%</h3>
                        <p>Reliability</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="toast" class="toast" role="status" aria-live="polite"></div>

        <script>
            // Enhanced contact form functionality
            document.addEventListener('DOMContentLoaded', function() {
                const contactForm = document.getElementById('contact-form');
                const toast = document.getElementById('toast');
                
                if (contactForm) {
                    contactForm.addEventListener('submit', async function(e) {
                        e.preventDefault();
                        
                        const submitBtn = document.getElementById('contact-submit');
                        const originalText = submitBtn.innerHTML;
                        
                        // Show loading state
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                        submitBtn.disabled = true;
                        
                        try {
                            const formData = new FormData(contactForm);
                            const response = await fetch('{{ route("contact.store") }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            });
                            
                            if (response.ok) {
                                showToast('Message sent successfully! We\'ll get back to you soon.', 'success');
                                contactForm.reset();
                            } else {
                                throw new Error('Failed to send message');
                            }
                        } catch (error) {
                            showToast('Failed to send message. Please try again.', 'error');
                        } finally {
                            // Reset button
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }
                    });
                }
                
                function showToast(message, type = 'info') {
                    toast.textContent = message;
                    toast.className = `toast show ${type}`;
                    
                    setTimeout(() => {
                        toast.classList.remove('show');
                    }, 5000);
                }
                
                // Add smooth scrolling for any anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
                
                // Add intersection observer for animations
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                }, observerOptions);
                
                // Observe elements for animation
                document.querySelectorAll('.feature-item, .contact-card, .stats-section').forEach(el => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(30px)';
                    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    observer.observe(el);
                });
            });
        </script>
    </body>
</html>
