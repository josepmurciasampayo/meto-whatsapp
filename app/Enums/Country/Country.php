<?php

namespace App\Enums\Country;

use Illuminate\Support\Facades\Log;
use ArchTech\Enums\{InvokableCases, Options, Values, Names, Strings};

enum Country :int
{
    use InvokableCases, Options, Values, Names, Strings;

    case AF = 1;
    case AX = 2;
    case AL = 3;
    case DZ = 4;
    case AS = 5;
    case AD = 6;
    case AO = 7;
    case AI = 8;
    case AG = 9;
    case AR = 10;
    case AM = 11;
    case AW = 12;
    case AU = 13;
    case AT = 14;
    case AZ = 15;
    case BS = 16;
    case BH = 17;
    case BD = 18;
    case BB = 19;
    case BY = 20;
    case BE = 21;
    case BZ = 22;
    case BJ = 23;
    case BM = 24;
    case BT = 25;
    case BO = 26;
    case BQ = 27;
    case BA = 28;
    case BW = 29;
    case BV = 30;
    case BR = 31;
    case IO = 32;
    case BN = 33;
    case BG = 34;
    case BF = 35;
    case BI = 36;
    case CV = 37;
    case KH = 38;
    case CM = 39;
    case CA = 40;
    case KY = 41;
    case CF = 42;
    case TD = 43;
    case CL = 44;
    case CN = 45;
    case CX = 46;
    case CC = 47;
    case CO = 48;
    case KM = 49;
    case CG = 50;
    case CD = 51;
    case CK = 52;
    case CR = 53;
    case CI = 54;
    case HR = 55;
    case CU = 56;
    case CW = 57;
    case CY = 58;
    case CZ = 59;
    case DK = 60;
    case DJ = 61;
    case DM = 62;
    case DO = 63;
    case EC = 64;
    case EG = 65;
    case SV = 66;
    case GQ = 67;
    case ER = 68;
    case EE = 69;
    case SZ = 70;
    case ET = 71;
    case FK = 72;
    case FO = 73;
    case FJ = 74;
    case FI = 75;
    case FR = 76;
    case GF = 77;
    case PF = 78;
    case TF = 79;
    case GA = 80;
    case GM = 81;
    case GE = 82;
    case DE = 83;
    case GH = 84;
    case GI = 85;
    case GR = 86;
    case GL = 87;
    case GD = 88;
    case GP = 89;
    case GU = 90;
    case GT = 91;
    case GG = 92;
    case GN = 93;
    case GW = 94;
    case GY = 95;
    case HT = 96;
    case HM = 97;
    case VA = 98;
    case HN = 99;
    case HK = 100;
    case HU = 101;
    case IS = 102;
    case IN = 103;
    case ID = 104;
    case IR = 105;
    case IQ = 106;
    case IE = 107;
    case IM = 108;
    case IL = 109;
    case IT = 110;
    case JM = 111;
    case JP = 112;
    case JE = 113;
    case JO = 114;
    case KZ = 115;
    case KE = 116;
    case KI = 117;
    case KP = 118;
    case KR = 119;
    case KW = 120;
    case KG = 121;
    case LA = 122;
    case LV = 123;
    case LB = 124;
    case LS = 125;
    case LR = 126;
    case LY = 127;
    case LI = 128;
    case LT = 129;
    case LU = 130;
    case MO = 131;
    case MG = 132;
    case MW = 133;
    case MY = 134;
    case MV = 135;
    case ML = 136;
    case MT = 137;
    case MH = 138;
    case MQ = 139;
    case MR = 140;
    case MU = 141;
    case YT = 142;
    case MX = 143;
    case FM = 144;
    case MD = 145;
    case MC = 146;
    case MN = 147;
    case ME = 148;
    case MS = 149;
    case MA = 150;
    case MZ = 151;
    case MM = 152;
    case NA = 153;
    case NR = 154;
    case NP = 155;
    case NL = 156;
    case NC = 157;
    case NZ = 158;
    case NI = 159;
    case NE = 160;
    case NG = 161;
    case NU = 162;
    case NF = 163;
    case MK = 164;
    case MP = 165;
    case NO = 166;
    case OM = 167;
    case PK = 168;
    case PW = 169;
    case PS = 170;
    case PA = 171;
    case PG = 172;
    case PY = 173;
    case PE = 174;
    case PH = 175;
    case PN = 176;
    case PL = 177;
    case PT = 178;
    case PR = 179;
    case QA = 180;
    case RE = 181;
    case RO = 182;
    case RU = 183;
    case RW = 184;
    case BL = 185;
    case SH = 186;
    case KN = 187;
    case LC = 188;
    case MF = 189;
    case PM = 190;
    case VC = 191;
    case WS = 192;
    case SM = 193;
    case ST = 194;
    case SA = 195;
    case SN = 196;
    case RS = 197;
    case SC = 198;
    case SL = 199;
    case SG = 200;
    case SX = 201;
    case SK = 202;
    case SI = 203;
    case SB = 204;
    case SO = 205;
    case ZA = 206;
    case GS = 207;
    case SS = 208;
    case ES = 209;
    case LK = 210;
    case SD = 211;
    case SR = 212;
    case SJ = 213;
    case SE = 214;
    case CH = 215;
    case SY = 216;
    case TW = 217;
    case TJ = 218;
    case TZ = 219;
    case TH = 220;
    case TL = 221;
    case TG = 222;
    case TK = 223;
    case TO = 224;
    case TT = 225;
    case TN = 226;
    case TR = 227;
    case TM = 228;
    case TC = 229;
    case TV = 230;
    case UG = 231;
    case UA = 232;
    case AE = 233;
    case GB = 234;
    case US = 235;
    case UM = 236;
    case UY = 237;
    case UZ = 238;
    case VU = 239;
    case VE = 240;
    case VN = 241;
    case VG = 242;
    case VI = 243;
    case WF = 244;
    case EH = 245;
    case YE = 246;
    case ZM = 247;
    case ZW = 248;
    case GLOBAL = 249;
    case REGIONAL = 250;

    public static function getText(self $value) :string
    {
        return match($value) {
            self::AF => 'Afghanistan',
            self::AX => 'Åland Islands',
            self::AL => 'Albania',
            self::DZ => 'Algeria',
            self::AS => 'American Samoa',
            self::AD => 'Andorra',
            self::AO => 'Angola',
            self::AI => 'Anguilla',
            self::AG => 'Antigua and Barbuda',
            self::AR => 'Argentina',
            self::AM => 'Armenia',
            self::AW => 'Aruba',
            self::AU => 'Australia',
            self::AT => 'Austria',
            self::AZ => 'Azerbaijan',
            self::BS => 'Bahamas',
            self::BH => 'Bahrain',
            self::BD => 'Bangladesh',
            self::BB => 'Barbados',
            self::BY => 'Belarus',
            self::BE => 'Belgium',
            self::BZ => 'Belize',
            self::BJ => 'Benin',
            self::BM => 'Bermuda',
            self::BT => 'Bhutan',
            self::BO => 'Bolivia',
            self::BQ => 'Bonaire, Sint Eustatius and Saba',
            self::BA => 'Bosnia and Herzegovina',
            self::BW => 'Botswana',
            self::BV => 'Bouvet Island',
            self::BR => 'Brazil',
            self::IO => 'British Indian Ocean Territory',
            self::BN => 'Brunei Darussalam',
            self::BG => 'Bulgaria',
            self::BF => 'Burkina Faso',
            self::BI => 'Burundi',
            self::CV => 'Cabo Verde',
            self::KH => 'Cambodia',
            self::CM => 'Cameroon',
            self::CA => 'Canada',
            self::KY => 'Cayman Islands',
            self::CF => 'Central African Republic',
            self::TD => 'Chad',
            self::CL => 'Chile',
            self::CN => 'China',
            self::CX => 'Christmas Island',
            self::CC => 'Cocos (Keeling) Islands',
            self::CO => 'Colombia',
            self::KM => 'Comoros',
            self::CG => 'Congo',
            self::CD => 'Congo, Democratic Republic of the',
            self::CK => 'Cook Islands',
            self::CR => 'Costa Rica',
            self::CI => 'Côte d\'Ivoire',
            self::HR => 'Croatia',
            self::CU => 'Cuba',
            self::CW => 'Curaçao',
            self::CY => 'Cyprus',
            self::CZ => 'Czechia',
            self::DK => 'Denmark',
            self::DJ => 'Djibouti',
            self::DM => 'Dominica',
            self::DO => 'Dominican Republic',
            self::EC => 'Ecuador',
            self::EG => 'Egypt',
            self::SV => 'El Salvador',
            self::GQ => 'Equatorial Guinea',
            self::ER => 'Eritrea',
            self::EE => 'Estonia',
            self::SZ => 'Eswatini',
            self::ET => 'Ethiopia',
            self::FK => 'Falkland Islands (Malvinas)',
            self::FO => 'Faroe Islands',
            self::FJ => 'Fiji',
            self::FI => 'Finland',
            self::FR => 'France',
            self::GF => 'French Guiana',
            self::PF => 'French Polynesia',
            self::TF => 'French Southern Territories',
            self::GA => 'Gabon',
            self::GM => 'Gambia',
            self::GE => 'Georgia',
            self::DE => 'Germany',
            self::GH => 'Ghana',
            self::GI => 'Gibraltar',
            self::GR => 'Greece',
            self::GL => 'Greenland',
            self::GD => 'Grenada',
            self::GP => 'Guadeloupe',
            self::GU => 'Guam',
            self::GT => 'Guatemala',
            self::GG => 'Guernsey',
            self::GN => 'Guinea',
            self::GW => 'Guinea-Bissau',
            self::GY => 'Guyana',
            self::HT => 'Haiti',
            self::HM => 'Heard Island and McDonald Islands',
            self::VA => 'Holy See',
            self::HN => 'Honduras',
            self::HK => 'Hong Kong',
            self::HU => 'Hungary',
            self::IS => 'Iceland',
            self::IN => 'India',
            self::ID => 'Indonesia',
            self::IR => 'Iran (Islamic Republic of)',
            self::IQ => 'Iraq',
            self::IE => 'Ireland',
            self::IM => 'Isle of Man',
            self::IL => 'Israel',
            self::IT => 'Italy',
            self::JM => 'Jamaica',
            self::JP => 'Japan',
            self::JE => 'Jersey',
            self::JO => 'Jordan',
            self::KZ => 'Kazakhstan',
            self::KE => 'Kenya',
            self::KI => 'Kiribati',
            self::KP => 'Korea',
            self::KR => 'Republic of Korea',
            self::KW => 'Kuwait',
            self::KG => 'Kyrgyzstan',
            self::LA => 'Lao People\'s Democratic Republic',
            self::LV => 'Latvia',
            self::LB => 'Lebanon',
            self::LS => 'Lesotho',
            self::LR => 'Liberia',
            self::LY => 'Libya',
            self::LI => 'Liechtenstein',
            self::LT => 'Lithuania',
            self::LU => 'Luxembourg',
            self::MO => 'Macao',
            self::MG => 'Madagascar',
            self::MW => 'Malawi',
            self::MY => 'Malaysia',
            self::MV => 'Maldives',
            self::ML => 'Mali',
            self::MT => 'Malta',
            self::MH => 'Marshall Islands',
            self::MQ => 'Martinique',
            self::MR => 'Mauritania',
            self::MU => 'Mauritius',
            self::YT => 'Mayotte',
            self::MX => 'Mexico',
            self::FM => 'Micronesia',
            self::MD => 'Moldova, Republic of',
            self::MC => 'Monaco',
            self::MN => 'Mongolia',
            self::ME => 'Montenegro',
            self::MS => 'Montserrat',
            self::MA => 'Morocco',
            self::MZ => 'Mozambique',
            self::MM => 'Myanmar',
            self::NA => 'Namibia',
            self::NR => 'Nauru',
            self::NP => 'Nepal',
            self::NL => 'Netherlands',
            self::NC => 'New Caledonia',
            self::NZ => 'New Zealand',
            self::NI => 'Nicaragua',
            self::NE => 'Niger',
            self::NG => 'Nigeria',
            self::NU => 'Niue',
            self::NF => 'Norfolk Island',
            self::MK => 'North Macedonia',
            self::MP => 'Northern Mariana Islands',
            self::NO => 'Norway',
            self::OM => 'Oman',
            self::PK => 'Pakistan',
            self::PW => 'Palau',
            self::PS => 'Palestine, State of',
            self::PA => 'Panama',
            self::PG => 'Papua New Guinea',
            self::PY => 'Paraguay',
            self::PE => 'Peru',
            self::PH => 'Philippines',
            self::PN => 'Pitcairn',
            self::PL => 'Poland',
            self::PT => 'Portugal',
            self::PR => 'Puerto Rico',
            self::QA => 'Qatar',
            self::RE => 'Réunion',
            self::RO => 'Romania',
            self::RU => 'Russian Federation',
            self::RW => 'Rwanda',
            self::BL => 'Saint Barthélemy',
            self::SH => 'Saint Helena, Ascension and Tristan da Cunha',
            self::KN => 'Saint Kitts and Nevis',
            self::LC => 'Saint Lucia',
            self::MF => 'Saint Martin (French part)',
            self::PM => 'Saint Pierre and Miquelon',
            self::VC => 'Saint Vincent and the Grenadines',
            self::WS => 'Samoa',
            self::SM => 'San Marino',
            self::ST => 'Sao Tome and Principe',
            self::SA => 'Saudi Arabia',
            self::SN => 'Senegal',
            self::RS => 'Serbia',
            self::SC => 'Seychelles',
            self::SL => 'Sierra Leone',
            self::SG => 'Singapore',
            self::SX => 'Sint Maarten (Dutch part)',
            self::SK => 'Slovakia',
            self::SI => 'Slovenia',
            self::SB => 'Solomon Islands',
            self::SO => 'Somalia',
            self::ZA => 'South Africa',
            self::GS => 'South Georgia and the South Sandwich Islands',
            self::SS => 'South Sudan',
            self::ES => 'Spain',
            self::LK => 'Sri Lanka',
            self::SD => 'Sudan',
            self::SR => 'Suriname',
            self::SJ => 'Svalbard and Jan Mayen',
            self::SE => 'Sweden',
            self::CH => 'Switzerland',
            self::SY => 'Syrian Arab Republic',
            self::TW => 'Taiwan',
            self::TJ => 'Tajikistan',
            self::TZ => 'Tanzania, United Republic of',
            self::TH => 'Thailand',
            self::TL => 'Timor-Leste',
            self::TG => 'Togo',
            self::TK => 'Tokelau',
            self::TO => 'Tonga',
            self::TT => 'Trinidad and Tobago',
            self::TN => 'Tunisia',
            self::TR => 'Turkey',
            self::TM => 'Turkmenistan',
            self::TC => 'Turks and Caicos',
            self::TV => 'Tuvalu',
            self::UG => 'Uganda',
            self::UA => 'Ukraine',
            self::AE => 'United Arab Emirates',
            self::GB => 'United Kingdom of Great Britain and Northern Ireland',
            self::US => 'United States',
            self::UM => 'United States Minor Outlying Islands',
            self::UY => 'Uruguay',
            self::UZ => 'Uzbekistan',
            self::VU => 'Vanuatu',
            self::VE => 'Venezuela',
            self::VN => 'Viet Nam',
            self::VG => 'Virgin Islands (British)',
            self::VI => 'Virgin Islands (U.S.)',
            self::WF => 'Wallis and Futuna',
            self::EH => 'Western Sahara',
            self::YE => 'Yemen',
            self::ZM => 'Zambia',
            self::ZW => 'Zimbabwe',
            self::GLOBAL => 'Global',
            self::REGIONAL => 'Regional',
            default => 'Unknown: ' . $value(),
        };
    }

    public static function lookup(?string $name) :int
    {
        if (is_null($name) || $name == 'null' || strlen($name) == 0) {
            return 0;
        }
        $match = match($name) {
            "Afghanistan" => 1,
            "Åland Islands" => 2,
            "Albania" => 3,
            "Algeria" => 4,
            "American Samoa" => 5,
            "Andorra" => 6,
            "Angola" => 7,
            "Anguilla" => 8,
            "Antigua and Barbuda" => 9,
            "Argentina" => 10,
            "Armenia" => 11,
            "Aruba" => 12,
            "Australia" => 13,
            "Austria" => 14,
            "Azerbaijan" => 15,
            "Bahamas" => 16,
            "Bahrain" => 17,
            "Bangladesh" => 18,
            "Barbados" => 19,
            "Belarus" => 20,
            "Belgium" => 21,
            "Belize" => 22,
            "Benin" => 23,
            "Bermuda" => 24,
            "Bhutan" => 25,
            "Bolivia" => 26,
            "Bonaire, Sint Eustatius and Saba" => 27,
            "Bosnia and Herzegovina" => 28,
            "Botswana" => 29,
            "Bouvet Island" => 30,
            "Brazil" => 31,
            "British Indian Ocean Territory" => 32,
            "Brunei Darussalam" => 33,
            "Brunei" => 33,
            "Bulgaria" => 34,
            "Burkina Faso" => 35,
            "Burundi" => 36,
            "Cabo Verde" => 37,
            "Cambodia" => 38,
            "Cameroon" => 39,
            "Canada" => 40,
            "Cayman Islands" => 41,
            "Central African Republic" => 42,
            "Chad" => 43,
            "Chile" => 44,
            "China" => 45,
            "Christmas Island" => 46,
            "Cocos (Keeling) Islands" => 47,
            "Colombia" => 48,
            "Comoros" => 49,
            "Congo" => 50,
            "Congo (Congo-Brazzaville)" => 50,
            "Congo, Democratic Republic of the" => 51,
            "Democratic Republic of the Congo" => 51,
            "Cook Islands" => 52,
            "Costa Rica" => 53,
            "Côte d'Ivoire" => 54,
            "Côte d''Ivoire" => 54,
            "Côte dIvoire" => 54,
            "Croatia" => 55,
            "Cuba" => 56,
            "Curaçao" => 57,
            "Cyprus" => 58,
            "Czechia" => 59,
            "Czechia (Czech Republic)" => 59,
            "Denmark" => 60,
            "Djibouti" => 61,
            "Dominica" => 62,
            "Dominican Republic" => 63,
            "Ecuador" => 64,
            "Egypt" => 65,
            "El Salvador" => 66,
            "Equatorial Guinea" => 67,
            "Eritrea" => 68,
            "Estonia" => 69,
            "Eswatini" => 70,
            'Eswatini (fmr. "Swaziland")' => 70,
            "Ethiopia" => 71,
            "Falkland Islands (Malvinas)" => 72,
            "Faroe Islands" => 73,
            "Fiji" => 74,
            "Finland" => 75,
            "France" => 76,
            "French Guiana" => 77,
            "French Polynesia" => 78,
            "French Southern Territories" => 79,
            "Gabon" => 80,
            "Gambia" => 81,
            "Georgia" => 82,
            "Germany" => 83,
            "Ghana" => 84,
            "Gibraltar" => 85,
            "Greece" => 86,
            "Greenland" => 87,
            "Grenada" => 88,
            "Guadeloupe" => 89,
            "Guam" => 90,
            "Guatemala" => 91,
            "Guernsey" => 92,
            "Guinea" => 93,
            "Guinea-Bissau" => 94,
            "Guyana" => 95,
            "Haiti" => 96,
            "Heard Island and McDonald Islands" => 97,
            "Holy See" => 98,
            "Honduras" => 99,
            "Hong Kong" => 100,
            "Hungary" => 101,
            "Iceland" => 102,
            "India" => 103,
            "Indonesia" => 104,
            "Iran (Islamic Republic of)" => 105,
            "Iraq" => 106,
            "Ireland" => 107,
            "Isle of Man" => 108,
            "Israel" => 109,
            "Italy" => 110,
            "Jamaica" => 111,
            "Japan" => 112,
            "Jersey" => 113,
            "Jordan" => 114,
            "Kazakhstan" => 115,
            "Kenya" => 116,
            "Kiribati" => 117,
            "Korea (Democratic People's Republic of)" => 118,
            "Korea, Republic of" => 119,
            "North Korea" => 118,
            "South Korea" => 119,
            "Kuwait" => 120,
            "Kyrgyzstan" => 121,
            "Lao People's Democratic Republic" => 122,
            "Latvia" => 123,
            "Lebanon" => 124,
            "Lesotho" => 125,
            "Liberia" => 126,
            "Libya" => 127,
            "Liechtenstein" => 128,
            "Lithuania" => 129,
            "Luxembourg" => 130,
            "Macao" => 131,
            "Madagascar" => 132,
            "Malawi" => 133,
            "Malaysia" => 134,
            "Maldives" => 135,
            "Mali" => 136,
            "Malta" => 137,
            "Marshall Islands" => 138,
            "Martinique" => 139,
            "Mauritania" => 140,
            "Mauritius" => 141,
            "Mayotte" => 142,
            "Mexico" => 143,
            "Micronesia (Federated States of)" => 144,
            "Micronesia" => 144,
            "Moldova, Republic of" => 145,
            "Monaco" => 146,
            "Mongolia" => 147,
            "Montenegro" => 148,
            "Montserrat" => 149,
            "Morocco" => 150,
            "Mozambique" => 151,
            "Myanmar" => 152,
            "Myanmar (formerly Burma)" => 152,
            "Namibia" => 153,
            "Nauru" => 154,
            "Nepal" => 155,
            "Netherlands" => 156,
            "The Netherlands" => 156,
            "New Caledonia" => 157,
            "New Zealand" => 158,
            "Nicaragua" => 159,
            "Niger" => 160,
            "Nigeria" => 161,
            "Niue" => 162,
            "Norfolk Island" => 163,
            "North Macedonia" => 164,
            "Northern Mariana Islands" => 165,
            "Norway" => 166,
            "Oman" => 167,
            "Pakistan" => 168,
            "Palau" => 169,
            "Palestine, State of" => 170,
            "Panama" => 171,
            "Papua New Guinea" => 172,
            "Paraguay" => 173,
            "Peru" => 174,
            "Philippines" => 175,
            "Pitcairn" => 176,
            "Poland" => 177,
            "Portugal" => 178,
            "Puerto Rico" => 179,
            "Qatar" => 180,
            "Réunion" => 181,
            "Romania" => 182,
            "Russian Federation" => 183,
            "Russia" => 183,
            "Rwanda" => 184,
            "Saint Barthélemy" => 185,
            "Saint Helena, Ascension and Tristan da Cunha" => 186,
            "Saint Kitts and Nevis" => 187,
            "Saint Lucia" => 188,
            "Saint Martin (French part)" => 189,
            "Saint Pierre and Miquelon" => 190,
            "Saint Vincent and the Grenadines" => 191,
            "Samoa" => 192,
            "San Marino" => 193,
            "Sao Tome and Principe" => 194,
            "Saudi Arabia" => 195,
            "Senegal" => 196,
            "Serbia" => 197,
            "Seychelles" => 198,
            "Sierra Leone" => 199,
            "Singapore" => 200,
            "Sint Maarten (Dutch part)" => 201,
            "Slovakia" => 202,
            "Slovenia" => 203,
            "Solomon Islands" => 204,
            "Somalia" => 205,
            "South Africa" => 206,
            "South Georgia and the South Sandwich Islands" => 207,
            "South Sudan" => 208,
            "Spain" => 209,
            "Sri Lanka" => 210,
            "Sudan" => 211,
            "Suriname" => 212,
            "Svalbard and Jan Mayen" => 213,
            "Sweden" => 214,
            "Switzerland" => 215,
            "Syrian Arab Republic" => 216,
            "Syria" => 216,
            "Taiwan" => 217,
            "Tajikistan" => 218,
            "Tanzania, United Republic of" => 219,
            "Tanzania" => 219,
            "Thailand" => 220,
            "Timor-Leste" => 221,
            "Togo" => 222,
            "Tokelau" => 223,
            "Tonga" => 224,
            "Trinidad and Tobago" => 225,
            "Tunisia" => 226,
            "Turkey" => 227,
            "Turkmenistan" => 228,
            "Turks and Caicos" => 229,
            "Tuvalu" => 230,
            "Uganda" => 231,
            "Ukraine" => 232,
            "United Arab Emirates" => 233,
            "United Kingdom" => 234,
            "United Kingdon" => 234,
            "Scotland" => 234,
            "United States" => 235,
            "United States of America" => 235,
            "United States Minor Outlying Islands" => 236,
            "Uruguay" => 237,
            "Uzbekistan" => 238,
            "Vanuatu" => 239,
            "Venezuela" => 240,
            "Viet Nam" => 241,
            "Virgin Islands (British)" => 242,
            "Virgin Islands (U.S.)" => 243,
            "Wallis and Futuna" => 244,
            "Western Sahara" => 245,
            "Yemen" => 246,
            "Zambia" => 247,
            "Zimbabwe" => 248,
            default => 0,
        };

        return $match;
    }

}
