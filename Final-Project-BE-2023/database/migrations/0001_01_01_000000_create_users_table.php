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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id of the user
            $table->string('firstName'); // first name of the user
            $table->string('lastName'); // last name of the user
            $table->string('email')->unique(); // email address of the user
            $table->unsignedBigInteger('contact'); // contact number of the user
            $table->longText('address'); // address of the user
            $table->date('birthday'); // birthday of the user
            $table->string('password'); // password of the user
            $table->string('role'); // role of the user
            $table->unsignedBigInteger('money'); // number of money of the user
            $table->timestamps(); // created_at, updated_at
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }

};
