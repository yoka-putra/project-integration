<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToAsetTable extends Migration
{
    public function up()
    {
        Schema::table('aset', function (Blueprint $table) {
            $table->timestamps(); // Menambahkan created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::table('aset', function (Blueprint $table) {
            $table->dropTimestamps(); // Menghapus created_at dan updated_at
        });
    }

};
