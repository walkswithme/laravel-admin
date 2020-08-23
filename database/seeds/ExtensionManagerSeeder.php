<?php

use ExtensionsValley\Dashboard\Models\User;
use Illuminate\Database\Seeder;

class ExtensionManagerSeeder extends Seeder
{

    public function run()
    {


           $data = [
                        'name' => 'Dashboard'
                        ,'vendor' => 'WalksWithMe'
                        ,'description' => 'Core Package'
                        ,'version' => '2.0.0'
                        ,'is_paid' => '1'
                        ,'status' => 1
                        ,'package_type' =>'wwmladmin-package'
                        ,'icon' =>'packages/extensionsvalley/dashboard/package_icons/icon.png'
                        ,'update_url' => 'https://github.com/LaFlux/Laflux'
                        ,'author' => 'Jobin <support@walkswithme.net>'
                        ,'website' => 'http://www.walkswithme.net/contact-me'
                        ,'contact_email' => 'support@walkswithme.net'
                        ,'created_at' => date('Y-m-d h:i:s')
                        ,'updated_at' => date('Y-m-d h:i:s')

                    ];

        \DB::table('extension_manager')
            ->insert($data);


    }
}
