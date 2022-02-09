<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Facility;
use App\Models\FacilityCredential;
use Illuminate\Support\Str;

class DummyFacilitySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$faker = Faker::create();
//
        //foreach (range(1, 50) as $index) {
        //    $facilityData = [
        //        'facility_app_id' => Str::uuid(),
        //        'facility_name' => $faker->company,
        //        'facility_owner_name' => $faker->company
        //    ];
        //    $facility = Facility::create($facilityData);
        //    $facilityCredentialData = [
        //        'facility_id' => $facility->facility_id,
        //        'ehr_client_id' => null,
        //        'ehr_metadata_endpoint' => null,
        //        'ehr_authorize_endpoint' => null,
        //        'ehr_token_endpoint' => null,
        //        'ehr_fhir_endpoint' => null,
        //        'deleted_at' => null,
        //        'created_at' => null,
        //        'updated_at' => null,
        //    ];
        //    FacilityCredential::create($facilityCredentialData);
        //}
    }
}
