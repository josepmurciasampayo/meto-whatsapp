<?php

namespace Database\Seeders;

use App\Enums\EnumGroup;
use App\Enums\HighSchool\{Boarding, ClassSize, Cost, Exam, SchoolSize};
use App\Enums\HighSchool\Role as HSRole;
use App\Enums\HighSchool\Type as HSType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\Chat\{Campaign, State};
use App\Enums\Country\{Country, Region, SubRegion};
use App\Enums\General\{Channel, Form, FormStatus, LoginEventType, MatchStudentInstitution, Method, Month, SocialNetwork, Subject, TagGroups};
use App\Enums\Institution\{TagsInstitution, Type, Size};
use App\Enums\Institution\Role as InstRole;
use App\Enums\Student\{Curriculum, Disability, Gender, Owner, QuestionType, Refugee, SubmissionDevice, TagsStudent};
use App\Enums\User\{Role, Status, Consent, Verified};

class EnumSeeder extends Seeder
{
    public function run()
    {
        self::loadToTable(Campaign::options(),EnumGroup::CHAT_CAMPAIGNS, Campaign::descriptions());
        self::loadToTable(State::options(),EnumGroup::CHAT_STATE, State::descriptions());

        /* country is loaded in separate table */
        self::loadToTable(Region::options(),EnumGroup::REGION, Region::descriptions());
        self::loadToTable(SubRegion::options(),EnumGroup::SUBREGION, SubRegion::descriptions());

        self::loadToTable(Channel::options(),EnumGroup::GENERAL_CHANNEL, Channel::descriptions());
        self::loadToTable(Form::options(),EnumGroup::GENERAL_FORM, Form::descriptions());
        self::loadToTable(FormStatus::options(),EnumGroup::GENERAL_FORMSTATUS, FormStatus::descriptions());
        self::loadToTable(LoginEventType::options(), EnumGroup::GENERAL_LOGINEVENTTYPE, LoginEventType::descriptions());
        self::loadToTable(MatchStudentInstitution::options(), EnumGroup::GENERAL_MATCH, MatchStudentInstitution::descriptions());
        self::loadToTable(Method::options(),EnumGroup::GENERAL_METHOD, Method::descriptions());
        self::loadToTable(Month::options(),EnumGroup::GENERAL_MONTH, Month::descriptions());
        self::loadToTable(QuestionType::options(),EnumGroup::GENERAL_QUESTIONTYPE, QuestionType::descriptions());
        self::loadToTable(SocialNetwork::options(), EnumGroup::GENERAL_SOCIALNETWORK, SocialNetwork::descriptions());
        self::loadToTable(Subject::options(),EnumGroup::GENERAL_SUBJECT, Subject::descriptions());
        self::loadToTable(TagGroups::options(), EnumGroup::GENERAL_TAGGROUP, TagGroups::descriptions());

        self::loadToTable(Boarding::options(), EnumGroup::HS_BOARDING, Boarding::descriptions());
        self::loadToTable(ClassSize::options(), EnumGroup::HS_CLASSSIZE, ClassSize::descriptions());
        self::loadToTable(Cost::options(), EnumGroup::HS_COST, Cost::descriptions());
        self::loadToTable(Exam::options(), EnumGroup::HS_EXAM, Exam::descriptions());
        self::loadToTable(HSRole::options(), EnumGroup::HS_ROLE, HSRole::descriptions());
        self::loadToTable(SchoolSize::options(), EnumGroup::HS_SCHOOLSIZE, SchoolSize::descriptions());
        self::loadToTable(HSType::options(), EnumGroup::HS_TYPE, HSType::descriptions());

        self::loadToTable(TagsInstitution::options(), EnumGroup::INSTITUTION_TAG, TagsInstitution::descriptions());
        self::loadToTable(InstRole::options(), EnumGroup::INSTITUTION_ROLE, InstRole::descriptions());
        self::loadToTable(Size::options(), EnumGroup::INSTITUTION_SIZE, Size::descriptions());
        self::loadToTable(Type::options(), EnumGroup::INSTITUTION_TYPE, Type::descriptions());

        self::loadToTable(TagsInstitution::options(), EnumGroup::INSTITUTION_TAG, TagsInstitution::descriptions());
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

    public static function loadToTable(array $values, EnumGroup $group, array $descriptions) :void
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
