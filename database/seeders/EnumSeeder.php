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
        self::loadToTable(Campaign::options(),EnumGroup::CHAT_CAMPAIGNS, Campaign::descriptions());
        self::loadToTable(State::options(),EnumGroup::CHAT_STATE, State::descriptions());

        // self::loadToTable(Country::options(),EnumGroup::COUNTRY, Country::descriptions());
        self::loadToTable(Region::options(),EnumGroup::REGION, Region::descriptions());
        self::loadToTable(SubRegion::options(),EnumGroup::SUBREGION, SubRegion::descriptions());

        self::loadToTable(Channel::options(),EnumGroup::GENERAL_CHANNEL, Channel::descriptions());
        self::loadToTable(Form::options(),EnumGroup::GENERAL_FORM, Form::descriptions());
        self::loadToTable(FormStatus::options(),EnumGroup::GENERAL_FORMSTATUS, FormStatus::descriptions());
        self::loadToTable(Method::options(),EnumGroup::GENERAL_METHOD, Method::descriptions());
        self::loadToTable(SocialNetwork::options(), EnumGroup::GENERAL_SOCIALNETWORK, SocialNetwork::descriptions());
        self::loadToTable(TagGroups::options(), EnumGroup::GENERAL_TAGGROUP, TagGroups::descriptions());
        self::loadToTable(MatchStudentInstitution::options(), EnumGroup::GENERAL_MATCH, MatchStudentInstitution::descriptions());

        self::loadToTable(TagsInstitution::options(), EnumGroup::INSTITUTION_TAG, TagsInstitution::descriptions());
        self::loadToTable(Type::options(), EnumGroup::INSTITUTION_TYPE, Type::descriptions());

        self::loadToTable(Curriculum::options(), EnumGroup::STUDENT_CURRICULUM, Curriculum::descriptions());
        self::loadToTable(Disability::options(), EnumGroup::STUDENT_DISABILITY, Disability::descriptions());
        self::loadToTable(Gender::options(), EnumGroup::STUDENT_GENDER, Gender::descriptions());
        self::loadToTable(Owner::options(), EnumGroup::STUDENT_OWNER, Owner::descriptions());
        self::loadToTable(Refugee::options(), EnumGroup::STUDENT_REFUGEE, Refugee::descriptions());
        self::loadToTable(SubmissionDevice::options(), EnumGroup::STUDENT_SUBMISSION_DEVICE, SubmissionDevice::descriptions());
        self::loadToTable(TagsStudent::options(), EnumGroup::STUDENT_TAG, TagsStudent::descriptions());

        self::loadToTable(Consent::options(), EnumGroup::USER_CONSENT, Consent::descriptions());
        self::loadToTable(Verified::options(), EnumGroup::USER_VERIFIED, Verified::descriptions());
        self::loadToTable(Role::options(), EnumGroup::USER_ROLE, Role::descriptions());
        self::loadToTable(Status::options(), EnumGroup::USER_STATUS, Status::descriptions());
    }

    private static function loadToTable(array $values, EnumGroup $group, array $descriptions) :void
    {
        foreach ($values as $value => $id) {
            DB::table('enum')->insert([
                'group_id' => $group->value,
                'enum_id' => $id,
                'enum_value' => $value,
                'enum_desc' => $descriptions[$id],
            ]);
        }
    }
}
