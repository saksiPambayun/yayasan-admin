<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['superadmin', 'admin'])->default('admin');
            $table->string('phone', 20)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Tabel Santri
        Schema::create('santri_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nisn', 50)->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('no_wali', 20)->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });

        // 3. Tabel Employees
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 50)->unique()->nullable();
            $table->string('nama');
            $table->string('jabatan', 100)->nullable();
            $table->string('divisi', 100)->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_npwp')->nullable();
            $table->enum('status', ['aktif', 'cuti', 'nonaktif'])->default('aktif');
            $table->date('tanggal_bergabung')->nullable();
            $table->timestamps();
        });

        // 4. Tabel SK Data
        Schema::create('sk_data', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_sk', 100);
            $table->string('tentang')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->string('file_sk')->nullable();
            $table->timestamps();
        });

        // 5. Tabel Akta Yayasan
        Schema::create('akta_yayasan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_akta', 100)->nullable();
            $table->date('tanggal_akta')->nullable();
            $table->string('notaris')->nullable();
            $table->string('file_akta')->nullable();
            $table->timestamps();
        });

        // 6. Tabel Akta Wakaf
        Schema::create('akta_wakaf', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_sertifikat', 100)->nullable();
            $table->string('nazhir')->nullable();
            $table->string('lokasi_tanah')->nullable();
            $table->string('luas_tanah', 50)->nullable();
            $table->string('file_sertifikat')->nullable();
            $table->timestamps();
        });

        // 7. Tabel Sessions (PENTING SUPAYA GAK ERROR LAGI)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // INSERT DATA DUMMY
        DB::table('users')->insert([
            'name' => 'Admin Yayasan',
            'email' => 'admin@yayasan.com',
            'password' => Hash::make('password123'),
            'role' => 'superadmin',
            'phone' => '08123456789',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('santri_registrations')->insert([
            ['nama_lengkap' => 'Ahmad Fulan', 'nisn' => '1234567890', 'status' => 'pending', 'created_at' => now()],
            ['nama_lengkap' => 'Budi Santoso', 'nisn' => '1234567891', 'status' => 'diterima', 'created_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('akta_wakaf');
        Schema::dropIfExists('akta_yayasan');
        Schema::dropIfExists('sk_data');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('santri_registrations');
        Schema::dropIfExists('users');
    }
};
