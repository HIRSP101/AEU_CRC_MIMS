<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\memberCurrentAddressRequest;
use App\Http\Requests\memberEducationRequest;
use App\Http\Requests\MemberPersonalDetailRulesRequest;
use App\Http\Requests\memberGuardianRequest;
use App\Http\Requests\memberPobAddressRequest;
use App\Models\institute;
use App\Models\member_current_address;
use App\Models\member_education_background;
use App\Models\member_personal_detail;
use App\Models\member_pob_address;
use App\Models\member_registration_detail;
use App\Models\member_guardian_detail;
use DB;

class MemberController extends Controller
{
    public function home()
    {
        $Member_personal_detail = member_personal_detail::all();
        return view("dashboard.index", ["Member_personal_detail" => $Member_personal_detail]);
    }

    public function create()
    {
        return view("dashboard.insert-member.create-member-page", );
    }

    public function addmember(
        MemberPersonalDetailRulesRequest $request,
        memberGuardianRequest $request1,
        memberCurrentAddressRequest $request2,
        memberPobAddressRequest $request3,
        memberEducationRequest $request4,
    ) {
        $validatedData = $request->validated();
        $validatedData1 = $request1->validated();
        $validatedData2 = $request2->validated();
        $validatedData3 = $request3->validated();
        $validatedData4 = $request4->validated();
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images'), $fileName);

            $validatedData["image"] = 'images/' . $fileName;
        }
        DB::transaction(
            function () use ($validatedData, $validatedData1, $validatedData2, $validatedData3, $validatedData4) {
                // Insert into member_personal table
                $memberPersonal = member_personal_detail::create($validatedData);
                //insert into member_guardian_detail table
                $memberPersonal->member_guardian_detail()->create($validatedData1);
                //insert into member_current_address table
                $memberPersonal->member_current_address()->create(
                    [
                        "village" => $validatedData2["current_village"],
                        "district_khan" => $validatedData2["current_district_khan"],
                        "commune_sangkat" => $validatedData2["current_commune_sangkat"],
                        "provience_city" => $validatedData2["current_provience_city"],
                        "home_no" => $validatedData2["home_no"],
                        "street_no" => $validatedData2["street_no"]
                    ]
                );
                //insert into member_pob_address table
                $memberPersonal->member_pob_address()->create($validatedData3);

                //insert into member_registration_table
                $memberPersonal->member_registration_detail()->create(
                    [
                        "registration_date" => $validatedData["recruitment_date"]
                    ]
                );
                //insert into institute table
                $member_edu = institute::create(
                    [
                        'name' => $validatedData["name"]
                    ]
                );
                //insert into memeber_education_background
                $memberPersonal->member_education_background()->create(
                    [
                        'institute_id' => $member_edu->institute_id,
                        "acadmedic_year" => $validatedData4['acadmedic_year'],
                        "major" => $validatedData4['major'],
                        "education_level" => $validatedData4['education_level'],
                        "language" => $validatedData4['language'],
                        "computer_skill" => $validatedData4['computer_skill'],
                        "misc_skill" => $validatedData4['misc_skill'],
                    ]
                );
            }
        );

        return $validatedData;
    }

    public function details($id)
    {
        $member = member_personal_detail::findOrFail($id);
        $member_pob = member_pob_address::where('member_id', $id)->firstOrFail();
        $member_addr = member_current_address::where('member_id', $id)->firstOrFail();
        $member_edu = member_education_background::where('member_id', $id)->firstOrFail();
        $member_regis = member_registration_detail::where('member_id', $id)->firstOrFail();
        $member_guardian = member_guardian_detail::where('member_id', $id)->firstOrFail();
        // return response()->json($memberAddress->village, 200);
        return view(
            'dashboard.detail',
            compact(
                'member',
                'member_pob',
                'member_addr',
                'member_edu',
                'member_regis',
                'member_guardian'
            )
        );
    }
}
