<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa__mahasiswas', function (Blueprint $table) {
            $table->string("nama", 255)->nullable();
            $table->integer("nim")->nullable();
            $table->string("email", 50);
            $table->enum("jurusan", [
                "Teknik Informatika",
                "Teknik Mesin",
                "Sistem Informasi",
                "Elektronika",
                "Teknik Industri",
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa__mahasiswas', function (Blueprint $table) {
            $table->dropColumn("nama");
            $table->dropColumn("nim");
            $table->dropColumn("email");
            $table->dropColumn("jurusan");
        });
    }
}
