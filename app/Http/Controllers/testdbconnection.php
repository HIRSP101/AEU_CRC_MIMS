<?php

namespace App\Http\Controllers;

use App\Models\member_guardian_detail;
use App\Models\member_personal_detail;
use App\Models\branch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class testdbconnection extends Controller
{
    public function testConnection()
    {
        try {
            DB::connection()->getPdo();
            return "Connection successful!";
        } catch (\Exception $e) {
            return "Could not connect: " . $e->getMessage();
        }
    }
    public function initialModelsSetup()
    {
        $tableNames = DB::connection('mysql')->select('show tables;');
        $columnName = DB::connection('mysql')->select('show columns from member_personal_detail');
        dd($columnName);
        /*
        foreach($tableNames as $tableName) {
            Artisan::call("make:model", ['name' => $tableName->Tables_in_railway]);
        }
        */
        echo "artisan:make model successfully!!!!!";
    }
    public function getMemberColumns()
    {
        $columnNames = DB::connection('mysql')
            ->select("select column_name from information_schema.columns where table_schema = DATABASE() and table_name in ('member_personal_detail', 'member_guardian_detail', 'member_registration_detail', 'member_engagement_detail', 'member_education_background') and column_name not like '%id' and column_name != 'registration_date_kh' and column_name != 'registration_date_en' and column_name != 'image'");
        // dd($columnNames);
        $fieldNames = [];
        foreach ($columnNames as $columnName) {
            //dd($columnName->Field);
            $fieldNames[$columnName->COLUMN_NAME] = $columnName->COLUMN_NAME;
            //array_push($fieldNames,$columnName->Field);
        }
        return view('dataimport.index', compact('fieldNames'));
    }

    public function insertMember(Request $request)
    {
        $datas = $request->input('member') ?? dd("FUBAR!!!");
        $currentDate = date('Y-m-d');
        $branches = branch::all()->pluck('branch_id', 'branch_kh');
       // dd($datas);

        $chunkedData = collect($datas)->chunk(5);

        foreach ($chunkedData as $chunk) {
            DB::transaction(function () use ($chunk, $currentDate, $branches) {
                foreach ($chunk as $data) {
                    $member_data = member_personal_detail::create([
                        "member_code" => $data['member_code'] ?? null,
                        "name_kh" => $data['name_kh'] ?? null,
                        "name_en" => $data['name_en'] ?? null,
                        "gender" => $data['gender'] ?? null,
                        "nationality" => $data['nationality'] ?? 'ខ្មែរ',
                        "date_of_birth" => isset($data['date_of_birth']) ? $this->convertDate($data['date_of_birth']) : null,
                        "full_current_address" => trim($data['full_current_address'] ?? null) ?? null,
                        "phone_number" => $data['phone_number'] ?? null,
                        "national_id" => $data['national_id'] ?? null,
                        "shirt_size" => $data['shirt_size'] ?? null,
                        "member_type" => $data['type'] ?? null,
                    ]);

                    $this->createRegistrationDetails($member_data, $data);
                    $this->createCurrentAddress($member_data, $data);
                    $this->createPobAddress($member_data, $data);
                    $this->createEducationBackground($member_data, $data, $branches);
                    $this->createGuardianDetail($member_data, $data);
                }
            });
        }

        return response()->json(['message' => 'Attendance records created successfully!']);
    }

    public function eloquent_relation_delete(Request $request)
    {
        $member_id = $request->input("member_id");
        // dd($member_id);
        $memberPersonalDetail = member_personal_detail::all();

        if (!$memberPersonalDetail) {
            return response()->json([
                'message' => 'Member Personal Detail not found.'
            ], 404);
        }
        $memberPersonalDetail->delete();

        return response()->json([
            'message' => 'Member Personal Detail and related data deleted successfully!'
        ], 200);
    }

    public function deleteall_elo()
    {
        member_personal_detail::query()->delete();

        return response()->json([
            'message' => 'All Member Personal Details and related data deleted successfully!'
        ], 200);
    }

    private function convertDate($date)
    {
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }

    private function createRegistrationDetails($member_data, $data)
    {
        $member_data->member_registration_detail()->create([
            'registration_date' => isset($data['registration_date']) ? $this->convertDate($data['expiration_date']) : null,
            'expiration_date' => isset($data['expiration_date']) ? $this->convertDate($data['expiration_date']) : null,
        ]);
    }
    private function createPobAddress($member_data, $data)
    {
        $member_data->member_pob_address()->create([
            'village' => $data['pob_village'] ?? null,
            'commune_sangkat' => $data['pob_commune_sangkat'] ?? null,
            'provience_city' => $data['pob_provience_city'] ?? null,
            'district_khan' => $data['pob_district_khan'] ?? null,
            'zipcode' => null,
        ]);
    }


    private function createCurrentAddress($member_data, $data)
    {
        $member_data->member_current_address()->create([
            'village' => $data['village'] ?? null,
            'commune_sangkat' => $data['commune_sangkat'] ?? null,
            'provience_city' => $data['provience_city'] ?? null,
            'district_khan' => $data['district_khan'] ?? null,
            'zipcode' => null,
        ]);
    }

    private function createEducationBackground($member_data, $data, $branches)
    {
        $member_data->member_education_background()->create([
            'institute_id' => $data['institute_id'] ?? null,
            'acadmedic_year' => $data['acadmedic_year'] ?? null,
            'major' => $data['major'] ?? null,
            'branch_id' => $branches[$data["provience_city"] ?? null] ?? null
        ]);
    }

    private function createGuardianDetail($member_data, $data)
    {
        $member_data->member_guardian_detail()->create([
            'father_name' => $data['father_name'] ?? null,
            'father_dob' => isset($data['father_dob']) ? $this->convertDate($data['father_dob']) : null,
            'father_occupation' => $data['father_occupation'] ?? null,
            'father_current_address' => $data['father_current_address'] ?? null,
            'mother_name' => $data['mother_name'] ?? null,
            'mother_dob' => isset($data['mother_dob']) ? $this->convertDate($data['mother_dob']) : null,
            'mother_occupation' => $data['mother_occupation'] ?? null,
            'mother_current_address' => $data['mother_current_address'] ?? null,
            'guardian_phone' => $data['guardian_phone'] ?? null,
        ]);
    }
}
