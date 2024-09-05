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
        Schema::table('users', function (Blueprint $table) {
            $table->string('prefixname')->after('id')->nullable();
            $table->string('firstname')->after('prefixname');
            $table->string('middlename')->after('firstname')->nullable();
            $table->string('lastname')->after('middlename');
            $table->string('suffixname')->after('lastname')->nullable();
            $table->string('username')->after('suffixname')->unique();
            $table->string('photo')->after('email_verified_at')->nullable();
            $table->string('type')->after('photo')->nullable();

            $table->string('name')->default('')->change();
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('prefixname');
            $table->dropColumn('firstname');
            $table->dropColumn('middlename');
            $table->dropColumn('lastname');
            $table->dropColumn('suffixname');
            $table->dropColumn('username');
            $table->dropColumn('photo');
            $table->dropColumn('type');

            $table->string('name');
            $table->dropSoftDeletes();
        });
    }
};
