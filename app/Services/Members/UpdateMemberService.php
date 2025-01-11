<?php

namespace App\Services\Members;

use App\Models\member_personal_detail;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;


class UpdateMemberService
{
    public function updateMember(int $memberId, array $data, ?UploadedFile $image): member_personal_detail
    {
        $member = member_personal_detail::findOrFail($memberId);

        // Handle image upload if a new image is provided
        $imagePath = $this->handleImageUpload($data, $image, $memberId) ?? $member->image;
        // Update member personal details
        $member->update([
            "name_kh" => $data[0]['name_kh'] ?? $member->name_kh,
            "name_en" => $data[0]['name_en'] ?? $member->name_en,
            "gender" => $data[0]['gender'] ?? $member->gender,
            "image" => $imagePath,
            "nationality" => $data[0]['nationality'] ?? $member->nationality,
            "date_of_birth" => isset($data[0]['date_of_birth']) ? $this->convertDate($data[0]['date_of_birth']) : $member->date_of_birth,
            "full_current_address" => $data[0]['full_current_address'] ?? $member->full_current_address,
            "phone_number" => $data[0]['phone_number'] ?? $member->phone_number,
            "email" => $data[0]['email'] ?? $member->email,
            "facebook" => $data[0]['facebook'] ?? $member->facebook,
            "shirt_size" => $data[0]['shirt_size'] ?? $member->shirt_size,
            "branch_id" => $data[0]['branch_id'] ?? $member->branch_id,
            "member_type" => $data[0]['member_type'] ?? $member->member_type,
        ]);
        // Cascade update related data
        $this->updateRelatedData($member, $data);

        return $member;
    }

    /**
     * Update all related data for a member
     */
    private function updateRelatedData(member_personal_detail $member, array $data): void
    {
        $this->updateRegistrationDetails($member, $data);
        $this->updateCurrentAddress($member, $data);
        $this->updatePobAddress($member, $data);
        $this->updateEducationBackground($member, $data);
        $this->updateGuardianDetail($member, $data);
    }

    /**
     * Update registration details for a member
     */
    private function updateRegistrationDetails(member_personal_detail $member, array $data): void
    {
        $member->member_registration_detail()->update([
            'registration_date' => isset($data[0]['registration_date']) ? $this->convertDate($data[0]['registration_date']) : $member->member_registration_detail->registration_date,
            'expiration_date' => $data[0]['expiration_date'] ?? $member->member_registration_detail->expiration_date,
        ]);
    }

    // Similarly, add update methods for each related entity:
    private function updateCurrentAddress(member_personal_detail $member, array $data): void
    {
        $member->member_current_address()->update([
            'home_no' => $data[0]['home_no'] ?? $member->member_current_address->home_no,
            'street_no' => $data[0]['street_no'] ?? $member->member_current_address->street_no,
            'village' => $data[0]['village'] ?? $member->member_current_address->village,
            'commune_sangkat' => $data[0]['commune_sangkat'] ?? $member->member_current_address->commune_sangkat,
            'provience_city' => $data[0]['provience_city'] ?? $member->member_current_address->provience_city,
            'district_khan' => $data[0]['district_khan'] ?? $member->member_current_address->district_khan,
            'zipcode' => null,
        ]);
    }

    private function updatePobAddress(member_personal_detail $member, array $data): void
    {
        $member->member_pob_address()->update([
            'home_no' => $data[0]['pob_home_no'] ?? $member->member_pob_address->home_no,
            'street_no' => $data[0]['pob_street_no'] ?? $member->member_pob_address->street_no,
            'village' => $data[0]['pob_village'] ?? $member->member_pob_address->village,
            'commune_sangkat' => $data[0]['pob_commune_sangkat'] ?? $member->member_pob_address->commune_sangkat,
            'provience_city' => $data[0]['pob_provience_city'] ?? $member->member_pob_address->provience_city,
            'district_khan' => $data[0]['pob_district_khan'] ?? $member->member_pob_address->district_khan,
            'zipcode' => null,
        ]);
    }

    private function updateEducationBackground(member_personal_detail $member, array $data): void
    {
        $member->member_education_background()->update([
            'institute_id' => $data[0]['institute_id'] ?? $member->member_education_background->institute_id,
            'acadmedic_year' => $data[0]['acadmedic_year'] ?? $member->member_education_background->acadmedic_year,
            'major' => $data[0]['major'] ?? $member->member_education_background->major,
            'batch' => $data[0]['batch'] ?? $member->member_education_background->batch,
            'shift' => $data[0]['shift'] ?? $member->member_education_background->shift,
            'language' => $data[0]['language'] ?? $member->member_education_background->language,
            'computer_skill' => $data[0]['computer_skill'] ?? $member->member_education_background->computer_skill,
            'misc_skill' => $data[0]['misc_skill'] ?? $member->member_education_background->misc_skill,
            'training_received' => $data[0]['training_received'] ?? $member->member_education_background->training_received,
        ]);
    }

    private function updateGuardianDetail(member_personal_detail $member, array $data): void
    {
        $member->member_guardian_detail()->update([
            'father_name' => $data[0]['father_name'] ?? $member->member_guardian_detail->father_name,
            'father_dob' => $data[0]['father_dob'] ?? $member->member_guardian_detail->father_dob,
            'father_occupation' => $data[0]['father_occupation'] ?? $member->member_guardian_detail->father_occupation,
            'father_current_address' => $data[0]['father_current_address'] ?? $member->member_guardian_detail->father_current_address,
            'mother_name' => $data[0]['mother_name'] ?? $member->member_guardian_detail->mother_name,
            'mother_dob' => $data[0]['mother_dob'] ?? $member->member_guardian_detail->mother_dob,
            'mother_occupation' => $data[0]['mother_occupation'] ?? $member->member_guardian_detail->mother_occupation,
            'mother_current_address' => $data[0]['mother_current_address'] ?? $member->member_guardian_detail->mother_current_address,
            'guardian_phone' => $data[0]['guardian_phone'] ?? $member->member_guardian_detail->guardian_phone,
        ]);
    }
    private function handleImageUpload(?array $data, ?UploadedFile $image, int $currentMemberId): ?string
    {
        if (!$image || !isset($data[0]['name_en'])) {
            return null;
        }

        $imageName = 'mem-' . str_replace(' ', '', $data[0]["name_en"] . ($currentMemberId + 1)) . '.' . $image->extension();
        $image->move(public_path('images/members'), $imageName);

        return "images/members/$imageName";
    }
    private function convertDate($date)
    {
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }
}
