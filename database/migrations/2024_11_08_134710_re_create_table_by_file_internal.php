<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $table_name = array_values((array)$table)[0];
            DB::statement("DROP TABLE IF EXISTS `$table_name`");
        }


        Schema::create('admin', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('email', 30)->nullable();
            $table->string('password', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('admin_utamas', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('email', 30)->nullable();
            $table->string('password', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('broadcast', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->string('judul', 255)->nullable();
            $table->text('informasi');
            $table->dateTime('tgl_tampil')->nullable();
            $table->dateTime('tgl_selesai')->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('detlaporan', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->bigInteger('id_teknisi')->nullable();
            $table->bigInteger('id_laporan')->nullable();
            $table->string('kat_layanan', 30)->nullable();
            $table->string('jenis_layanan', 50)->nullable();
            $table->text('det_layanan');
            $table->string('status', 200)->nullable();
            $table->enum('acc_status', ['pending', 'approved', 'rejected'])->nullable();
            $table->string('foto', 255)->nullable();
            $table->text('det_pekerjaan');
            $table->text('ket_pekerjaan');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('kop_surat', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('nomor', 50)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('versi', 50)->nullable();
            $table->string('halaman', 50)->nullable();
            $table->integer('preview')->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->string('gambar', 255)->nullable();
            $table->text('atas_1');
            $table->text('atas_2');
            $table->text('bawah');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });


        Schema::create('laporan', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->bigInteger('id_pelapor')->nullable();
            $table->bigInteger('id_pengawas')->nullable();
            $table->bigInteger('id_teknisi')->nullable();
            $table->bigInteger('alihkan_pws')->nullable();
            $table->dateTime('tgl_masuk')->nullable();
            $table->string('no_inv_aset', 30)->nullable();
            $table->dateTime('tgl_selesai')->nullable();
            $table->dateTime('tgl_awal_pengerjaan')->nullable();
            $table->dateTime('tgl_akhir_pengerjaan')->nullable();
            $table->integer('waktu_tambahan')->nullable();
            $table->integer('waktu_tambahan_peng')->nullable();
            $table->string('lap_no_ref', 50)->nullable();
            $table->date('lap_tanggal')->nullable();
            $table->string('lap_bisnis_area', 50)->nullable();
            $table->string('lap_versi', 50)->nullable();
            $table->string('lap_halaman', 50)->nullable();
            $table->string('lap_nomor', 50)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });


        Schema::create('laporanhist', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->bigInteger('id_laporan')->nullable();
            $table->string('status_laporan', 30)->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->text('keterangan');
            $table->string('foto', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });


        Schema::create('log_aktivasis', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->bigInteger('relatable_id')->nullable();
            $table->string('relatable_type', 255)->nullable();
            $table->char('status_aktivasi')->nullable();
            $table->string('kode_aktivasi', 255)->nullable();
            $table->enum('persetujuan_pengawas', ['pending', 'approved', 'rejected'])->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });


        Schema::create('log_cetak_laporan', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->bigInteger('id_laporan')->nullable();
            $table->bigInteger('id_pengawas')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });


        Schema::create('migrations', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('migration', 255)->nullable();
            $table->integer('batch')->nullable();
        });


        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email', 255)->nullable();
            $table->string('token', 255)->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('pelapor', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->bigInteger('id_admin_tj')->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('nipp', 15)->nullable();
            $table->string('email', 30)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('jabatan', 15)->nullable();
            $table->string('divisi', 15)->nullable();
            $table->string('telepon', 15)->nullable();
            $table->string('ttd', 255)->nullable();
            $table->string('profile', 255)->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('pengawas', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('nipp', 15)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->string('email', 30)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('ttd', 255)->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->char('status_aktivasi')->nullable();
            $table->string('kode_aktivasi', 255)->nullable();
        });

        Schema::create('teknisi', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('nipp', 15)->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->string('email', 30)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('ttd', 255)->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->char('status_aktivasi')->nullable();
            $table->string('kode_aktivasi', 255)->nullable();
            $table->date('limit_trial')->nullable();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
        Schema::dropIfExists('admin_utamas');
        Schema::dropIfExists('broadcast');
        Schema::dropIfExists('detlaporan');
        Schema::dropIfExists('kop_surat');
        Schema::dropIfExists('laporan');
        Schema::dropIfExists('laporanhist');
        Schema::dropIfExists('log_aktivasis');
        Schema::dropIfExists('log_cetak_laporan');
        Schema::dropIfExists('migrations');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('pelapor');
        Schema::dropIfExists('pengawas');
        Schema::dropIfExists('teknisi');
        Schema::dropIfExists('users');
    }
};
