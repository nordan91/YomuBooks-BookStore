<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'YomuBooks - Discover Stories. Yomu Your Way.' }}</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="YomuBooks - Your premier online bookstore. Discover thousands of books across all genres. Fast delivery, secure payment, and easy returns.">
    <meta name="keywords" content="books, online bookstore, buy books, bestsellers, fiction, non-fiction">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts - Premium Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/icon.png') }}">
    
    <style>
        /* ============================================
           DESIGN SYSTEM - YomuBooks E-Commerce
           International UI/UX Standards
           ============================================ */
        
        :root {
            /* Brand Colors - Premium Palette */
            --primary-color: #DC6B6F;
            --primary-dark: #C85A5E;
            --primary-light: #FFE5E6;
            --primary-gradient: linear-gradient(135deg, #DC6B6F 0%, #C85A5E 100%);
            
            /* Neutral Colors - Sophisticated Grays */
            --neutral-900: #0F172A;
            --neutral-800: #1E293B;
            --neutral-700: #334155;
            --neutral-600: #475569;
            --neutral-500: #64748B;
            --neutral-400: #94A3B8;
            --neutral-300: #CBD5E1;
            --neutral-200: #E2E8F0;
            --neutral-100: #F1F5F9;
            --neutral-50: #F8FAFC;
            
            /* Semantic Colors */
            --success-color: #10B981;
            --warning-color: #F59E0B;
            --error-color: #EF4444;
            --info-color: #3B82F6;
            
            /* Typography Scale */
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-accent: 'Space Grotesk', sans-serif;
            
            /* Spacing Scale (8px base) */
            --space-1: 0.25rem;   /* 4px */
            --space-2: 0.5rem;    /* 8px */
            --space-3: 0.75rem;   /* 12px */
            --space-4: 1rem;      /* 16px */
            --space-5: 1.25rem;   /* 20px */
            --space-6: 1.5rem;    /* 24px */
            --space-8: 2rem;      /* 32px */
            --space-10: 2.5rem;   /* 40px */
            --space-12: 3rem;     /* 48px */
            --space-16: 4rem;     /* 64px */
            --space-20: 5rem;     /* 80px */
            
            /* Border Radius */
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --radius-full: 9999px;
            
            /* Shadows - Elevation System */
            --shadow-xs: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            
            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: 250ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 350ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: 500ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        /* ============================================
           GLOBAL STYLES
           ============================================ */
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--neutral-50);
            color: var(--neutral-800);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Selection */
        ::selection {
            background-color: var(--primary-light);
            color: var(--primary-dark);
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--neutral-100);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--neutral-300);
            border-radius: var(--radius-full);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* ============================================
           NAVIGATION - Top Bar
           ============================================ */
        
        .top-bar {
            background: var(--neutral-900);
            color: var(--neutral-100);
            padding: var(--space-2) 0;
            font-size: 0.875rem;
        }

        .top-bar a {
            color: var(--neutral-100);
            text-decoration: none;
            transition: color var(--transition-fast);
        }

        .top-bar a:hover {
            color: var(--primary-color);
        }

        /* Main Navbar */
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: var(--shadow-sm);
            padding: var(--space-3) 0;
            border-bottom: 1px solid var(--neutral-200);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all var(--transition-base);
        }

        .navbar-custom.scrolled {
            box-shadow: var(--shadow-lg);
            padding: var(--space-2) 0;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: opacity var(--transition-base);
            padding: 0;
            margin: -20px 0;
            z-index: 1000;
        }

        .navbar-brand:hover {
            opacity: 0.85;
        }

        .navbar-brand img {
            height: 100px;
            object-fit: contain;
            transition: height var(--transition-base);
        }

        .navbar-custom.scrolled .navbar-brand img {
            height: 70px;
        }

        /* Navigation Links */
        .nav-link {
            color: var(--neutral-700) !important;
            font-weight: 600;
            font-size: 0.9375rem;
            padding: var(--space-3) var(--space-4) !important;
            transition: all var(--transition-fast);
            position: relative;
            letter-spacing: -0.01em;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 80%;
            height: 3px;
            background: var(--primary-gradient);
            border-radius: var(--radius-full);
            transition: transform var(--transition-base);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            transform: translateX(-50%) scaleX(1);
        }

        /* Search Bar */
        .search-wrapper {
            position: relative;
            max-width: 500px;
        }

        .search-input {
            width: 100%;
            padding: var(--space-3) var(--space-12) var(--space-3) var(--space-4);
            border: 2px solid var(--neutral-200);
            border-radius: var(--radius-full);
            font-size: 0.9375rem;
            transition: all var(--transition-base);
            background: var(--neutral-50);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            background: #ffffff;
            box-shadow: 0 0 0 4px var(--primary-light);
        }

        .search-btn {
            position: absolute;
            right: var(--space-1);
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary-gradient);
            border: none;
            padding: var(--space-2) var(--space-5);
            border-radius: var(--radius-full);
            color: #ffffff;
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-base);
        }

        .search-btn:hover {
            transform: translateY(-50%) scale(1.05);
            box-shadow: var(--shadow-lg);
        }

        /* Cart Badge */
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--primary-gradient);
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.25rem 0.5rem;
            border-radius: var(--radius-full);
            min-width: 20px;
            text-align: center;
            box-shadow: var(--shadow-md);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        /* ============================================
           MAIN CONTENT
           ============================================ */
        
        .main-content {
            flex: 1;
            padding-top: var(--space-8);
            padding-bottom: var(--space-16);
        }

        /* Container */
        .container {
            max-width: 1400px;
        }

        /* Section Headers */
        .section-title {
            font-family: var(--font-display);
            font-weight: 800;
            color: var(--neutral-900);
            margin-bottom: var(--space-4);
            font-size: clamp(2rem, 4vw, 3rem);
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: var(--neutral-600);
            max-width: 600px;
            margin: 0 auto var(--space-8);
        }

        /* ============================================
           CARDS & COMPONENTS
           ============================================ */
        
        /* Base Card */
        .card {
            border: 1px solid var(--neutral-200);
            border-radius: var(--radius-lg);
            transition: all var(--transition-base);
            background-color: #ffffff;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--shadow-xl);
            transform: translateY(-8px);
            border-color: var(--primary-color);
        }

        /* Category Cards */
        .category-card {
            border: 1px solid var(--neutral-200);
            border-radius: var(--radius-lg);
            transition: all var(--transition-base);
            cursor: pointer;
            background: #ffffff;
            overflow: hidden;
        }

        .category-card:hover {
            box-shadow: var(--shadow-xl);
            transform: translateY(-8px) scale(1.02);
            border-color: var(--primary-color);
        }

        .category-card a {
            text-decoration: none;
            color: var(--neutral-800);
        }

        .category-title {
            font-weight: 700;
            font-size: 1.125rem;
            color: var(--neutral-900);
            margin: 0;
            font-family: var(--font-accent);
        }

        /* Product Cards */
        .product-card {
            border: 1px solid var(--neutral-200);
            border-radius: var(--radius-lg);
            transition: all var(--transition-base);
            cursor: pointer;
            overflow: hidden;
            background: #ffffff;
            position: relative;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
            transform: scaleX(0);
            transition: transform var(--transition-base);
        }

        .product-card:hover::before {
            transform: scaleX(1);
        }

        .product-card:hover {
            box-shadow: var(--shadow-2xl);
            transform: translateY(-12px);
            border-color: var(--primary-color);
        }

        .product-card img {
            transition: transform var(--transition-slow);
        }

        .product-card:hover img {
            transform: scale(1.08);
        }

        .product-title {
            font-weight: 700;
            color: var(--neutral-900);
            font-size: 1.0625rem;
            margin-bottom: var(--space-2);
            line-height: 1.4;
            font-family: var(--font-accent);
        }

        .product-brand {
            font-size: 0.875rem;
            color: var(--neutral-500);
            font-weight: 500;
        }

        .selling-price {
            color: var(--primary-color);
            font-weight: 800;
            font-size: 1.375rem;
            font-family: var(--font-accent);
        }

        /* ============================================
           BUTTONS
           ============================================ */
        
        .btn {
            font-weight: 600;
            border-radius: var(--radius-md);
            padding: var(--space-3) var(--space-6);
            transition: all var(--transition-base);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            font-family: var(--font-accent);
            letter-spacing: -0.01em;
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: #ffffff;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
            color: #ffffff;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-gradient);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* ============================================
           DROPDOWN
           ============================================ */
        
        .dropdown-menu {
            border: 1px solid var(--neutral-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            margin-top: var(--space-3);
            padding: var(--space-2);
            min-width: 220px;
        }

        .dropdown-item {
            padding: var(--space-3) var(--space-4);
            border-radius: var(--radius-md);
            transition: all var(--transition-fast);
            font-weight: 500;
            color: var(--neutral-700);
        }

        .dropdown-item:hover {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            transform: translateX(4px);
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
        }

        /* ============================================
           BADGES
           ============================================ */
        
        .badge {
            font-size: 0.75rem;
            font-weight: 700;
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
            font-family: var(--font-accent);
            letter-spacing: 0.025em;
        }

        .badge-primary {
            background: var(--primary-gradient);
            color: #ffffff;
        }

        /* ============================================
           FOOTER
           ============================================ */
        
        .footer {
            background: var(--neutral-900);
            color: var(--neutral-300);
            padding: var(--space-16) 0 var(--space-8);
            margin-top: auto;
            border-top: 4px solid var(--primary-color);
        }

        .footer-brand {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: var(--space-4);
        }

        .footer-brand .brand-accent {
            color: var(--primary-color);
        }

        .footer-tagline {
            color: var(--neutral-400);
            font-size: 1.125rem;
            margin-bottom: var(--space-6);
            font-style: italic;
        }

        .footer-title {
            font-family: var(--font-accent);
            font-weight: 700;
            font-size: 1.125rem;
            color: #ffffff;
            margin-bottom: var(--space-4);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: var(--space-3);
        }

        .footer-links a {
            color: var(--neutral-400);
            text-decoration: none;
            transition: all var(--transition-fast);
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
        }

        .footer-links a:hover {
            color: var(--primary-color);
            transform: translateX(4px);
        }

        .footer-social {
            display: flex;
            gap: var(--space-4);
            margin-top: var(--space-6);
        }

        .footer-social a {
            width: 44px;
            height: 44px;
            background: var(--neutral-800);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--neutral-300);
            transition: all var(--transition-base);
            font-size: 1.25rem;
        }

        .footer-social a:hover {
            background: var(--primary-gradient);
            color: #ffffff;
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .footer-bottom {
            border-top: 1px solid var(--neutral-800);
            margin-top: var(--space-12);
            padding-top: var(--space-6);
            text-align: center;
            color: var(--neutral-500);
        }

        /* ============================================
           RESPONSIVE DESIGN
           ============================================ */
        
        @media (max-width: 992px) {
            .section-title {
                font-size: 2rem;
            }
            
            .navbar-brand {
                margin: -15px 0;
            }

            .navbar-brand img {
                height: 70px;
            }
            
            .navbar-custom.scrolled .navbar-brand img {
                height: 60px;
            }
        }

        @media (max-width: 768px) {
            :root {
                --space-16: 3rem;
                --space-20: 4rem;
            }
            
            .main-content {
                padding-top: var(--space-6);
                padding-bottom: var(--space-12);
            }
            
            .footer {
                padding: var(--space-12) 0 var(--space-6);
            }
        }

        /* ============================================
           UTILITY CLASSES
           ============================================ */
        
        .text-gradient {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Loading Animation */
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }

        .skeleton {
            background: linear-gradient(90deg, var(--neutral-200) 25%, var(--neutral-100) 50%, var(--neutral-200) 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }
    </style>
</head>
<body>
    @include('layouts.web.partials.navbar_web')

    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Premium Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <!-- Brand Column -->
                <div class="col-lg-4">
                    <div class="footer-brand">
                        Yomu<span class="brand-accent">Books</span>
                    </div>
                    <p class="footer-tagline">Discover Stories. Yomu Your Way.</p>
                    <p class="mb-4">Your premier destination for discovering and purchasing books across all genres. We bring stories to life, one page at a time.</p>
                    
                    <div class="footer-social">
                        <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-4">
                    <h6 class="footer-title">Shop</h6>
                    <ul class="footer-links">
                        <li><a href="#"><i class="bi bi-chevron-right"></i>All Books</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i>Bestsellers</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i>New Arrivals</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i>Categories</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i>Special Offers</a></li>
                    </ul>
                </div>

                <!-- Customer Service -->
                <div class="col-lg-3 col-md-4">
                    <h6 class="footer-title">Customer Service</h6>
                    <ul class="footer-links">
                        <li><a href="#"><i class="bi bi-chevron-right"></i>Contact Us</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i>Shipping Info</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i>Returns & Exchanges</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i>Track Order</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i>FAQ</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-4">
                    <h6 class="footer-title">Get In Touch</h6>
                    <ul class="footer-links">
                        <li><a href="mailto:hello@yomubooks.com"><i class="bi bi-envelope"></i>hello@yomubooks.com</a></li>
                        <li><a href="tel:+1234567890"><i class="bi bi-telephone"></i>+1 (234) 567-890</a></li>
                        <li><a href="#"><i class="bi bi-geo-alt"></i>123 Book Street, Reading City</a></li>
                    </ul>
                    
                    <div class="mt-4">
                        <h6 class="footer-title mb-3">Newsletter</h6>
                        <p class="small mb-3">Subscribe for exclusive deals and updates</p>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your email">
                            <button class="btn btn-primary" type="button">
                                <i class="bi bi-send"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <p class="mb-0">&copy; {{ date('Y') }} YomuBooks. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <a href="#" class="me-3">Privacy Policy</a>
                        <a href="#" class="me-3">Terms of Service</a>
                        <a href="#">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scroll Effects -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>