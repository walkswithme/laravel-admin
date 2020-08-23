<?php

use ExtensionsValley\Dashboard\Models\User;
use Illuminate\Database\Seeder;

class ACLSeeder extends Seeder
{

    public function run()
    {

       $data_list = array(


array('id' =>1,'group_id' => 1,'menu_text' => 'User Panel','link'=> '','icon'=> '<i class="fa fa-user"></i>','acl_key'=> 'extensionsvalley.dashboard.userpanel','parent_menu'=> 0,'ordering'=> 1,'adding'=> 0,'edit'=> 0,'view' => 1,'trash'=> 0, 'created_at'=> '2016-12-01 22:11:31', 'updated_at'=> NULL),
array('id' =>2,'group_id' => 1,'menu_text' => 'Manage Users', 'link'=>'/admin/ExtensionsValley/dashboard/list/users','icon'=> '','acl_key'=> 'extensionsvalley.dashboard.users','parent_menu'=> 5,'ordering'=> 2,'adding'=> 1,'edit'=> 1,'view' => 1, 'trash'=>1, 'created_at'=> '2016-12-01 22:11:31', 'updated_at'=> NULL),
array('id' =>3,'group_id' => 1,'menu_text' => 'User Groups','link'=> '/admin/ExtensionsValley/dashboard/list/groups', 'icon'=>'','acl_key'=> 'extensionsvalley.dashboard.groups','parent_menu'=> 5,'ordering'=> 1,'adding'=> 1,'edit'=> 1,'view' => 1,'trash'=> 1, 'created_at'=> '2016-12-01 22:11:31', 'updated_at'=> NULL)

);


        \DB::table('acl_permission')
            ->insert($data_list);


    }
}
