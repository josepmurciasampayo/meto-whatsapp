<?php

namespace Database\Seeders;

use App\Enums\EnumGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\Chat\{Campaign, State};
use App\Enums\Country\{Country, Region, SubRegion};
use App\Enums\General\{Channel, Form, FormStatus, MatchStudentInstitution, Method, SocialNetwork, TagGroups};
use App\Enums\Institution\{TagsInstitution, Type};
use App\Enums\Student\{Curriculum, Disability, Gender, Owner, Refugee, SubmissionDevice, TagsStudent};
use App\Enums\User\{Role, Status, Consent, Verified};

class EnumSeeder extends Seeder
{
    public function run()
    {
        self::loadToTable(Campaign::options(),EnumGroup::CHAT_CAMPAIGNS);
        self::loadToTable(State::options(),EnumGroup::CHAT_STATE);

        self::loadToTable(Country::options(),EnumGroup::COUNTRY);
        self::loadToTable(Region::options(),EnumGroup::REGION);
        self::loadToTable(SubRegion::options(),EnumGroup::SUBREGION);

        self::loadToTable(Channel::options(),EnumGroup::GENERAL_CHANNEL);
        self::loadToTable(Form::options(),EnumGroup::GENERAL_FORM);
        self::loadToTable(FormStatus::options(),EnumGroup::GENERAL_FORMSTATUS);
        self::loadToTable(Method::options(),EnumGroup::GENERAL_METHOD);
        self::loadToTable(SocialNetwork::options(), EnumGroup::GENERAL_SOCIALNETWORK);
        self::loadToTable(TagGroups::options(), EnumGroup::GENERAL_TAGGROUP);
        self::loadToTable(MatchStudentInstitution::options(), EnumGroup::GENERAL_MATCH);

        self::loadToTable(TagsInstitution::options(), EnumGroup::INSTITUTION_TAG);
        self::loadToTable(Type::options(), EnumGroup::INSTITUTION_TYPE);

        self::loadToTable(Curriculum::options(), EnumGroup::STUDENT_CURRICULUM);
        self::loadToTable(Disability::options(), EnumGroup::STUDENT_DISABILITY);
        self::loadToTable(Gender::options(), EnumGroup::STUDENT_GENDER);
        self::loadToTable(Owner::options(), EnumGroup::STUDENT_OWNER);
        self::loadToTable(Refugee::options(), EnumGroup::STUDENT_REFUGEE);
        self::loadToTable(SubmissionDevice::options(), EnumGroup::STUDENT_SUBMISSION_DEVICE);
        self::loadToTable(TagsStudent::options(), EnumGroup::STUDENT_TAG);

        self::loadToTable(Consent::options(), EnumGroup::USER_CONSENT);
        self::loadToTable(Verified::options(), EnumGroup::USER_VERIFIED);
        self::loadToTable(Role::options(), EnumGroup::USER_ROLE);
        self::loadToTable(Status::options(), EnumGroup::USER_STATUS);
    }

    private static function loadToTable(array $values, EnumGroup $group) :void
    {
        foreach ($values as $value => $id) {
            DB::table('enum')->insert([
                'group_id' => $group->value,
                'enum_id' => $id,
                'enum_value' => $value,
                'enum_desc' => null, // TODO: how do I get this here...
            ]);
        }
    }
}
