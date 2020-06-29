<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable()->unique();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        \DB::statement('ALTER TABLE users AUTO_INCREMENT = 1001;');

        Schema::create('user_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->text('log');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('user_password_resets', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->string('token');
            $table->unsignedInteger('expired_in')->nullable();

            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('user_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('address')->unique();
            $table->timestamp('verified_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('user_phones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('number')->unique();
            $table->boolean('whatsapp')->default(0);
            $table->timestamp('verified_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('user_profile', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('prefix')->nullable();
            $table->string('suffix')->nullable();
            $table->string('pob')->nullable();
            $table->date('dob')->nullable();
            $table->unsignedTinyInteger('sex')->nullable();
            $table->unsignedTinyInteger('blood')->nullable();
            $table->unsignedTinyInteger('religion')->nullable()->default(0);
            $table->boolean('is_dead')->default(0);
            $table->string('avatar')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->string('nik')->nullable();
            $table->string('employee_number')->nullable();
            $table->unsignedTinyInteger('religion_id')->nullable();
            $table->unsignedTinyInteger('child_num')->nullable();
            $table->unsignedTinyInteger('siblings_count')->nullable();
            $table->string('bio')->nullable();
            $table->string('diseases')->nullable();
            $table->unsignedSmallInteger('height')->nullable();
            $table->unsignedSmallInteger('weight')->nullable();
            $table->unsignedTinyInteger('hobby_id')->nullable();
            $table->unsignedTinyInteger('desire_id')->nullable();
            $table->timestamps();

            $table->primary('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('ref_countries')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('hobby_id')->references('id')->on('ref_hobbies')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('religion_id')->references('id')->on('ref_religions')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('desire_id')->references('id')->on('ref_desires')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('user_father', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('father_id');

            $table->primary('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('father_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('user_mother', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('mother_id');

            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('mother_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('user_foster', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('foster_id');

            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('foster_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('user_sessions', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity');

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('user_address', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->string('address')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('village')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedInteger('postal')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('ref_province_regency_districts')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('user_studies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedTinyInteger('grade_id')->nullable();
            $table->string('name')->nullable();
            $table->string('diploma_num')->nullable();
            $table->date('diploma_at')->nullable();
            $table->string('npsn')->nullable();
            $table->string('nss')->nullable();
            $table->year('from')->nullable();
            $table->year('to')->nullable();
            $table->unsignedTinyInteger('accreditation')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('ref_grades')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('ref_province_regency_districts')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('user_achievements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->unsignedTinyInteger('territory_id')->nullable();
            $table->unsignedTinyInteger('type_id')->nullable();
            $table->unsignedTinyInteger('num_id')->nullable();
            $table->year('year')->nullable();
            $table->string('file')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('territory_id')->references('id')->on('ref_territories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('ref_achievement_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('num_id')->references('id')->on('ref_achievement_nums')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('user_appreciations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->unsignedTinyInteger('territory_id')->nullable();
            $table->year('year')->nullable();
            $table->string('file')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('territory_id')->references('id')->on('ref_territories')->onUpdate('cascade')->onDelete('cascade');
        }); 

        Schema::create('user_organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->unsignedTinyInteger('type_id')->nullable();
            $table->unsignedTinyInteger('position_id')->nullable();
            $table->float('duration')->nullable();
            $table->year('year')->nullable();
            $table->string('file')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('ref_organization_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('ref_organization_positions')->onUpdate('cascade')->onDelete('cascade');
        });        

        Schema::create('user_disabilities', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedTinyInteger('disability_id');

            $table->primary(['user_id', 'disability_id']);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('disability_id')->references('id')->on('ref_disabilities')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_disabilities');
        Schema::dropIfExists('user_organizations');
        Schema::dropIfExists('user_appreciations');
        Schema::dropIfExists('user_achievements');
        Schema::dropIfExists('user_studies');
        Schema::dropIfExists('user_address');
        Schema::dropIfExists('user_sessions');
        Schema::dropIfExists('user_foster');
        Schema::dropIfExists('user_mother');
        Schema::dropIfExists('user_father');
        Schema::dropIfExists('user_profile');
        Schema::dropIfExists('user_phones');
        Schema::dropIfExists('user_emails');
        Schema::dropIfExists('user_password_resets');
        Schema::dropIfExists('users');
    }
}
