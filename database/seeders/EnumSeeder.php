<?php

namespace Database\Seeders;

use App\Enums\EnumGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\General\{Method, SocialNetwork, TagGroups};
use App\Enums\Institution\{InstTags, Type};
use App\Enums\Student\{Consent, Curriculum, Disability, Gender, Owner, Refugee, SubmissionDevice, StuTags, Verified};
use App\Enums\User\{Role, Status};

class EnumSeeder extends Seeder
{
    public function run()
    {
        self::loadToTable(Method::options(),EnumGroup::GENERAL);
        self::loadToTable(SocialNetwork::options(), EnumGroup::GENERAL);
        self::loadToTable(TagGroups::options(), EnumGroup::GENERAL);

        self::loadToTable(InstTags::options(), EnumGroup::INSTITUTION);
        self::loadToTable(Type::options(), EnumGroup::INSTITUTION);

        self::loadToTable(Consent::options(), EnumGroup::STUDENT);
        self::loadToTable(Curriculum::options(), EnumGroup::STUDENT);
        self::loadToTable(Disability::options(), EnumGroup::STUDENT);
        self::loadToTable(Gender::options(), EnumGroup::STUDENT);
        self::loadToTable(Owner::options(), EnumGroup::STUDENT);
        self::loadToTable(Refugee::options(), EnumGroup::STUDENT);
        self::loadToTable(SubmissionDevice::options(), EnumGroup::STUDENT);
        self::loadToTable(StuTags::options(), EnumGroup::STUDENT);
        self::loadToTable(Verified::options(), EnumGroup::STUDENT);

        self::loadToTable(Role::options(), EnumGroup::USER);
        self::loadToTable(Status::options(), EnumGroup::USER);
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
