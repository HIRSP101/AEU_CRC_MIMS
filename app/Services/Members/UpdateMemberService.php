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
            "name_kh" => $data['name_kh'] ?? $member->name_kh,
            "name_en" => $data['name_en'] ?? $member->name_en,
            "gender" => $data['gender'] ?? $member->gender,
            "image" => $imagePath,
            "nationality" => $data['nationality'] ?? $member->nationality,
            "date_of_birth" => isset($data['date_of_birth']) ? $this->convertDate($data['date_of_birth']) : $member->date_of_birth,
            "full_current_address" => $data['full_current_address'] ?? $member->full_current_address,
            "phone_number" => $data['phone_number'] ?? $member->phone_number,
            "email" => $data['email'] ?? $member->email,
            "facebook" => $data['facebook'] ?? $member->facebook,
            "shirt_size" => $data['shirt_size'] ?? $member->shirt_size,
            "branch_id" => $data['branch_id'] ?? $member->branch_id,
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
            'registration_date' => isset($data['registration_date']) ? $this->convertDate($data['registration_date']) : $member->member_registration_detail->registration_date,
            'expiration_date' => $data['expiration_date'] ?? $member->member_registration_detail->expiration_date,
        ]);
    }

    // Similarly, add update methods for each related entity:
    private function updateCurrentAddress(member_personal_detail $member, array $data): void
    {
        $member->member_current_address()->update([
            'home_no' => $data['home_no'] ?? $member->member_current_address->home_no,
            'street_no' => $data['street_no'] ?? $member->member_current_address->street_no,
            'village' => $data['village'] ?? $member->member_current_address->village,
            'commune_sangkat' => $data['commune_sangkat'] ?? $member->member_current_address->commune_sangkat,
            'provience_city' => $data['provience_city'] ?? $member->member_current_address->provience_city,
            'district_khan' => $data['district_khan'] ?? $member->member_current_address->district_khan,
            'zipcode' => null,
        ]);
    }

    private function updatePobAddress(member_personal_detail $member, array $data): void
    {
        $member->member_pob_address()->update([
            'home_no' => $data['pob_home_no'] ?? $member->member_pob_address->home_no,
            'street_no' => $data['pob_street_no'] ?? $member->member_pob_address->street_no,
            'village' => $data['pob_village'] ?? $member->member_pob_address->village,
            'commune_sangkat' => $data['pob_commune_sangkat'] ?? $member->member_pob_address->commune_sangkat,
            'provience_city' => $data['pob_provience_city'] ?? $member->member_pob_address->provience_city,
            'district_khan' => $data['pob_district_khan'] ?? $member->member_pob_address->district_khan,
            'zipcode' => null,
        ]);
    }

    private function updateEducationBackground(member_personal_detail $member, array $data): void
    {
        $member->member_education_background()->update([
            'institute_id' => $data['institute_id'] ?? $member->member_education_background->institute_id,
            'acadmedic_year' => $data['acadmedic_year'] ?? $member->member_education_background->acadmedic_year,
            'major' => $data['major'] ?? $member->member_education_background->major,
            'batch' => $data['batch'] ?? $member->member_education_background->batch,
            'shift' => $data['shift'] ?? $member->member_education_background->shift,
            'language' => $data['language'] ?? $member->member_education_background->language,
            'computer_skill' => $data['computer_skill'] ?? $member->member_education_background->computer_skill,
            'misc_skill' => $data['misc_skill'] ?? $member->member_education_background->misc_skill,
        ]);
    }

    private function updateGuardianDetail(member_personal_detail $member, array $data): void
    {
        $member->member_guardian_detail()->update([
            'father_name' => $data['father_name'] ?? $member->member_guardian_detail->father_name,
            'father_dob' => $data['father_dob'] ?? $member->member_guardian_detail->father_dob,
            'father_occupation' => $data['father_occupation'] ?? $member->member_guardian_detail->father_occupation,
            'father_current_address' => $data['father_current_address'] ?? $member->member_guardian_detail->father_current_address,
            'mother_name' => $data['mother_name'] ?? $member->member_guardian_detail->mother_name,
            'mother_dob' => $data['mother_dob'] ?? $member->member_guardian_detail->mother_dob,
            'mother_occupation' => $data['mother_occupation'] ?? $member->member_guardian_detail->mother_occupation,
            'mother_current_address' => $data['mother_current_address'] ?? $member->member_guardian_detail->mother_current_address,
            'guardian_phone' => $data['guardian_phone'] ?? $member->member_guardian_detail->guardian_phone,
        ]);
    }
    private function handleImageUpload(?array $data, ?UploadedFile $image, int $currentMemberId): ?string
    {
        if (!$image || !isset($data['name_en'])) {
            return null;
        }

        $imageName = 'mem-' . str_replace(' ', '', $data["name_en"] . ($currentMemberId + 1)) . '.' . $image->extension();
        $image->move(public_path('images/members'), $imageName);

        return "images/$imageName";
    }
    private function convertDate($date)
    {
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }
}
