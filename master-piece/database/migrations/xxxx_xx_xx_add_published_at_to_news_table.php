<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            if (!Schema::hasColumn('news', 'published_at')) {
                $table->timestamp('published_at')->nullable();
            }
            if (!Schema::hasColumn('news', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            }
            if (!Schema::hasColumn('news', 'meta_description')) {
                $table->string('meta_description')->nullable();
            }
            if (!Schema::hasColumn('news', 'meta_keywords')) {
                $table->string('meta_keywords')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['published_at', 'meta_description', 'meta_keywords']);
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
