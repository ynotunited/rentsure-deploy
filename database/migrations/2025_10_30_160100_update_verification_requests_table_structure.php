<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVerificationRequestsTableStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('verification_requests', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('verification_requests', 'notes')) {
                $table->text('notes')->nullable()->after('status');
            }
            if (!Schema::hasColumn('verification_requests', 'submitted_at')) {
                $table->timestamp('submitted_at')->useCurrent()->after('notes');
            }
            if (!Schema::hasColumn('verification_requests', 'reviewed_at')) {
                $table->timestamp('reviewed_at')->nullable()->after('submitted_at');
            }
            if (!Schema::hasColumn('verification_requests', 'reviewed_by')) {
                $table->foreignId('reviewed_by')->nullable()->constrained('users')->after('reviewed_at');
            }
        });
        
        // Update status enum if needed
        DB::statement("ALTER TABLE verification_requests MODIFY COLUMN status ENUM('pending', 'under_review', 'approved', 'rejected') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('verification_requests', function (Blueprint $table) {
            $table->dropColumn(['notes', 'submitted_at', 'reviewed_at']);
            $table->dropForeign(['reviewed_by']);
            $table->dropColumn('reviewed_by');
        });
    }
}
