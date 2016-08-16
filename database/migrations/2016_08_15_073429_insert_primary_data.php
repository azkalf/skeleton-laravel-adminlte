<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertPrimaryData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('groups')->insert([
            ['id' => 1, 'group_name' => 'Super Administrator'],
            ['id' => 2, 'group_name' => 'Administrator'],
        ]);
        
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'superadmin',
            'fullname' => 'Super Admin',
            'email' => 'superadmin@server.com',
            'sex' => 'm',
            'group_id' => 1,
            'password' => bcrypt('rahasiasuper'),
        ]);

        DB::table('menus')->insert([
            ['id'=>1, 'menu_text'=>'CONFIGURATION', 'menu_icon'=>'fa-gears', 'menu_parent'=>0, 'menu_url'=>'#', 'menu_order'=>0],
            ['id'=>2, 'menu_text'=>'Group', 'menu_icon'=>'fa-group', 'menu_parent'=>1, 'menu_url'=>'group', 'menu_order'=>1],
            ['id'=>3, 'menu_text'=>'Menu', 'menu_icon'=>'fa-bars', 'menu_parent'=>1, 'menu_url'=>'menu', 'menu_order'=>2],
            ['id'=>4, 'menu_text'=>'Company', 'menu_icon'=>'fa-building', 'menu_parent'=>1, 'menu_url'=>'companyAdmin', 'menu_order'=>3],
            ['id'=>5, 'menu_text'=>'User', 'menu_icon'=>'fa-user', 'menu_parent'=>1, 'menu_url'=>'user', 'menu_order'=>4],
        ]);

        DB::table('roles')->insert([
            ['menu_id'=>1, 'group_id'=>1],
            ['menu_id'=>2, 'group_id'=>1],
            ['menu_id'=>3, 'group_id'=>1],
            ['menu_id'=>4, 'group_id'=>1],
            ['menu_id'=>5, 'group_id'=>1],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 
    }
}
