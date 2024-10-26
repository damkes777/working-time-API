<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('working_times', function (Blueprint $table) {
            $table->id();
            $table->string('employee_uuid', 36);
            $table->foreign('employee_uuid')
                  ->references('uuid')
                  ->on('employees')
                  ->cascadeOnDelete();
            $table->dateTime('work_start');
            $table->dateTime('work_end');
            $table->date('work_day_start');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('working_times');
    }
};
