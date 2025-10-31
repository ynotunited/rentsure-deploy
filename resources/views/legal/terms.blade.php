@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="px-4 py-6 max-w-md mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Terms of Service</h1>
            <p class="text-gray-600 dark:text-gray-400">Last updated: October 30, 2025</p>
        </div>

        <!-- Terms Content -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
            <div class="space-y-6 text-gray-700 dark:text-gray-300">
                
                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">1. Acceptance of Terms</h2>
                    <p class="text-sm leading-relaxed">
                        By accessing and using RentSure, you accept and agree to be bound by the terms and provision of this agreement. 
                        RentSure is a landlord-tenant verification platform designed for the Nigerian rental market.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">2. User Accounts</h2>
                    <p class="text-sm leading-relaxed mb-2">
                        Users can register as one of four roles:
                    </p>
                    <ul class="text-sm space-y-1 ml-4">
                        <li>• <strong>Tenant:</strong> Individuals seeking rental properties</li>
                        <li>• <strong>Landlord:</strong> Property owners renting out properties</li>
                        <li>• <strong>Agent:</strong> Real estate agents facilitating rentals</li>
                        <li>• <strong>Admin:</strong> Platform administrators</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">3. Verification System</h2>
                    <p class="text-sm leading-relaxed">
                        RentSure provides a verification system including NIN (National Identification Number) verification, 
                        document upload, and verification badges. Users consent to verification processes to build trust 
                        within the platform.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">4. User Responsibilities</h2>
                    <ul class="text-sm space-y-2">
                        <li>• Provide accurate and truthful information</li>
                        <li>• Upload genuine documents for verification</li>
                        <li>• Respect other users and maintain professional conduct</li>
                        <li>• Comply with Nigerian laws and regulations</li>
                        <li>• Keep account credentials secure</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">5. Prohibited Activities</h2>
                    <ul class="text-sm space-y-2">
                        <li>• Providing false or misleading information</li>
                        <li>• Uploading fraudulent documents</li>
                        <li>• Harassment or discrimination</li>
                        <li>• Attempting to circumvent verification systems</li>
                        <li>• Using the platform for illegal activities</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">6. Reviews and Ratings</h2>
                    <p class="text-sm leading-relaxed">
                        Users may leave reviews and ratings. All reviews are subject to approval by landlords. 
                        Reviews must be honest, fair, and based on actual experiences. Fake or malicious reviews are prohibited.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">7. Privacy and Data Protection</h2>
                    <p class="text-sm leading-relaxed">
                        Your privacy is important to us. Please review our Privacy Policy to understand how we collect, 
                        use, and protect your personal information, including NIN and document data.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">8. Platform Availability</h2>
                    <p class="text-sm leading-relaxed">
                        RentSure is designed exclusively for mobile devices. We strive to maintain platform availability 
                        but do not guarantee uninterrupted service. Maintenance and updates may cause temporary downtime.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">9. Limitation of Liability</h2>
                    <p class="text-sm leading-relaxed">
                        RentSure serves as a platform connecting landlords and tenants. We are not responsible for 
                        rental agreements, property conditions, or disputes between users. Users engage at their own risk.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">10. Termination</h2>
                    <p class="text-sm leading-relaxed">
                        We reserve the right to terminate or suspend accounts that violate these terms. 
                        Users may also delete their accounts at any time through the platform settings.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">11. Governing Law</h2>
                    <p class="text-sm leading-relaxed">
                        These terms are governed by the laws of the Federal Republic of Nigeria. 
                        Any disputes will be resolved in Nigerian courts.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">12. Contact Information</h2>
                    <p class="text-sm leading-relaxed">
                        For questions about these Terms of Service, please contact us through the platform 
                        or email us at legal@rentsure.com.
                    </p>
                </section>

            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Go Back
            </a>
        </div>

        <!-- Bottom Spacing -->
        <div class="pb-20"></div>
    </div>
</div>
@endsection
