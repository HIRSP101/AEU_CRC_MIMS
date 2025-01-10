<?php

namespace App\Services\Members;

use App\Models\branch;
use App\Models\branch_hei;
use App\Models\member_personal_detail;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;

class CreateMemberService
{

    public function createMember(array $data, ?UploadedFile $image, int $currentMemberId): member_personal_detail
    {
        //  dd($data);

        $imagePath = $this->handleImageUpload($data, $image, $currentMemberId);
        // dd($imagePath);
        $member = member_personal_detail::create([
            "name_kh" => $data['name_kh'] ?? null,
            "name_en" => $data['name_en'] ?? null,
            "gender" => $data['gender'] ?? null,
            "image" => $imagePath ?? null,
            "nationality" => $data['nationality'] ?? "ខ្មែរ",
            "date_of_birth" => isset($data['date_of_birth']) ? $this->convertDate($data['date_of_birth']) : null,
            "full_current_address" => $data['full_current_address'] ?? null,
            "phone_number" => $data['phone_number'] ?? null,
            "email" => $data['email'],
            "facebook" => $data['facebook'] ?? null,
            "shirt_size" => $data['shirt_size'] ?? null,
            "branch_id" => $data['branch_id'] ?? null,
            "member_type" => $data["type"] ?? null,
        ]);
        //  dd($data);
        $this->createRelatedData($member, $data);

        return $member;
    }

    private function createRelatedData(member_personal_detail $member, array $data): void
    {
        $branch = branch::all()->pluck("branch_id", "branch_kh");
        $branchhei = branch_hei::all()->pluck("bhei_id", "institute_kh");
        $this->createRegistrationDetails($member, $data);
        $this->createCurrentAddress($member, $data);
        $this->createPobAddress($member, $data);
        $this->createEducationBackground($member, $data, $branch, $branchhei);
        $this->createGuardianDetail($member, $data);
    }

    private function createRegistrationDetails(member_personal_detail $member, array $data): void
    {
        $member->member_registration_detail()->create([
            'registration_date' => isset($data['registration_date']) ? $this->convertDate($data['registration_date']) : null,
            'expiration_date' => isset($data['expiration_date']) ? $this->convertDate($data['expiration_date']) : null,
        ]);
    }


    private function calculateExpirationDate()
    {

    }
    private function createCurrentAddress(member_personal_detail $member, array $data): void
    {
        $member->member_current_address()->create([
            'home_no' => $data['home_no'] ?? null,
            'street_no' => $data['street_no'] ?? null,
            'village' => $data['village'] ?? null,
            'commune_sangkat' => $data['commune_sangkat'] ?? null,
            'provience_city' => $data['provience_city'] ?? null,
            'district_khan' => $data['district_khan'] ?? null,
            'zipcode' => null,
        ]);
    }

    private function createPobAddress(member_personal_detail $member, array $data): void
    {
        $member->member_pob_address()->create([
            'home_no' => $data['pob_home_no'] ?? null,
            'street_no' => $data['pob_street_no'] ?? null,
            'village' => $data['pob_village'] ?? null,
            'commune_sangkat' => $data['pob_commune_sangkat'] ?? null,
            'provience_city' => $data['pob_provience_city'] ?? null,
            'district_khan' => $data['pob_district_khan'] ?? null,
            'zipcode' => null,
        ]);
    }

    private function createEducationBackground(member_personal_detail $member, array $data, $branch, $branchhei): void
    {
        $member->member_education_background()->create([
            'institute_id' => $data['institute_id'] ?? null,
            'acadmedic_year' => $data['acadmedic_year'] ?? null,
            'major' => $data['major'] ?? null,
            'batch' => $data['batch'] ?? null,
            'shift' => $data['shift'] ?? null,
            'language' => $data['language'] ?? null,
            'computer_skill' => $data['computer_skill'] ?? null,
            'misc_skill' => $data['misc_skill'] ?? null,
            'branch_id' => $branch[$data["provience_city"] ?? null] ?? null,
            'branchhei_id' => $data["branchhei_id"] ?? null,
            'training_received' => $data["training_received"] ?? null
        ]);
    }

    private function createGuardianDetail(member_personal_detail $member, array $data): void
    {
        $member->member_guardian_detail()->create([
            'father_name' => $data['father_name'] ?? null,
            'father_dob' => $data['father_dob'] ?? null,
            'father_occupation' => $data['father_occupation'] ?? null,
            'father_current_address' => $data['father_current_address'] ?? null,
            'mother_name' => $data['mother_name'] ?? null,
            'mother_dob' => $data['mother_dob'] ?? null,
            'mother_occupation' => $data['mother_occupation'] ?? null,
            'mother_current_address' => $data['mother_current_address'] ?? null,
            'guardian_phone' => $data['guardian_phone'] ?? null
        ]);
    }

    private function handleImageUpload(?array $data, ?UploadedFile $image, int $currentMemberId): ?string
    {
        if (!$image || !isset($data['name_en'])) {
            return null;
        }

        $imageName = 'mem-' . str_replace(' ', '', $data["name_en"] . ($currentMemberId + 1)) . '.' . $image->extension();
        $image->move(public_path('images/members'), $imageName);

        return "images/members/$imageName";
    }
    private function convertDate($date)
    {
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }

}
