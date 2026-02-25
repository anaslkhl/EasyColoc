<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::table('memberships', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('colocation_id')->constrained('colocations')->onDelete('cascade');
            $table->enum('role', ['owner', 'member'])->default('member');
            $table->enum('status', ['active', 'left', 'removed'])->default('active');
            $table->timestamp('joined_at')->useCurrent();
            $table->timestamp('left_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
