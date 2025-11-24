<?php

use Illuminate\Database\Schema\Blueprint;

return [
    'up' => function ($capsule) {
        $capsule->schema()->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    },
    'down' => function ($capsule) {
        $capsule->schema()->dropIfExists('users');
    }
];