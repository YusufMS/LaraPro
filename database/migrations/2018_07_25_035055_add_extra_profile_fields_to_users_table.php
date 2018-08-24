<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraProfileFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table){
            $table->mediumText('bio')->nullable()->after('email');
            $table->string('contactNo')->nullable()->after('bio');
            $table->date('dob')->after('contactNo')->nullable();
            $table->string('occupation')->nullable()->after('dob');
            $table->string('qualifications')->nullable()->after('occupation');
            $table->string('interests')->nullable()->after('qualifications');
            $table->boolean('sex')->nullable()->after('interests');
            $table->string('from')->nullable()->after('sex');
            $table->string('livesIn')->nullable()->after('from');
            $table->text('socialMediaLinks')->nullable()->after('livesIn');
            $table->boolean('emailVisibility')->nullable()->after('socialMediaLinks');
            $table->string('profileImage')->nullable()->after('emailVisibility');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table){
            $table->dropColumn('bio');
            $table->dropColumn('contactNo');
            $table->dropColumn('dob');
            $table->dropColumn('occupation');
            $table->dropColumn('qualifications');
            $table->dropColumn('interests');
            $table->dropColumn('sex');
            $table->dropColumn('from');
            $table->dropColumn('livesIn');
            $table->dropColumn('socialMediaLinks');
            $table->dropColumn('emailVisibility');
            $table->dropColumn('profileImage');
            // $table->dropColumn('bio');

        });
    }
}
