<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'RentSure') }} - Mobile Only</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('rentsure-favicon') }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0000ff 0%, #00001a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .mobile-only-container {
            max-width: 90%;
            text-align: center;
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .phone-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: #0000ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .phone-icon svg {
            width: 40px;
            height: 40px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="mobile-only-container">
        <div class="mb-6 flex justify-center">
            <img src="{{ asset('images/rentsure-logoblack.png') }}" alt="RentSure Logo" class="h-12 w-auto">
        </div>
        
        <div class="phone-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Mobile-Optimized Web Application</h1>
        
        <p class="text-gray-600 mb-6">
            RentSure is designed exclusively for mobile devices to provide the best user experience. 
            Please access this website on your smartphone or tablet.
        </p>
        
        <div class="bg-[#f0f0f0] border-l-4 border-[#0000ff] p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-[#0000ff]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-[#00001a]">
                        <strong>Why mobile optimized?</strong> RentSure leverages mobile-specific features like camera access for document uploads and location services for property verification.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="flex justify-center">
            <a href="{{ url('/') }}" class="px-6 py-3 bg-[#0000ff] text-white rounded-md font-medium hover:bg-[#00001a] transition-colors">
                Try Again on Mobile
            </a>
        </div>
        
        <p class="text-xs text-gray-500 mt-6">
            If you're already on a mobile device and seeing this message, please ensure your browser is not in desktop mode and try rotating your device to portrait mode.
        </p>
    </div>
</body>
</html>