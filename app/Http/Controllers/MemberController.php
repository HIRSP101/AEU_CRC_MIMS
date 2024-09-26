<?php

namespace App\Http\Controllers;

use App\Models\branch;
use App\Models\institute;
use App\Models\member_personal_detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;


class MemberController extends Controller
{
    public function index()
    {
        $branches = branch::all()->pluck("branch_kh", "branch_id");
        return view('member.index', compact('branches'));
    }

    public function getMemberDetail(Request $request)
    {
        $member = member_personal_detail::with(relations: ['member_guardian_detail', 'member_registration_detail', 'member_education_background', 'member_current_address', 'member_pob_address'])->where('member_id', $request->id)->first();
        return view('member_detail.index', compact('member'));
    }
    public function insertMember(Request $request)
    {
        $request->validate([
            'members' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $datas = json_decode($request->input(key: 'members'), associative: true);
        $current_mem_id = member_personal_detail::latest()->first()->member_id;
        // dd($current_mem_id);
        //  dd($request);
        DB::transaction(function () use ($datas, $request, $current_mem_id) {
            foreach ($datas as $data) {
                $imageName = $request->hasFile('image') ? 'mem-' . str_replace(' ', '', $data["name_en"] . (string)((int)$current_mem_id + 1)) . '.' . $request->image->extension() : "";
                $request->image->move(public_path('images/members'), $imageName);
                $member_data = member_personal_detail::create([
                    "name_kh" => $data['name_kh'] ?? null,
                    "name_en" => $data['name_en'] ?? null,
                    "gender" => $data['gender'] ?? null,
                    "image" => "images/" . $imageName ?? null,
                    "nationality" => $data['nationality'] ?? 'ខ្មែរ',
                    "date_of_birth" => isset($data['date_of_birth']) ? $this->convertDate($data['date_of_birth']) : null,
                    "full_current_address" => $data['full_current_address'] ?? null,
                    "phone_number" => $data['phone_number'] ?? null,
                    "shirt_size" => $data['shirt_size'] ?? null,
                    "member_type" => $data['type'] ?? null,
                ]);

                $this->createRegistrationDetails($member_data, $data);
                $this->createCurrentAddress($member_data, $data);
                $this->createPobAddress($member_data, $data);
                $this->createEducationBackground($member_data, $data);
                $this->createGuardianDetail($member_data, $data);
            }
        });

        return response()->json(['message' => 'Member record created successfully!']);
    }
    public function eloquent_relation_delete(Request $request)
    {
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
    private function convertDate($date)
    {
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }

    private function createPobAddress($member_data, $data)
    {
        $member_data->member_pob_address()->create([
            'home_no' => $data['pob_home_no'] ?? null,
            'street_no' => $data['pob_street_no'] ?? null,
            'village' => $data['pob_village'] ?? null,
            'commune_sangkat' => $data['pob_commune_sangkat'] ?? null,
            'provience_city' => $data['pob_provience_city'] ?? null,
            'district_khan' => $data['pob_district_khan'] ?? null,
            'zipcode' => null,
        ]);
    }

    private function createGuardianDetail($member_data, $data)
    {
        $member_data->member_guardian_detail()->create([
            'father_name' => $data['father_name'] ?? null,
            'father_dob' =>  isset($data['father_dob']) ? $this->convertDate($data['father_dob']) : null,
            'father_current_address' => $data['father_current_address'] ?? null,
            'father_occupation' => $data['father_occupation'] ?? null,
            'mother_name' => $data['mother_name'] ?? null,
            'mother_dob' =>  isset($data['mother_dob']) ? $this->convertDate($data['mother_dob']) : null,
            'mother_current_address' => $data['mother_current_address'] ?? null,
            'mother_occupation' => $data['mother_occupation'] ?? null,
            'guardian_phone' => $data['guardian_phone'] ?? null
        ]);
    }

    private function createRegistrationDetails($member_data, $data)
    {
        $member_data->member_registration_detail()->create([
            'registration_date' => isset($data['registration_date']) ? $this->convertDate($data['registration_date']) : null,
            'expiration_date' => isset($data['expiration_date']) ? $this->convertDate($data['expiration_date']) : null,
        ]);
    }

    private function createCurrentAddress($member_data, $data)
    {
        $member_data->member_current_address()->create([
            'home_no' => $data['home_no'] ?? null,
            'street_no' => $data['street_no'] ?? null,
            'village' => $data['village'] ?? null,
            'commune_sangkat' => $data['commune_sangkat'] ?? null,
            'provience_city' => $data['provience_city'] ?? null,
            'district_khan' => $data['district_khan'] ?? null,
            'zipcode' => null,
        ]);
    }

    private function createEducationBackground($member_data, $data)
    {
        $member_data->member_education_background()->create([
            'institute_id' => $data['institute_id'] ?? null,
            'acadmedic_year' => /*(int)*/ $data['acadmedic_year'] ?? null,
            'major' => $data['major'] ?? null,
            'batch' => $data['batch'] ?? null,
            'shift' => $data['shift'] ?? null,
            'education_level' => $data['education_level'] ?? null,
            'language' => $data['language'] ?? null,
            'computer_skill' => $data['computer_skill'] ?? null,
            'misc_skill' => $data['misc_skill'] ?? null
        ]);
    }
    public function deleteMember(Request $request)
    {
        $data = member_personal_detail::whereIn('member_id', $request->arr);
        $data->delete();
        // dd($data);
    }
}
