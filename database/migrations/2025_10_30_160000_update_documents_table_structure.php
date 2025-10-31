<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDocumentsTableStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('documents', 'type')) {
                $table->enum('type', ['live_photo', 'rental_document', 'id_document', 'proof_of_income', 'other'])->after('user_id');
            }
            if (!Schema::hasColumn('documents', 'original_name')) {
                $table->string('original_name')->after('type');
            }
            if (!Schema::hasColumn('documents', 'file_size')) {
                $table->string('file_size')->after('file_path');
            }
            if (!Schema::hasColumn('documents', 'mime_type')) {
                $table->string('mime_type')->after('file_size');
            }
            if (!Schema::hasColumn('documents', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('mime_type');
            }
            if (!Schema::hasColumn('documents', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('status');
            }
            if (!Schema::hasColumn('documents', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('admin_notes');
            }
            if (!Schema::hasColumn('documents', 'approved_by')) {
                $table->foreignId('approved_by')->nullable()->constrained('users')->after('approved_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn(['type', 'original_name', 'file_size', 'mime_type', 'status', 'admin_notes', 'approved_at']);
            $table->dropForeign(['approved_by']);
            $table->dropColumn('approved_by');
        });
    }
}
