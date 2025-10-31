@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="px-4 py-6 max-w-md mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Privacy Policy</h1>
            <p class="text-gray-600 dark:text-gray-400">Last updated: October 30, 2025</p>
        </div>

        <!-- Privacy Content -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-700 mb-6">
            <div class="space-y-6 text-gray-700 dark:text-gray-300">
                
                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">1. Information We Collect</h2>
                    <p class="text-sm leading-relaxed mb-2">We collect the following types of information:</p>
                    <ul class="text-sm space-y-1 ml-4">
                        <li>• <strong>Personal Information:</strong> Name, email, phone number</li>
                        <li>• <strong>Identity Information:</strong> NIN (National Identification Number)</li>
                        <li>• <strong>Location Data:</strong> State, address, GPS coordinates</li>
                        <li>• <strong>Documents:</strong> ID cards, rental documents, live photos</li>
                        <li>• <strong>Usage Data:</strong> Platform interactions and preferences</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">2. How We Use Your Information</h2>
                    <ul class="text-sm space-y-2">
                        <li>• <strong>Verification:</strong> Verify identity and build trust</li>
                        <li>• <strong>Matching:</strong> Connect landlords with verified tenants</li>
                        <li>• <strong>Communication:</strong> Send important platform updates</li>
                        <li>• <strong>Security:</strong> Prevent fraud and maintain platform safety</li>
                        <li>• <strong>Improvement:</strong> Enhance platform features and user experience</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">3. NIN Verification</h2>
                    <p class="text-sm leading-relaxed">
                        We collect and verify National Identification Numbers (NIN) to ensure user authenticity. 
                        NIN data is encrypted and stored securely. We may integrate with official Nigerian 
                        verification services to validate NIN information.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">4. Document Storage</h2>
                    <p class="text-sm leading-relaxed">
                        Uploaded documents (ID cards, rental documents, live photos) are stored securely with 
                        encryption. Documents are reviewed by administrators for verification purposes. 
                        We retain documents as long as your account is active.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">5. Location Services</h2>
                    <p class="text-sm leading-relaxed">
                        We use Google Maps services to verify addresses and provide location-based features. 
                        Location data helps match users with nearby properties and ensures address accuracy.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">6. Information Sharing</h2>
                    <p class="text-sm leading-relaxed mb-2">We share information in limited circumstances:</p>
                    <ul class="text-sm space-y-1 ml-4">
                        <li>• <strong>Verification Status:</strong> Share verification badges with other users</li>
                        <li>• <strong>Reviews:</strong> Display approved reviews and ratings</li>
                        <li>• <strong>Legal Requirements:</strong> Comply with Nigerian law enforcement</li>
                        <li>• <strong>Service Providers:</strong> Trusted partners for platform operations</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">7. Data Security</h2>
                    <p class="text-sm leading-relaxed">
                        We implement industry-standard security measures including encryption, secure servers, 
                        and access controls. However, no system is 100% secure. We continuously monitor and 
                        improve our security practices.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">8. Your Rights</h2>
                    <ul class="text-sm space-y-2">
                        <li>• <strong>Access:</strong> Request copies of your personal data</li>
                        <li>• <strong>Correction:</strong> Update incorrect information</li>
                        <li>• <strong>Deletion:</strong> Request account and data deletion</li>
                        <li>• <strong>Portability:</strong> Export your data in standard formats</li>
                        <li>• <strong>Objection:</strong> Object to certain data processing activities</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">9. Data Retention</h2>
                    <p class="text-sm leading-relaxed">
                        We retain your data while your account is active and for a reasonable period afterward 
                        for legal and business purposes. Verification documents may be retained longer to 
                        maintain platform trust and security.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">10. Third-Party Services</h2>
                    <p class="text-sm leading-relaxed">
                        We use third-party services including Google Maps for address verification and 
                        cloud storage providers. These services have their own privacy policies and 
                        data handling practices.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">11. Mobile-Only Platform</h2>
                    <p class="text-sm leading-relaxed">
                        RentSure is designed exclusively for mobile devices. We collect mobile device 
                        information for security and optimization purposes. Desktop access is restricted 
                        to maintain platform security.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">12. Children's Privacy</h2>
                    <p class="text-sm leading-relaxed">
                        RentSure is not intended for users under 18 years old. We do not knowingly collect 
                        personal information from children. If we discover such information, we will delete it promptly.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">13. Changes to Privacy Policy</h2>
                    <p class="text-sm leading-relaxed">
                        We may update this Privacy Policy periodically. Users will be notified of significant 
                        changes through the platform. Continued use constitutes acceptance of updated terms.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">14. Contact Us</h2>
                    <p class="text-sm leading-relaxed">
                        For privacy-related questions or to exercise your rights, contact us at 
                        privacy@rentsure.com or through the platform's contact features.
                    </p>
                </section>

                <section class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                    <h3 class="text-sm font-semibold text-blue-900 dark:text-blue-200 mb-2">🇳🇬 Nigerian Data Protection</h3>
                    <p class="text-xs text-blue-800 dark:text-blue-300">
                        This Privacy Policy complies with the Nigeria Data Protection Regulation (NDPR) and 
                        other applicable Nigerian privacy laws. We are committed to protecting the privacy 
                        rights of Nigerian citizens.
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
