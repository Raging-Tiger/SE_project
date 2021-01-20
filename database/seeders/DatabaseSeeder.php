<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        /*
        \App\Models\Role::create(array('name' => 'Admin'));
        \App\Models\Role::create(array('name' => 'User'));
        \App\Models\Role::create(array('name' => 'Inhabitant'));
        \App\Models\Role::create(array('name' => 'Privileged user'));
        \App\Models\Role::create(array('name' => 'Blocked'));
        
        
   
        \App\Models\User::create(array('name' => 'Administrator',
                           'email' => 'admin@ehouse.se', 
                           'password' => bcrypt('secret'),
                           'email_notifications' => True,
                           'role_id' => 1));
        
        
        \App\Models\NotificationType::create(array('name' => 'Public', 'description' => 'Any visitor will see the announcement'));
        \App\Models\NotificationType::create(array('name' => 'House', 'description' => 'Only Inhabitant, Privileged user and Admin will see the announcement'));
        
         
        
        \App\Models\Language::create(array('name' => 'English', 'language_code' => 'en'));
        \App\Models\Language::create(array('name' => 'Russian', 'language_code' => 'ru'));
        
        
        \App\Models\FineStatus::create(array('name' => 'Issued', 'description' => 'Fine with sum that is issued'));
        \App\Models\FineStatus::create(array('name' => 'Paid', 'description' => 'Fine, that was paid by inhabitant'));
        \App\Models\FineStatus::create(array('name' => 'Warning', 'description' => 'Fine without the sum to be paid'));
        \App\Models\FineStatus::create(array('name' => 'Cancelled', 'description' => 'Fine that is cancelled due to some reason, but not deleted'));
        
        
        \App\Models\FineReason::create(array('name' => 'Broken property', 'description' => 'Broken property in house'));
        \App\Models\FineReason::create(array('name' => 'Unconfirmed renovation', 'description' => 'Renovation without notifying managing company'));
        \App\Models\FineReason::create(array('name' => 'Dangerous items', 'description' => 'Storing potentially dangerous items'));
        \App\Models\FineReason::create(array('name' => 'Unappropriate behavior', 'description' => 'Any kind of loud/drunk/etc. behavior'));
        \App\Models\FineReason::create(array('name' => 'Being in restricted zones', 'description' => 'Walking over lawn, etc.'));
        \App\Models\FineReason::create(array('name' => 'Smoking', 'description' => 'Smoking nearer 10m to the house'));
        
        
        \App\Models\BillStatus::create(array('name' => 'Sent', 'description' => 'Bill is sent to the inhabitant, yet no payment confirmation is received'));
        \App\Models\BillStatus::create(array('name' => 'Paid', 'description' => 'Bill is paid and no more actions are needed'));
        \App\Models\BillStatus::create(array('name' => 'Underpaid', 'description' => 'Bill is partially paid'));
        \App\Models\BillStatus::create(array('name' => 'Waiting for confirmation', 'description' => 'Payment confirmation has been uploaded, but no decision made yet'));
        \App\Models\BillStatus::create(array('name' => 'Overdue', 'description' => 'Bill is not paid in the time'));
       
        
        \App\Models\MeterType::create(array('name' => 'Cold water'));
        \App\Models\MeterType::create(array('name' => 'Hot water'));
        \App\Models\MeterType::create(array('name' => 'Heating'));
        
        
        \App\Models\Apartment::create(array('number' => 1,'area_m2' => 32.20,'floor' => 1));
        \App\Models\Apartment::create(array('number' => 24,'area_m2' => 56.45,'floor' => 2));
        \App\Models\Apartment::create(array('number' => 52,'area_m2' => 66.51,'floor' => 3));
        \App\Models\Apartment::create(array('number' => 58,'area_m2' => 82.88,'floor' => 4));
        \App\Models\Apartment::create(array('number' => 82,'area_m2' => 106.22,'floor' => 5));
        
        \App\Models\Meter::create(array('amount' => 555.26,'verified_till' => '2021/12/17', 'meter_type_id' => 1, 'apartment_id' => 1));
        \App\Models\Meter::create(array('amount' => 315.44,'verified_till' => '2021/12/17', 'meter_type_id' => 2, 'apartment_id' => 1));
        \App\Models\Meter::create(array('amount' => 22659.65,'verified_till' => '2020/12/15', 'meter_type_id' => 3, 'apartment_id' => 1));
        
        
        
        
        \App\Models\Meter::create(array('amount' => 555.26,'verified_till' => '2021/12/17', 'meter_type_id' => 1, 'apartment_id' => 2));
        \App\Models\Meter::create(array('amount' => 315.44,'verified_till' => '2021/12/17', 'meter_type_id' => 2, 'apartment_id' => 2));
        \App\Models\Meter::create(array('amount' => 22659.65,'verified_till' => '2020/12/15', 'meter_type_id' => 3, 'apartment_id' => 2));
        
        \App\Models\Meter::create(array('amount' => 0.00,'verified_till' => '2021/12/17', 'meter_type_id' => 1, 'apartment_id' => 3));
        \App\Models\Meter::create(array('amount' => 0.00,'verified_till' => '2021/12/17', 'meter_type_id' => 2, 'apartment_id' => 3));
        \App\Models\Meter::create(array('amount' => 0.00,'verified_till' => '2020/12/15', 'meter_type_id' => 3, 'apartment_id' => 3));
        
        
        \App\Models\Meter::create(array('amount' => 115.59,'verified_till' => '2021/12/17', 'meter_type_id' => 1, 'apartment_id' => 4));
        \App\Models\Meter::create(array('amount' => 105.99,'verified_till' => '2021/12/17', 'meter_type_id' => 2, 'apartment_id' => 4));
        \App\Models\Meter::create(array('amount' => 659.65,'verified_till' => '2020/12/15', 'meter_type_id' => 3, 'apartment_id' => 4));
        
        \App\Models\Meter::create(array('amount' => 555.26,'verified_till' => '2021/12/17', 'meter_type_id' => 1, 'apartment_id' => 5));
        \App\Models\Meter::create(array('amount' => 315.44,'verified_till' => '2021/12/17', 'meter_type_id' => 2, 'apartment_id' => 5));
        \App\Models\Meter::create(array('amount' => 22659.65,'verified_till' => '2020/12/15', 'meter_type_id' => 3, 'apartment_id' => 5));
        \App\Models\Meter::create(array('amount' => 555.26,'verified_till' => '2021/12/17', 'meter_type_id' => 1, 'apartment_id' => 5));
        \App\Models\Meter::create(array('amount' => 315.44,'verified_till' => '2021/12/17', 'meter_type_id' => 2, 'apartment_id' => 5));
        \App\Models\Meter::create(array('amount' => 22659.65,'verified_till' => '2020/12/15', 'meter_type_id' => 3, 'apartment_id' => 5));
         
         */
       \App\Models\Meter::create(array('amount' => 562.26,'verified_till' => '2021/12/17', 'meter_type_id' => 1, 'apartment_id' => 1));
        \App\Models\Meter::create(array('amount' => 320.44,'verified_till' => '2021/12/17', 'meter_type_id' => 2, 'apartment_id' => 1));
        \App\Models\Meter::create(array('amount' => 22759.65,'verified_till' => '2020/12/15', 'meter_type_id' => 3, 'apartment_id' => 1));
        
        
        
        
        \App\Models\Meter::create(array('amount' => 580.26,'verified_till' => '2021/12/17', 'meter_type_id' => 1, 'apartment_id' => 2));
        \App\Models\Meter::create(array('amount' => 345.44,'verified_till' => '2021/12/17', 'meter_type_id' => 2, 'apartment_id' => 2));
        \App\Models\Meter::create(array('amount' => 22659.65,'verified_till' => '2020/12/15', 'meter_type_id' => 3, 'apartment_id' => 2));
        
        \App\Models\Meter::create(array('amount' => 0.00,'verified_till' => '2021/12/17', 'meter_type_id' => 1, 'apartment_id' => 3));
        \App\Models\Meter::create(array('amount' => 0.00,'verified_till' => '2021/12/17', 'meter_type_id' => 2, 'apartment_id' => 3));
        \App\Models\Meter::create(array('amount' => 0.00,'verified_till' => '2020/12/15', 'meter_type_id' => 3, 'apartment_id' => 3));
        
        
        \App\Models\Meter::create(array('amount' => 116.59,'verified_till' => '2021/12/17', 'meter_type_id' => 1, 'apartment_id' => 4));
        \App\Models\Meter::create(array('amount' => 107.99,'verified_till' => '2021/12/17', 'meter_type_id' => 2, 'apartment_id' => 4));
        \App\Models\Meter::create(array('amount' => 699.65,'verified_till' => '2020/12/15', 'meter_type_id' => 3, 'apartment_id' => 4));
        
        \App\Models\Meter::create(array('amount' => 655.26,'verified_till' => '2021/12/17', 'meter_type_id' => 1, 'apartment_id' => 5));
        \App\Models\Meter::create(array('amount' => 415.44,'verified_till' => '2021/12/17', 'meter_type_id' => 2, 'apartment_id' => 5));
        \App\Models\Meter::create(array('amount' => 23659.65,'verified_till' => '2020/12/15', 'meter_type_id' => 3, 'apartment_id' => 5));

        
        
    }
}
