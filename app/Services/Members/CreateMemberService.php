<?php

namespace App\Services\Members;

use App\Models\branch;
use App\Models\branch_hei;
use App\Models\member_personal_detail;
use DateTimeZone;
use DB;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use App\Helpers\DateTimeFormat;
use Nette\MemberAccessException;

class CreateMemberService
{

    public function createMember(array $data, ?UploadedFile $image, int $currentMemberId)
    {
        //  dd($data);

        $imagePath = $this->handleImageUpload($data, $image, $currentMemberId);
        // dd($imagePath);
        $name_kh = $data['name_kh'] ?? null;
        $phone = $data['phone_number'] ?? null;
        $dob = isset($data['date_of_birth']) ? $this->convertDate($data['date_of_birth']) : null;
        $existingMember = member_personal_detail::where('name_kh', $name_kh)
            ->where('phone_number', $phone)
            ->where('date_of_birth', $dob)
            ->first();
        if ($existingMember) {
            $member = member_personal_detail::create([
                "name_kh" => $data['name_kh'] ?? null,
                "name_en" => $data['name_en'] ?? null,
                "gender" => $data['gender'] ?? null,
                "member_image" => $imagePath ?? null,
                "nationality" => $data['nationality'] ?? "ខ្មែរ",
                "date_of_birth" => isset($data['date_of_birth']) ? $this->convertDate($data['date_of_birth']) : null,
                "full_current_address" => $data['full_current_address'] ?? null,
                "phone_number" => $data['phone_number'] ?? null,
                "email" => $data['email'],
                "facebook" => $data['facebook'] ?? null,
                "shirt_size" => $data['shirt_size'] ?? null,
                "branch_id" => $data['branch_id'] ?? null,
                "member_type" => $data["member_type"] ?? null,
                "member_status" => $data["member_status"] ?? null,
            ]);
            $this->createRelatedData($member, $data);

            return $member;
        } else {
            return false;
        }
    }

    public function importMember(array $data, int $currentMemberId)
    {
        $dob = isset($data['date_of_birth']) ? $this->convertDate($data['date_of_birth']) : null;
        // $existingMember = member_personal_detail::where('name_kh', 'like', '%' . $data['name_kh'] . '%')->first();
        $existingMember = DB::table('member_personal_detail as mpd')
            ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->join('member_current_address as mca', 'mpd.member_id', '=', 'mca.member_id')
            ->join('member_pob_address as mpa', 'mpd.member_id', '=', 'mpa.member_id')
            ->join('school as s', 'meb.school_id', '=', 's.school_id')
            ->where('mpd.name_kh', 'like', '%' . $data['name_kh'] . '%')
            ->select([
                'mpd.name_kh as name_kh',
                'mpd.name_en as name_en',
                'mpd.gender as gender',
                'mpd.date_of_birth as date_of_birth',
                DB::raw("CONCAT(mpa.commune_sangkat, ', ', mpa.district_khan, ', ', mpa.provience_city) as full_pob_provience_city"),
                'mpa.commune_sangkat as pob_commune_sangkat',
                'mpa.district_khan as pob_district_khan',
                'mpa.provience_city as pob_provience_city',
                's.school_name as institute_id',
                'mpd.member_type as member_type',
                'meb.education_level as education_level',
                'meb.training_received as training_received',
                'mpd.member_status as member_status',
                'meb.acadmedic_year as acadmedic_year',
                'mrd.registration_date as registration_date',
                'mpd.full_current_address as full_current_address',
                'mpd.phone_number as phone_number',
                'mgd.guardian_phone as guardian_phone',

            ])
            ->first();
        // dd($existingMember);

        if (!$existingMember) {
            $member = member_personal_detail::create([
                "name_kh" => $data['name_kh'] ?? null,
                "name_en" => $data['name_en'] ?? null,
                "gender" => $data['gender'] ?? null,
                "member_image" => null,
                "nationality" => $data['nationality'] ?? "ខ្មែរ",
                "date_of_birth" => $data['date_of_birth'] ?? null,
                "full_current_address" => $data['full_current_address'] ?? null,
                "phone_number" => DateTimeFormat::convertKhmerToEnglishNumbers($data['phone_number']) ?? null,
                "shirt_size" => $data['shirt_size'] ?? null,
                "branch_id" => $data['branch_id'] ?? null,
                "member_type" => $data["member_type"] ?? null,
                "member_status" => $data["member_status"] ?? null,
            ]);
            $this->createRelatedData($member, $data);
            return [true, $member];
        } else {
            return [false, $existingMember];
        }
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
            'expiration_date' => $this->calculateExpirationDate($data['registration_date'], $data['education_level']) ?? null,
            'approved' => $data['approved'] ?? 1,
            'form_submits_id' => $data['form_submits_id'] ?? null,
            'scout_youth_registration_date' => !empty($data['scout_youth_registration_date']) ? $data['scout_youth_registration_date'] : null,
            'uyfc_registration_date' => !empty($data['uyfc_registration_date']) ? $data['uyfc_registration_date'] : null,
            'other_ngos_registration_date' => !empty($data['other_ngos_registration_date']) ? $data['other_ngos_registration_date'] : null
        ]);
    }

    private function calculateExpirationDate($registrationDate, $educationLevel)
    {
        $edulevelAfterSplit = DateTimeFormat::spittingEducationLevel($educationLevel);
        $registrationDate = new \DateTime($registrationDate);

        $highSchoolMaxGrade = 12;
        $universityMaxYear = 4;

        if ($edulevelAfterSplit >= 7 && $edulevelAfterSplit <= $highSchoolMaxGrade) {
            $remainingYears = $highSchoolMaxGrade - $edulevelAfterSplit;
        } elseif ($edulevelAfterSplit >= 1 && $edulevelAfterSplit <= $universityMaxYear) {
            $remainingYears = $universityMaxYear - ($edulevelAfterSplit - 1);
        } else {

            return null;
        }


        $registrationDate->modify("+$remainingYears years");

        return $registrationDate->format('Y-m-d');
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
            'acadmedic_year' => DateTimeFormat::convertKhmerToEnglishNumbers($data['acadmedic_year']) ?? null,
            'major' => $data['major'] ?? null,
            'batch' => $data['batch'] ?? null,
            'shift' => $data['shift'] ?? null,
            'language' => $data['language'] ?? null,
            'computer_skill' => $data['computer_skill'] ?? null,
            'misc_skill' => $data['misc_skill'] ?? null,
            'branch_id' => $data["branch_id"] ?? null,
            'branchhei_id' => $data["branchhei_id"] ?? null,
            'training_received' => $data["training_received"] ?? null,
            'education_level' => $data["education_level"] ?? null,
            'school_id' => $data["school_id"] ?? null,
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
            'guardian_phone' => DateTimeFormat::convertKhmerToEnglishNumbers($data['guardian_phone']) ?? null
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
