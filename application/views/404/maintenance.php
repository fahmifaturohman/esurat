<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Sedang Maintenance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            box-sizing: border-box;
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-delayed {
            animation: float 6s ease-in-out infinite;
            animation-delay: -2s;
        }
        
        .floating-delayed-2 {
            animation: float 6s ease-in-out infinite;
            animation-delay: -4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotateX(0deg) rotateY(0deg); }
            50% { transform: translateY(-20px) rotateX(10deg) rotateY(5deg); }
        }
        
        .cube {
            width: 80px;
            height: 80px;
            position: relative;
            transform-style: preserve-3d;
            animation: rotateCube 20s infinite linear;
        }
        
        .cube-face {
            position: absolute;
            width: 80px;
            height: 80px;
            border: 2px solid rgba(99, 102, 241, 0.3);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1));
        }
        
        .cube-face.front { transform: rotateY(0deg) translateZ(40px); }
        .cube-face.back { transform: rotateY(180deg) translateZ(40px); }
        .cube-face.right { transform: rotateY(90deg) translateZ(40px); }
        .cube-face.left { transform: rotateY(-90deg) translateZ(40px); }
        .cube-face.top { transform: rotateX(90deg) translateZ(40px); }
        .cube-face.bottom { transform: rotateX(-90deg) translateZ(40px); }
        
        @keyframes rotateCube {
            0% { transform: rotateX(0deg) rotateY(0deg); }
            100% { transform: rotateX(360deg) rotateY(360deg); }
        }
        
        .sphere {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            position: relative;
        }
        
        .sphere::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 15px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            filter: blur(2px);
        }
        
        .pyramid {
            width: 0;
            height: 0;
            border-left: 40px solid transparent;
            border-right: 40px solid transparent;
            border-bottom: 70px solid #f093fb;
            position: relative;
            filter: drop-shadow(0 10px 20px rgba(240, 147, 251, 0.3));
        }
        
        .pyramid::before {
            content: '';
            position: absolute;
            top: 0;
            left: -40px;
            width: 0;
            height: 0;
            border-left: 40px solid transparent;
            border-right: 40px solid transparent;
            border-bottom: 70px solid rgba(255, 255, 255, 0.2);
            transform: rotateY(60deg);
        }
        
        .progress-ring {
            transform: rotate(-90deg);
        }
        
        .progress-ring-circle {
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            animation: progress 3s ease-in-out infinite;
        }
        
        @keyframes progress {
            0% { stroke-dashoffset: 283; }
            50% { stroke-dashoffset: 70; }
            100% { stroke-dashoffset: 283; }
        }
        
        .glow {
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
        }
        
        .text-glow {
            text-shadow: 0 0 20px rgba(99, 102, 241, 0.5);
        }
    </style>
</head>
<body class="h-full bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 overflow-hidden">
    <div class="min-h-full flex items-center justify-center relative">
        <!-- Background 3D Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Floating Cubes -->
            <div class="cube floating absolute top-20 left-20">
                <div class="cube-face front"></div>
                <div class="cube-face back"></div>
                <div class="cube-face right"></div>
                <div class="cube-face left"></div>
                <div class="cube-face top"></div>
                <div class="cube-face bottom"></div>
            </div>
            
            <div class="cube floating-delayed absolute top-40 right-32">
                <div class="cube-face front"></div>
                <div class="cube-face back"></div>
                <div class="cube-face right"></div>
                <div class="cube-face left"></div>
                <div class="cube-face top"></div>
                <div class="cube-face bottom"></div>
            </div>
            
            <!-- Floating Spheres -->
            <div class="sphere floating-delayed absolute bottom-32 left-40"></div>
            <div class="sphere floating absolute top-60 right-20"></div>
            <div class="sphere floating-delayed-2 absolute bottom-20 right-60"></div>
            
            <!-- Floating Pyramids -->
            <div class="pyramid floating-delayed-2 absolute top-32 left-1/2"></div>
            <div class="pyramid floating absolute bottom-40 left-20"></div>
        </div>
        
        <!-- Main Content -->
        <div class="text-center z-10 px-6 max-w-2xl">
            <!-- Main Icon with 3D Effect -->
            <div class="mb-8 flex justify-center">
                <div class="relative">
                    <svg class="progress-ring w-32 h-32" viewBox="0 0 100 100">
                        <circle class="progress-ring-circle" stroke="url(#gradient)" stroke-width="4" fill="transparent" r="45" cx="50" cy="50"/>
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#667eea;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#764ba2;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-16 h-16 text-indigo-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Title -->
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 text-glow">
                Sedang Maintenance
            </h1>
            
            <!-- Subtitle -->
            <p class="text-xl md:text-2xl text-gray-300 mb-8 leading-relaxed">
                Kami sedang melakukan pemeliharaan sistem untuk memberikan pengalaman yang lebih baik
            </p>
            
            
            <!-- Contact Info -->
            <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                <p class="text-gray-300 mb-4">
                    Estimasi selesai: <span class="text-indigo-400 font-semibold">2-3 jam</span>
                </p>
                <p class="text-gray-400 text-sm">
                    Untuk informasi lebih lanjut, hubungi tim IT Pengadilan Tinggi Agama Bandar Lampung
                </p>
            </div>
        </div>
        
        <!-- Bottom Decoration -->
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-black/20 to-transparent"></div>
    </div>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'98b6a29303a35e29',t:'MTc1OTkzNjk2MC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
