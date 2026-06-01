<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Denver Limo Cars | Premium Colorado Transportation')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin=""/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet"/>
    
    <!-- Material Symbols Outlined -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "outline": "#9a8f80",
                        "inverse-on-surface": "#303030",
                        "on-secondary": "#313030",
                        "primary-fixed-dim": "#e9c176",
                        "on-tertiary-container": "#3b3b3b",
                        "surface-tint": "#e9c176",
                        "primary-fixed": "#ffdea5",
                        "tertiary-container": "#a7a5a5",
                        "inverse-primary": "#775a19",
                        "primary": "#c5a059",
                        "on-secondary-fixed-variant": "#474646",
                        "tertiary-fixed": "#e5e2e1",
                        "on-secondary-container": "#bab8b7",
                        "surface": "#131313",
                        "surface-container": "#1f1f1f",
                        "surface-container-high": "#2a2a2a",
                        "on-surface": "#e2e2e2",
                        "secondary": "#c8c6c5",
                        "on-tertiary": "#313030",
                        "primary-container": "#c5a059",
                        "on-tertiary-fixed": "#1c1b1b",
                        "inverse-surface": "#e2e2e2",
                        "secondary-fixed": "#e5e2e1",
                        "surface-variant": "#353535",
                        "error-container": "#93000a",
                        "on-error-container": "#ffdad6",
                        "background": "#131313",
                        "secondary-fixed-dim": "#c8c6c5",
                        "on-primary-container": "#4e3700",
                        "surface-dim": "#131313",
                        "on-primary-fixed-variant": "#5d4201",
                        "secondary-container": "#4a4949",
                        "error": "#ffb4ab",
                        "on-surface-variant": "#d1c5b4",
                        "surface-container-highest": "#353535",
                        "on-primary": "#412d00",
                        "surface-container-low": "#1b1b1b",
                        "tertiary": "#c8c6c5",
                        "on-secondary-fixed": "#1c1b1b",
                        "surface-container-lowest": "#0e0e0e",
                        "tertiary-fixed-dim": "#c8c6c5",
                        "on-primary-fixed": "#261900",
                        "on-background": "#e2e2e2",
                        "outline-variant": "#4e4639",
                        "on-tertiary-fixed-variant": "#474746",
                        "surface-bright": "#393939",
                        "on-error": "#690005"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "margin-mobile": "20px",
                        "unit-md": "16px",
                        "unit-sm": "8px",
                        "unit-xs": "4px",
                        "margin-desktop": "64px",
                        "unit-lg": "32px",
                        "unit-xl": "64px",
                        "container-max": "1280px"
                    },
                    "fontFamily": {
                        "body-lg": ["Montserrat"],
                        "label-sm": ["Montserrat"],
                        "headline-lg": ["Playfair Display"],
                        "headline-md": ["Playfair Display"],
                        "display-lg-mobile": ["Playfair Display"],
                        "display-lg": ["Playfair Display"],
                        "label-lg": ["Montserrat"],
                        "body-md": ["Montserrat"]
                    }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        /* Custom Input styling for the booking widget */
        .widget-input {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            color: #1a202c;
            border-radius: 0.25rem;
            transition: all 0.3s ease;
        }
        .widget-input:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(197, 160, 89, 0.2);
            border-color: #c5a059;
        }
        /* Custom input styling for the dark/gold luxury forms */
        .luxury-input {
            background-color: #1a1a1a;
            border: none;
            border-bottom: 2px solid #333;
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }
        .luxury-input:focus {
            outline: none;
            box-shadow: none;
            border-bottom-color: #c5a059;
            background-color: #222;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
    </style>
</head>
<body class="bg-[#131313] text-on-background font-body-md antialiased min-h-screen flex flex-col selection:bg-primary/30 selection:text-primary-fixed">

    <!-- TopNavBar -->
    <nav style="background:rgba(0,0,0,.92);position:fixed;top:0;width:100%;z-index:50;border-bottom:1px solid rgba(197,160,89,.12);">
        <div class="flex justify-between items-center px-6 md:px-16 max-w-6xl mx-auto" style="height:68px;">
            
            <!-- Brand Logo -->
            <a href="/" class="flex flex-col items-center leading-none text-center" style="text-decoration:none;">
                <span style="font-family:'Playfair Display',serif;font-weight:700;font-size:1.15rem;color:#c5a059;letter-spacing:.2em;text-transform:uppercase;">Denver</span>
                <div style="width:100px;height:1px;background:#c5a059;margin:3px 0;"></div>
                <span style="font-family:Montserrat,sans-serif;font-size:.6rem;color:#c5a059;text-transform:uppercase;letter-spacing:.32em;font-weight:600;">Limo Cars</span>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center" style="gap:2rem;">
                <a href="/" style="font-family:Montserrat,sans-serif;font-size:.88rem;color:{{ request()->is('/') ? '#c5a059' : '#e2e2e2' }};font-weight:{{ request()->is('/') ? '700' : '400' }};text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#c5a059'" onmouseout="this.style.color='{{ request()->is('/') ? '#c5a059' : '#e2e2e2' }}'">Home</a>
                <a href="/services" style="font-family:Montserrat,sans-serif;font-size:.88rem;color:{{ request()->is('services') ? '#c5a059' : '#e2e2e2' }};font-weight:{{ request()->is('services') ? '700' : '400' }};text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#c5a059'" onmouseout="this.style.color='{{ request()->is('services') ? '#c5a059' : '#e2e2e2' }}'">Services</a>
                <a href="/fleet" style="font-family:Montserrat,sans-serif;font-size:.88rem;color:{{ request()->is('fleet') ? '#c5a059' : '#e2e2e2' }};font-weight:{{ request()->is('fleet') ? '700' : '400' }};text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#c5a059'" onmouseout="this.style.color='{{ request()->is('fleet') ? '#c5a059' : '#e2e2e2' }}'">Fleet</a>
                <a href="/contact" style="font-family:Montserrat,sans-serif;font-size:.88rem;color:{{ request()->is('contact') ? '#c5a059' : '#e2e2e2' }};font-weight:{{ request()->is('contact') ? '700' : '400' }};text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#c5a059'" onmouseout="this.style.color='{{ request()->is('contact') ? '#c5a059' : '#e2e2e2' }}'">Contact</a>
            </div>
            
            <!-- Trailing Actions (Profile/Dashboard Toggle) -->
            <div class="flex items-center space-x-4">
                <!-- <a href="/trips" class="text-primary hover:text-primary-fixed-dim transition-colors p-2 rounded-full hover:bg-surface-variant/40" title="Manage Trips">
                    <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">account_circle</span>
                </a> -->
                
                <!-- Mobile Burger Menu -->
                <button onclick="toggleMobileMenu()" class="md:hidden text-primary p-2 focus:outline-none" aria-label="Toggle menu">
                    <span class="material-symbols-outlined text-3xl">menu</span>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="hidden md:hidden" style="background:#0d0d0d;border-top:1px solid rgba(197,160,89,.15);">
            <a href="/" style="display:flex;align-items:center;gap:10px;font-family:Montserrat,sans-serif;font-size:.92rem;color:{{ request()->is('/') ? '#c5a059' : '#e2e2e2' }};padding:14px 24px;border-bottom:1px solid rgba(255,255,255,.05);font-weight:{{ request()->is('/') ? '700' : '400' }};">
                <span class="material-symbols-outlined" style="font-size:18px;color:#c5a059;">home</span> Home
            </a>
            <a href="/services" style="display:flex;align-items:center;gap:10px;font-family:Montserrat,sans-serif;font-size:.92rem;color:{{ request()->is('services') ? '#c5a059' : '#e2e2e2' }};padding:14px 24px;border-bottom:1px solid rgba(255,255,255,.05);font-weight:{{ request()->is('services') ? '700' : '400' }};">
                <span class="material-symbols-outlined" style="font-size:18px;color:#c5a059;">local_taxi</span> Services
            </a>
            <a href="/fleet" style="display:flex;align-items:center;gap:10px;font-family:Montserrat,sans-serif;font-size:.92rem;color:{{ request()->is('fleet') ? '#c5a059' : '#e2e2e2' }};padding:14px 24px;border-bottom:1px solid rgba(255,255,255,.05);font-weight:{{ request()->is('fleet') ? '700' : '400' }};">
                <span class="material-symbols-outlined" style="font-size:18px;color:#c5a059;">directions_car</span> Fleet
            </a>
            <a href="/contact" style="display:flex;align-items:center;gap:10px;font-family:Montserrat,sans-serif;font-size:.92rem;color:{{ request()->is('contact') ? '#c5a059' : '#e2e2e2' }};padding:14px 24px;border-bottom:1px solid rgba(255,255,255,.05);font-weight:{{ request()->is('contact') ? '700' : '400' }};">
                <span class="material-symbols-outlined" style="font-size:18px;color:#c5a059;">mail</span> Contact
            </a>
            <a href="/trips" style="display:flex;align-items:center;gap:10px;font-family:Montserrat,sans-serif;font-size:.92rem;color:#c5a059;padding:14px 24px;font-weight:600;">
                <span class="material-symbols-outlined" style="font-size:18px;color:#c5a059;" style="font-variation-settings:'FILL' 1;">account_circle</span> My Trips
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow" style="padding-top:68px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black text-on-surface-variant w-full pt-16 pb-12 border-t border-outline/10 mt-auto font-body-sm">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            
            <!-- Column 1: Contact Info -->
            <div class="md:col-span-4 space-y-4 text-left">
                <h3 class="font-label-lg text-label-lg text-primary uppercase tracking-widest font-bold">Contact Info</h3>
                <ul class="space-y-3 text-on-surface-variant opacity-85">
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings: 'FILL' 1;">call</span>
                        <span>+1-720-671-4118</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings: 'FILL' 1;">mail</span>
                        <span>info@denvercars.com</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings: 'FILL' 1;">location_on</span>
                        <span>2800 W 103rd Ave, Federal Heights, CO 80260, USA</span>
                    </li>
                </ul>
            </div>
            
            <!-- Column 2: Quick Links -->
            <div class="md:col-span-4 space-y-4 text-left md:pl-12">
                <h3 class="font-label-lg text-label-lg text-primary uppercase tracking-widest font-bold">Quick Links</h3>
                <ul class="space-y-2 text-on-surface-variant opacity-85">
                    <li><a href="/about" class="hover:text-primary transition-colors">About</a></li>
                    <li><a href="/services" class="hover:text-primary transition-colors">Quick Links</a></li>
                    <li><a href="/contact" class="hover:text-primary transition-colors">Contact</a></li>
                </ul>
            </div>
            
            <!-- Column 3: Socials & Payments -->
            <div class="md:col-span-4 space-y-6 text-left md:text-right flex flex-col md:items-end justify-between">
                <!-- Social media icons -->
                <div class="space-y-3 w-full">
                    <div class="flex gap-4 md:justify-end">
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container border border-outline/10 text-on-surface hover:text-primary hover:border-primary transition-all">
                            <span class="material-symbols-outlined text-lg">share</span>
                        </a>
                    </div>
                </div>
                
                <!-- Payment methods -->
                <div class="flex gap-3 md:justify-end items-center flex-wrap pt-4 border-t border-outline/10 w-full">
                    <span class="text-xs uppercase tracking-wider text-on-surface-variant opacity-60 mr-2">We Accept:</span>
                    <span class="bg-white/10 px-2 py-1 rounded text-[10px] font-bold text-white tracking-widest uppercase">Visa</span>
                    <span class="bg-white/10 px-2 py-1 rounded text-[10px] font-bold text-white tracking-widest uppercase">Mastercard</span>
                    <span class="bg-white/10 px-2 py-1 rounded text-[10px] font-bold text-white tracking-widest uppercase">Amex</span>
                </div>
            </div>
        </div>
        
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mt-12 pt-8 border-t border-outline/5 text-center text-xs text-on-surface-variant opacity-50">
            &copy; {{ date('Y') }} Denver Limo Cars. All Rights Reserved.
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-2 group">
        <!-- Message bubble -->
        <div id="whatsapp-bubble" class="bg-black/90 backdrop-blur-md border border-[#c5a059]/30 text-white text-xs px-4 py-2.5 rounded-xl shadow-2xl transition-all duration-500 transform translate-y-4 opacity-0 pointer-events-none flex items-center gap-2 max-w-[250px] relative group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto">
            <span class="w-2.5 h-2.5 bg-green-500 rounded-full relative flex">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
            </span>
            <div class="flex flex-col">
                <span class="font-bold text-[#c5a059] uppercase tracking-wider text-[9px] mb-0.5">Denver Limo Cars Support</span>
                <span class="font-body-md text-gray-200">How can we assist you today?</span>
            </div>
            <!-- Close Button for Bubble -->
            <button onclick="closeWhatsappBubble(event)" class="absolute -top-1.5 -right-1.5 bg-neutral-900 border border-[#c5a059]/20 hover:border-[#c5a059] rounded-full w-4 h-4 flex items-center justify-center text-[10px] text-gray-400 hover:text-white transition-colors pointer-events-auto" aria-label="Close message">
                <span class="material-symbols-outlined text-[10px]" style="font-variation-settings: 'wght' 600;">close</span>
            </button>
        </div>
        <!-- Button -->
        <a href="https://wa.me/17206714118?text=Hello%20Denver%20Limo%20Cars,%20I'd%20like%20to%20inquire%20about%20a%20booking."
           target="_blank"
           rel="noopener noreferrer"
           class="flex items-center justify-center w-14 h-14 bg-[#25D366] text-white rounded-full shadow-[0_8px_30px_rgba(37,211,102,0.4)] hover:shadow-[0_8px_30px_rgba(37,211,102,0.7)] hover:bg-[#20ba5a] transform hover:scale-105 active:scale-95 transition-all duration-300 relative"
           aria-label="Chat on WhatsApp">
            <!-- Pulsing outer ring -->
            <span class="absolute inset-0 rounded-full bg-[#25D366]/40 animate-ping -z-10"></span>
            
            <!-- WhatsApp SVG Icon -->
            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.012 2C6.48 2 2 6.48 2 12.012c0 1.764.468 3.48 1.344 5.004L2 22l5.124-1.344c1.476.804 3.144 1.236 4.884 1.236 5.532 0 10.02-4.488 10.02-10.012C22.028 6.48 17.54 2 12.012 2zm6.072 13.908c-.264.744-1.284 1.356-1.788 1.416-.48.06-1.08.312-3.216-.528-2.736-1.08-4.488-3.864-4.62-4.044-.132-.18-1.044-1.392-1.044-2.652 0-1.26.66-1.872.9-2.136.24-.264.528-.324.7-.324.18 0 .36 0 .516.012.168.012.396-.06.624.492.24.576.816 1.992.888 2.136.072.144.12.312.024.504-.096.192-.144.312-.288.48-.144.168-.312.384-.444.516-.144.144-.3.3-.132.588.168.288.756 1.248 1.62 2.016.9 2.016.9.792 1.62 1.668.72.876.84 1.008 1.224 1.308.384.3.72.396.984.096.264-.3.984-1.152 1.248-1.548.264-.396.528-.324.888-.192.36.132 2.292 1.08 2.688 1.284.396.204.66.3.756.468.096.168.096.96-.168 1.704z"/>
            </svg>
        </a>
    </div>

    <script>
        function toggleMobileMenu() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Check if the WhatsApp bubble was previously closed
        if (localStorage.getItem('whatsapp_bubble_closed')) {
            var bubble = document.getElementById('whatsapp-bubble');
            if (bubble) bubble.style.display = 'none';
        } else {
            // Entrance delay for WhatsApp bubble
            setTimeout(function() {
                var bubble = document.getElementById('whatsapp-bubble');
                if (bubble && !localStorage.getItem('whatsapp_bubble_closed')) {
                    bubble.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
                    bubble.classList.add('opacity-100', 'translate-y-0');
                }
            }, 4000);
        }

        function closeWhatsappBubble(e) {
            e.preventDefault();
            e.stopPropagation();
            var bubble = document.getElementById('whatsapp-bubble');
            if (bubble) {
                bubble.style.display = 'none';
                localStorage.setItem('whatsapp_bubble_closed', 'true');
            }
        }
    </script>
</body>
</html>
