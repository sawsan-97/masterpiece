<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'parent_id')) {
                $table->dropForeign(['parent_id']);
                $table->dropColumn('parent_id');
            }
            if (Schema::hasColumn('categories', 'order')) {
                $table->dropColumn('order');
            }
            if (Schema::hasColumn('categories', 'icon')) {
                $table->dropColumn('icon');
            }
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'parent_id')) {
                $table->unsignedBigInteger('parent_id')->nullable()->after('id');
                $table->foreign('parent_id')
                      ->references('id')
                      ->on('categories')
                      ->onDelete('cascade');
            }
            if (!Schema::hasColumn('categories', 'order')) {
                $table->integer('order')->default(0)->after('is_active');
            }
            if (!Schema::hasColumn('categories', 'icon')) {
                $table->string('icon')->nullable()->after('slug');
            }
        });
    }
};
