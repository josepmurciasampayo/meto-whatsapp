<?php

namespace Database\Seeders;

use App\Enums\EnumGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\General\{Method, SocialNetwork, TagGroups};
use App\Enums\Institution\{TagsInstitution, Type};
use App\Enums\Student\{Curriculum, Disability, Gender, Owner, Refugee, SubmissionDevice, TagsStudent};
use App\Enums\User\{Role, Status, Consent, Verified};

class EnumSeeder extends Seeder
{
    public function run()
    {
        self::loadToTable(Method::options(),EnumGroup::GENERAL_METHOD);
        self::loadToTable(SocialNetwork::options(), EnumGroup::GENERAL_SOCIALNETWORK);
        self::loadToTable(TagGroups::options(), EnumGroup::GENERAL_TAGGROUP);

        self::loadToTable(TagsInstitution::options(), EnumGroup::INSTITUTION);
        self::loadToTable(Type::options(), EnumGroup::INSTITUTION);

        self::loadToTable(Curriculum::options(), EnumGroup::STUDENT);
        self::loadToTable(Disability::options(), EnumGroup::STUDENT);
        self::loadToTable(Gender::options(), EnumGroup::STUDENT);
        self::loadToTable(Owner::options(), EnumGroup::STUDENT);
        self::loadToTable(Refugee::options(), EnumGroup::STUDENT);
        self::loadToTable(SubmissionDevice::options(), EnumGroup::STUDENT);
        self::loadToTable(TagsStudent::options(), EnumGroup::STUDENT);

        self::loadToTable(Consent::options(), EnumGroup::USER_CONSENT);
        self::loadToTable(Verified::options(), EnumGroup::USER_VERIFIED);
        self::loadToTable(Role::options(), EnumGroup::USER_ROLE);
        self::loadToTable(Status::options(), EnumGroup::USER_STATUS);
    }


    private static function loadToTable(array $values, EnumGroup $group) :void
    {
        foreach ($values as $value => $id) {
            $enum =
            DB::table('enum')->insert([
                'group_id' => $group->value,
                'enum_id' => $id,
                'enum_value' => $value,
                'enum_desc' => null,
            ]);
        }
    }
}
