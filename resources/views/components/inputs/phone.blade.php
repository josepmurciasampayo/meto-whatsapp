@props(['label' => 'Phone Number', 'name' => 'phone', 'help' => false, 'saved' => '', 'req' => false])

@php
  $countries = [
    '93' => 'Afghanistan (+93)',
    '355' => 'Albania (+355)',
    '213' => 'Algeria (+213)',
    '1684' => 'American Samoa (+1684)',
    '376' => 'Andorra (+376)',
    '244' => 'Angola (+244)',
    '1264' => 'Anguilla (+1264)',
    '672' => 'Antarctica (+672)',
    '1268' => 'Antigua and Barbuda (+1268)',
    '54' => 'Argentina (+54)',
    '374' => 'Armenia (+374)',
    '297' => 'Aruba (+297)',
    '61' => 'Australia (+61)',
    '43' => 'Austria (+43)',
    '994' => 'Azerbaijan (+994)',
    '1242' => 'Bahamas (+1242)',
    '973' => 'Bahrain (+973)',
    '880' => 'Bangladesh (+880)',
    '1246' => 'Barbados (+1246)',
    '375' => 'Belarus (+375)',
    '32' => 'Belgium (+32)',
    '501' => 'Belize (+501)',
    '229' => 'Benin (+229)',
    '1441' => 'Bermuda (+1441)',
    '975' => 'Bhutan (+975)',
    '591' => 'Bolivia (+591)',
    '387' => 'Bosnia and Herzegovina (+387)',
    '267' => 'Botswana (+267)',
    '55' => 'Brazil (+55)',
    '246' => 'British Indian Ocean Territory (+246)',
    '1284' => 'British Virgin Islands (+1284)',
    '673' => 'Brunei (+673)',
    '359' => 'Bulgaria (+359)',
    '226' => 'Burkina Faso (+226)',
    '257' => 'Burundi (+257)',
    '855' => 'Cambodia (+855)',
    '237' => 'Cameroon (+237)',
    '1' => 'Canada (+1)',
    '238' => 'Cape Verde (+238)',
    '599' => 'Caribbean Netherlands (+599)',
    '1345' => 'Cayman Islands (+1345)',
    '236' => 'Central African Republic (+236)',
    '235' => 'Chad (+235)',
    '56' => 'Chile (+56)',
    '86' => 'China (+86)',
    '61' => 'Christmas Island (+61)',
    '61' => 'Cocos Islands (+61)',
    '57' => 'Colombia (+57)',
    '269' => 'Comoros (+269)',
    '242' => 'Congo - Brazzaville (+242)',
    '243' => 'Congo - Kinshasa (+243)',
    '682' => 'Cook Islands (+682)',
    '506' => 'Costa Rica (+506)',
    '385' => 'Croatia (+385)',
    '53' => 'Cuba (+53)',
    '599' => 'Curaçao (+599)',
    '357' => 'Cyprus (+357)',
    '420' => 'Czech Republic (+420)',
    '225' => 'Côte d’Ivoire (+225)',
    '45' => 'Denmark (+45)',
    '253' => 'Djibouti (+253)',
    '1767' => 'Dominica (+1767)',
    '1809' => 'Dominican Republic (+1809)',
    '1829' => 'Dominican Republic (+1829)',
    '1849' => 'Dominican Republic (+1849)',
    '593' => 'Ecuador (+593)',
    '20' => 'Egypt (+20)',
    '503' => 'El Salvador (+503)',
    '240' => 'Equatorial Guinea (+240)',
    '291' => 'Eritrea (+291)',
    '372' => 'Estonia (+372)',
    '251' => 'Ethiopia (+251)',
    '500' => 'Falkland Islands (+500)',
    '298' => 'Faroe Islands (+298)',
    '679' => 'Fiji (+679)',
    '358' => 'Finland (+358)',
    '33' => 'France (+33)',
    '594' => 'French Guiana (+594)',
    '689' => 'French Polynesia (+689)',
    '241' => 'Gabon (+241)',
    '220' => 'Gambia (+220)',
    '995' => 'Georgia (+995)',
    '49' => 'Germany (+49)',
    '233' => 'Ghana (+233)',
    '350' => 'Gibraltar (+350)',
    '30' => 'Greece (+30)',
    '299' => 'Greenland (+299)',
    '1473' => 'Grenada (+1473)',
    '590' => 'Guadeloupe (+590)',
    '1671' => 'Guam (+1671)',
    '502' => 'Guatemala (+502)',
    '44' => 'Guernsey (+44)',
    '224' => 'Guinea (+224)',
    '245' => 'Guinea-Bissau (+245)',
    '592' => 'Guyana (+592)',
    '509' => 'Haiti (+509)',
    '504' => 'Honduras (+504)',
    '852' => 'Hong Kong (+852)',
    '36' => 'Hungary (+36)',
    '354' => 'Iceland (+354)',
    '91' => 'India (+91)',
    '62' => 'Indonesia (+62)',
    '98' => 'Iran (+98)',
    '964' => 'Iraq (+964)',
    '353' => 'Ireland (+353)',
    '44' => 'Isle of Man (+44)',
    '972' => 'Israel (+972)',
    '39' => 'Italy (+39)',
    '1876' => 'Jamaica (+1876)',
    '81' => 'Japan (+81)',
    '44' => 'Jersey (+44)',
    '962' => 'Jordan (+962)',
    '7' => 'Kazakhstan (+7)',
    '254' => 'Kenya (+254)',
    '686' => 'Kiribati (+686)',
    '383' => 'Kosovo (+383)',
    '965' => 'Kuwait (+965)',
    '996' => 'Kyrgyzstan (+996)',
    '856' => 'Laos (+856)',
    '371' => 'Latvia (+371)',
    '961' => 'Lebanon (+961)',
    '266' => 'Lesotho (+266)',
    '231' => 'Liberia (+231)',
    '218' => 'Libya (+218)',
    '423' => 'Liechtenstein (+423)',
    '370' => 'Lithuania (+370)',
    '352' => 'Luxembourg (+352)',
    '853' => 'Macau (+853)',
    '389' => 'Macedonia (+389)',
    '261' => 'Madagascar (+261)',
    '265' => 'Malawi (+265)',
    '60' => 'Malaysia (+60)',
    '960' => 'Maldives (+960)',
    '223' => 'Mali (+223)',
    '356' => 'Malta (+356)',
    '692' => 'Marshall Islands (+692)',
    '596' => 'Martinique (+596)',
    '222' => 'Mauritania (+222)',
    '230' => 'Mauritius (+230)',
    '262' => 'Mayotte (+262)',
    '52' => 'Mexico (+52)',
    '691' => 'Micronesia (+691)',
    '373' => 'Moldova (+373)',
    '377' => 'Monaco (+377)',
    '976' => 'Mongolia (+976)',
    '382' => 'Montenegro (+382)',
    '1664' => 'Montserrat (+1664)',
    '212' => 'Morocco (+212)',
    '258' => 'Mozambique (+258)',
    '95' => 'Myanmar (Burma) (+95)',
    '264' => 'Namibia (+264)',
    '674' => 'Nauru (+674)',
    '977' => 'Nepal (+977)',
    '31' => 'Netherlands (+31)',
    '687' => 'New Caledonia (+687)',
    '64' => 'New Zealand (+64)',
    '505' => 'Nicaragua (+505)',
    '227' => 'Niger (+227)',
    '234' => 'Nigeria (+234)',
    '683' => 'Niue (+683)',
    '672' => 'Norfolk Island (+672)',
    '850' => 'North Korea (+850)',
    '47' => 'Norway (+47)',
    '968' => 'Oman (+968)',
    '92' => 'Pakistan (+92)',
    '680' => 'Palau (+680)',
    '970' => 'Palestinian Territories (+970)',
    '507' => 'Panama (+507)',
    '675' => 'Papua New Guinea (+675)',
    '595' => 'Paraguay (+595)',
    '51' => 'Peru (+51)',
    '63' => 'Philippines (+63)',
    '48' => 'Poland (+48)',
    '351' => 'Portugal (+351)',
    '1' => 'Puerto Rico (+1)',
    '974' => 'Qatar (+974)',
    '262' => 'Réunion (+262)',
    '40' => 'Romania (+40)',
    '7' => 'Russia (+7)',
    '250' => 'Rwanda (+250)',
    '590' => 'Saint Barthélemy (+590)',
    '290' => 'Saint Helena (+290)',
    '1869' => 'Saint Kitts and Nevis (+1869)',
    '1758' => 'Saint Lucia (+1758)',
    '1599' => 'Saint Martin (+1599)',
    '508' => 'Saint Pierre and Miquelon (+508)',
    '1784' => 'Saint Vincent and the Grenadines (+1784)',
    '685' => 'Samoa (+685)',
    '378' => 'San Marino (+378)',
    '239' => 'São Tomé and Príncipe (+239)',
    '966' => 'Saudi Arabia (+966)',
    '221' => 'Senegal (+221)',
    '381' => 'Serbia (+381)',
    '248' => 'Seychelles (+248)',
    '232' => 'Sierra Leone (+232)',
    '65' => 'Singapore (+65)',
    '421' => 'Slovakia (+421)',
    '386' => 'Slovenia (+386)',
    '677' => 'Solomon Islands (+677)',
    '252' => 'Somalia (+252)',
    '27' => 'South Africa (+27)',
    '82' => 'South Korea (+82)',
    '211' => 'South Sudan (+211)',
    '34' => 'Spain (+34)',
    '94' => 'Sri Lanka (+94)',
    '249' => 'Sudan (+249)',
    '597' => 'Suriname (+597)',
    '268' => 'Swaziland (+268)',
    '46' => 'Sweden (+46)',
    '41' => 'Switzerland (+41)',
    '963' => 'Syria (+963)',
    '886' => 'Taiwan (+886)',
    '992' => 'Tajikistan (+992)',
    '255' => 'Tanzania (+255)',
    '66' => 'Thailand (+66)',
    '670' => 'Timor-Leste (+670)',
    '228' => 'Togo (+228)',
    '690' => 'Tokelau (+690)',
    '676' => 'Tonga (+676)',
    '1868' => 'Trinidad and Tobago (+1868)',
    '216' => 'Tunisia (+216)',
    '90' => 'Turkey (+90)',
    '993' => 'Turkmenistan (+993)',
    '1649' => 'Turks and Caicos Islands (+1649)',
    '688' => 'Tuvalu (+688)',
    '256' => 'Uganda (+256)',
    '380' => 'Ukraine (+380)',
    '971' => 'United Arab Emirates (+971)',
    '44' => 'United Kingdom (+44)',
    '1' => 'United States (+1)',
    '598' => 'Uruguay (+598)',
    '998' => 'Uzbekistan (+998)',
    '678' => 'Vanuatu (+678)',
    '39' => 'Vatican City (+39)',
    '58' => 'Venezuela (+58)',
    '84' => 'Vietnam (+84)',
    '1284' => 'British Virgin Islands (+1284)',
    '1340' => 'U.S. Virgin Islands (+1340)',
    '681' => 'Wallis and Futuna (+681)',
    '212' => 'Western Sahara (+212)',
    '967' => 'Yemen (+967)',
    '260' => 'Zambia (+260)',
    '263' => 'Zimbabwe (+263)'
];
    $default_code = '1'; // change this to the default country code
    $saved_code = $default_code;
    $saved_number = '';

    if (!empty($saved)) {
        $saved_parts = explode(' ', $saved, 2);
        $saved_code = $saved_parts[0];
        $saved_number = $saved_parts[1];
    }
@endphp

<div class="my-4 bg-gray-100 rounded-md p-4">
    @php $required = ($req == \App\Enums\General\YesNo::YES()) ? "*" : ""  @endphp
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
    @endif
    <div class="flex flex-wrap items-center">
        @php $required = ($req == \App\Enums\General\YesNo::YES()) ? "required" : ""  @endphp
        <select name="{{ $name }}_code" id="{{ $name }}_code" class="block w-full sm:w-32 pr-2 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm" {{ $required }}>
            @foreach ($countries as $code => $name)
                <option value="{{ $code }}" {{ $code == $saved_code ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
        <input type="tel" name="{{ $name }}_number" id="{{ $name }}_number" value="{{ $saved_number }}" placeholder="Enter phone number" class="mt-2 sm:mt-0 flex-1 ml-0 sm:ml-2 block w-full pr-10 pl-3 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white" pattern="\d{0,10}" maxlength="10" oninput="this.value = this.value.replace(/\D/g, '')">
    </div>
    <input type="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ $saved_code }} {{ $saved_number }}">
</div>

@push('scripts')
    <script>
        const codeSelect = document.getElementById('{{ $name }}_code');
        const numberInput = document.getElementById('{{ $name }}_number');
        const hiddenInput = document.getElementById('{{ $name }}');

        // update the hidden input value when the code or number input changes
        const updateHiddenValue = () => {
            hiddenInput.value = codeSelect.value + ' ' + numberInput.value.replace(/[^0-9]/g, '');
        };

        codeSelect.addEventListener('change', updateHiddenValue);
        numberInput.addEventListener('input', updateHiddenValue);
    </script>
@endpush