<?php
/**
 * RentSure Shared Hosting Installation Script
 * Run this once after uploading files to set up the database and create test users
 * Supports both root directory and subfolder deployment
 */

// Detect if we're in a subfolder
$scriptPath = $_SERVER['SCRIPT_NAME'];
$subfolder = dirname($scriptPath);
$isSubfolder = $subfolder !== '/';
$baseUrl = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $subfolder;

// Check if already installed
if (file_exists('.installed')) {
    die('<h1>RentSure Already Installed</h1><p><a href="' . $subfolder . '/">Go to App</a></p>');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentSure Installation</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { color: green; } .error { color: red; } .info { color: blue; }
        .step { background: #f5f5f5; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .credentials { background: #e8f5e8; padding: 15px; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <h1>🏠 RentSure Installation</h1>
    <p>Setting up your RentSure application on shared hosting...</p>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Load Laravel
        require_once 'vendor/autoload.php';
        $app = require_once 'bootstrap/app.php';
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

        echo '<div class="step">';
        echo '<h3>Step 1: Testing Database Connection</h3>';
        
        // Test database connection
        $pdo = new PDO(
            'mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_DATABASE'),
            env('DB_USERNAME'),
            env('DB_PASSWORD')
        );
        echo '<p class="success">✅ Database connection successful!</p>';
        echo '</div>';

        echo '<div class="step">';
        echo '<h3>Step 2: Running Database Migrations</h3>';
        
        // Run migrations
        $kernel->call('migrate', ['--force' => true]);
        echo '<p class="success">✅ Database tables created successfully!</p>';
        echo '</div>';

        echo '<div class="step">';
        echo '<h3>Step 3: Creating Test Users</h3>';
        
        // Create test users manually (in case seeder doesn't work)
        $users = [
            [
                'name' => 'RentSure Admin',
                'email' => 'admin@rentsure.com',
                'phone_number' => '+2348012345678',
                'role' => 'admin',
                'state' => 'Lagos',
                'address' => 'Victoria Island, Lagos',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'verified' => 1,
                'verification_badge' => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Test Landlord',
                'email' => 'landlord@test.com',
                'phone_number' => '+2348012345679',
                'role' => 'landlord',
                'state' => 'Lagos',
                'address' => 'Lekki Phase 1, Lagos',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'verified' => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Test Agent',
                'email' => 'agent@test.com',
                'phone_number' => '+2348012345680',
                'role' => 'agent',
                'state' => 'Lagos',
                'address' => 'Ikeja, Lagos',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'verified' => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Test Tenant',
                'email' => 'tenant@test.com',
                'phone_number' => '+2348012345681',
                'role' => 'tenant',
                'state' => 'Lagos',
                'address' => 'Surulere, Lagos',
                'nin' => '12345678901',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'verified' => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        foreach ($users as $user) {
            $stmt = $pdo->prepare("INSERT IGNORE INTO users (name, email, phone_number, role, state, address, nin, password, verified, verification_badge, email_verified_at, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $user['name'], $user['email'], $user['phone_number'], $user['role'], 
                $user['state'], $user['address'], $user['nin'] ?? null, $user['password'], 
                $user['verified'], $user['verification_badge'] ?? 0, $user['email_verified_at'], 
                $user['created_at'], $user['updated_at']
            ]);
        }
        
        echo '<p class="success">✅ Test users created successfully!</p>';
        echo '</div>';

        echo '<div class="step">';
        echo '<h3>Step 4: Optimizing Application</h3>';
        
        // Clear and cache configurations
        try {
            $kernel->call('config:cache');
            $kernel->call('route:cache');
            echo '<p class="success">✅ Application optimized!</p>';
        } catch (Exception $e) {
            echo '<p class="info">ℹ️ Optimization skipped (not critical)</p>';
        }
        echo '</div>';

        // Mark as installed
        file_put_contents('.installed', date('Y-m-d H:i:s'));

        echo '<div class="credentials">';
        echo '<h2>🎉 Installation Complete!</h2>';
        echo '<p><strong>Your RentSure app is now ready for testing!</strong></p>';
        echo '<h3>🔑 Test Accounts:</h3>';
        echo '<ul>';
        echo '<li><strong>Admin:</strong> admin@rentsure.com / admin123</li>';
        echo '<li><strong>Landlord:</strong> landlord@test.com / password</li>';
        echo '<li><strong>Agent:</strong> agent@test.com / password</li>';
        echo '<li><strong>Tenant:</strong> tenant@test.com / password</li>';
        echo '</ul>';
        // Update .env file with correct APP_URL for subfolder
        if (file_exists('.env')) {
            $envContent = file_get_contents('.env');
            $envContent = preg_replace('/APP_URL=.*/', 'APP_URL=' . $baseUrl, $envContent);
            file_put_contents('.env', $envContent);
            echo '<p class="success">✅ Configuration updated for ' . ($isSubfolder ? 'subfolder' : 'root') . ' deployment!</p>';
        }
        
        echo '<p><a href="' . $subfolder . '/" style="background: #0000ff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">🚀 Launch RentSure App</a></p>';
        echo '</div>';

        // Delete this file for security
        echo '<script>setTimeout(function(){ window.location.href = "' . $subfolder . '/"; }, 5000);</script>';
        
    } catch (Exception $e) {
        echo '<div class="step">';
        echo '<h3 class="error">❌ Installation Error</h3>';
        echo '<p class="error">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
        echo '<p>Please check your .env file configuration and try again.</p>';
        echo '</div>';
    }
} else {
    // Show installation form
    ?>
    <div class="step">
        <h3>Pre-Installation Checklist:</h3>
        <ul>
            <li>✅ Files uploaded to shared hosting</li>
            <li>✅ MySQL database created</li>
            <li>✅ .env file configured with database details</li>
            <li>✅ File permissions set (storage/ and bootstrap/cache/ = 755)</li>
        </ul>
    </div>

    <div class="step">
        <h3>Ready to Install?</h3>
        <p>This will set up your database tables and create test user accounts.</p>
        <form method="POST">
            <button type="submit" style="background: #0000ff; color: white; padding: 15px 30px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
                🚀 Install RentSure
            </button>
        </form>
    </div>

    <div class="step">
        <h3>Need Help?</h3>
        <p>If you encounter issues:</p>
        <ol>
            <li>Check your .env file has correct database credentials</li>
            <li>Ensure your hosting supports PHP 8.0+ and MySQL</li>
            <li>Verify file permissions are set correctly</li>
            <li>Contact your hosting provider if database connection fails</li>
        </ol>
    </div>
    <?php
}
?>

</body>
</html>
