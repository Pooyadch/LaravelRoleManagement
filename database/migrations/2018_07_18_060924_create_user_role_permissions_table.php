<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_role_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_name');
            $table->string('controller_address')->nullable();
            $table->string('method_name')->nullable();
            $table->enum('permission_type',['admin','branch','own','guest']);
            $table->enum('access',['Deny','Allow']);
            $table->unsignedInteger('priority');
            $table->string('filter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_role_permissions');
    }
}
