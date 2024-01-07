<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Administrator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Insert data to roles table
        // ----------------------------------------------------------
        $data_permissions = [];
        $data_roles = [
            // admin management
            'manage admin',
            'admin groups',
            'admin registration',
            'admin right management',
            // ib management
            'ib management',
            'ib setup',
            'ib commission structure',
            'ib tree',
            'master ib',
            'panding commission list',
            'no commission list',
            'bank account list',
            'ib-chain',
            'ib admin',
            'ib verification request',
            'ib analysis',


            'request management',
            'group settings',
            'dashboard',
            'category management',
            //Manage Client
            'manage client',
            'trader admin',
            //Manager Settings
            'manager settings',
            'manager groups',
            'add manager',
            'manager list',
            'manager right',
            'manager analysis',
            //Finance management
            'finance',
            'balance management',
            'credit management',
            'fund management',
            'finance report',
            //category manager
            'category manager',
            //Kyc Management
            'kyc management',
            'kyc upload',
            'kyc reports',
            'kyc request',
            // Request Management
            'manage request',
            'deposit request',
            'withdraw request',
            'balance transfer',
            'ib transfer',
            'ib withdraw request',
            //Fund Transfer
            'fund transfer',
            'internal fund transfer',
            'external fund transfer',
            //Reports
            'reports',
            'ib withdraw',
            'trader withdraw',
            'deposit request report',
            'activity log',
            'trader deposit report',
            'bonus report',
            'ib fund transfer',
            'balance upload report',
            //Voucher Genertate
            'offers',
            'voucher generate',
            'voucher report',
            //Group settings
            'group manager',
            'group list',
            'manage ib group',
            //settings
            'settings',
            'add crypto address',
            'announcement',
            'api configuration',
            'bank setting',
            'banner setup',
            'company setup',
            'currency pair',
            'finance settings',
            'ib setting',
            'notification setting',
            'security setting',
            'smtp setup',
            'software settings',
            'trader setting',
            //manage trade management
            'manage trade',
            'trading trade report',
            'trade commission status',
            //admin profile
            'admin profile',
            'change profile'
        ];
       

        // END: roles and permission
        // ------------------------------------------------------------------------------------------------

        // START: Create admin groups
        // -------------------------------------------------------------------------------------------------
        

        // START: create user
        // --------------------------------------------------------------------------------------------------------
        // create supper admin 
        // create system admin
        User::create([
            'name' => 'User Demo',
            'email' => 'demo_user@nft.net',
            'password' => Hash::make('A12345'),
            'email_verified_at' => date("Y-m-d h:i:s"),
            'created_at' => date("Y-m-d h:i:s", strtotime('now')),
            'type' => 0,
            'phone' => '01797948798'
        ])->id;
         
    }
}
