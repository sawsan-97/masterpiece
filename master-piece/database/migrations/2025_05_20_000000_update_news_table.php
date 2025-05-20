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
        Schema::table('news', function (Blueprint $table) {
            // إضافة الأعمدة إذا لم تكن موجودة
            if (!Schema::hasColumn('news', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('is_active');
            }
            if (!Schema::hasColumn('news', 'meta_description')) {
                $table->string('meta_description')->nullable()->after('content');
            }
            if (!Schema::hasColumn('news', 'meta_keywords')) {
                $table->string('meta_keywords')->nullable()->after('meta_description');
            }
            if (!Schema::hasColumn('news', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('is_active');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['published_at', 'meta_description', 'meta_keywords']);
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
