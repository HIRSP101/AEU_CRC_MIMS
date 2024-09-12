<?php

namespace App\Http\Controllers;

use App\Models\member_guardian_detail;
use App\Models\member_personal_detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

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
        //dd($datas);
        DB::transaction(function () use ($datas, $currentDate) {
            foreach ($datas as $data) {
                $member_data = member_personal_detail::create([
                    "name_kh" => $data['name_kh'] ?? null,
                    "name_en" => $data['name_en'] ?? null,
                    "gender" => $data['gender'] ?? null,
                    "nationality" => $data['nationality'] ?? 'ខ្មែរ',
                    "date_of_birth" => isset($data['date_of_birth']) ? $this->convertDate($data['date_of_birth']) : null,
                    "full_current_address" => $data['full_current_address'] ?? null,
                    "phone_number" => $data['phone_number'] ?? null,
                    "national_id" => $data['national_id'] ?? null,
                    "shirt_size" => $data['shirt_size'] ?? null,
                ]);

                $this->createRegistrationDetails($member_data, $currentDate, $data);
                $this->createCurrentAddress($member_data, $data);
                $this->createPobAddress($member_data, $data);
                $this->createEducationBackground($member_data, $data);
            }
        });

        return response()->json(['message' => 'Attendance record created successfully!']);
    }

    public function eloquent_relation_delete(Request $request) {
        $member_id = $request->input("member_id");
       // dd($member_id);
        $memberPersonalDetail = member_personal_detail::findall();

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

    public function deleteall_elo() {
         member_personal_detail::query()->delete();

         return response()->json([
             'message' => 'All Member Personal Details and related data deleted successfully!'
         ], 200);
    }

    private function convertDate($date)
    {
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }

    private function createPobAddress($member_data, $data) {

    }

    private function createRegistrationDetails($member_data, $currentDate, $data)
    {
        $member_data->member_registration_detail()->create([
            'registration_date' => $currentDate,
            'expiration_date' => isset($data['expiration_date']) ? $this->convertDate($data['expiration_date']) : null,
        ]);
    }

    private function createCurrentAddress($member_data, $data)
    {
        $member_data->member_current_address()->create([
            'village' => null,
            'commune' => null,
            'sangkat' => $data['sangkat'] ?? null,
            'provience' => null,
            'city' => $data['city'] ?? null,
            'khan' => $data['khan'] ?? null,
            'zipcode' => null,
        ]);
    }

    private function createEducationBackground($member_data, $data)
    {
        $member_data->member_education_background()->create([
            'institute_id' => $data['institute_id'] ?? null,
            'acadmedic_year' => (int) $data['acadmedic_year'] ?? null,
            'major' => $data['major'] ?? null,
        ]);
    }
}
