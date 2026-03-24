<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('address')->nullable()->after('phone');
            $table->string('landmark')->nullable()->after('address');
            $table->string('pincode', 10)->nullable()->after('landmark');
            $table->string('city')->nullable()->after('pincode');
            $table->string('state')->nullable()->after('city');
            $table->string('avatar')->nullable()->after('state');
            $table->tinyInteger('is_active')->default(1)->after('avatar');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'address', 'landmark',
                'pincode', 'city', 'state',
                'avatar', 'is_active',
            ]);
        });
    }
};