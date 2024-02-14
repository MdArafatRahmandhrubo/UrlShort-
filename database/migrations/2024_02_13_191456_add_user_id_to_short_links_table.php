<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToShortLinksTable extends Migration
{
    public function up()
    {
        Schema::table('short_links', function (Blueprint $table) {
            // Check if the column does not exist before adding it
            if (!Schema::hasColumn('short_links', 'user_id')) {
                $table->foreignId('user_id')->after('id')->constrained('users')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('short_links', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
