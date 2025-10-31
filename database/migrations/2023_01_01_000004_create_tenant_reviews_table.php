<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('reviewer_id'); // Landlord or Agent ID
            $table->foreign('reviewer_id')->references('id')->on('users');
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties');
            $table->integer('rating'); // 1-5 star rating
            $table->text('comment');
            $table->enum('status', ['pending_approval', 'approved', 'rejected', 'disputed'])->default('pending_approval');
            $table->boolean('public')->default(false);
            $table->unsignedBigInteger('landlord_id')->nullable(); // For agent reviews that need landlord approval
            $table->foreign('landlord_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_reviews');
    }
}
