@props(['name', 'label', 'saved' => ''])

<div x-data="{ showOther: false }">
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }}</label>
    <div class="relative">
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            x-model="showOther"
            x-on:change="showOther = $event.target.value === 'Other'"
            class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm"
        >
            <option value="">Select an IB Subject</option>
            <option value="Biology">Biology</option>
<option value="Business Management">Business Management</option>
<option value="Chemistry">Chemistry</option>
<option value="Classical Languages">Classical Languages</option>
<option value="Computer Science">Computer Science</option>
<option value="Dance">Dance</option>
<option value="Design Technology">Design Technology</option>
<option value="Digital Societies">Digital Societies</option>
<option value="Economics">Economics</option>
<option value="Environmental Systems and Societies">Environmental Systems and Societies</option>
<option value="Film">Film</option>
<option value="Further Mathematics">Further Mathematics</option>
<option value="Geography">Geography</option>
<option value="Global Politics">Global Politics</option>
<option value="History">History</option>
<option value="Information Technology in a Global Society">Information Technology in a Global Society</option>
<option value="Language A (English): Literature">Language A (English): Literature</option>
<option value="Language A (English): Language and Literature">Language A (English): Language and Literature</option>
<option value="Language A (French): Literature">Language A (French): Literature</option>
<option value="Language A (French): Language and Literature">Language A (French): Language and Literature</option>
<option value="Language A (Portuguese): Literature">Language A (Portuguese): Literature</option>
<option value="Language A (Portuguese): Language and Literature">Language A (Portuguese): Language and Literature</option>
<option value="Language B">Language B</option>
<option value="Language ab initio">Language ab initio</option>
<option value="Literature and Performance">Literature and Performance</option>
<option value="Mandarin">Mandarin</option>
<option value="Mathematical Studies">Mathematical Studies</option>
<option value="Mathematics">Mathematics</option>
<option value="Mathematics: Analysis and Approaches">Mathematics: Analysis and Approaches</option>
<option value="Mathematics: Applications and Interpretation">Mathematics: Applications and Interpretation</option>
<option value="Music">Music</option>
<option value="Philosophy">Philosophy</option>
<option value="Physics">Physics</option>
<option value="Psychology">Psychology</option>
<option value="Social and Cultural Anthropology">Social and Cultural Anthropology</option>
<option value="Sports, Exercise and Health Science">Sports, Exercise and Health Science</option>
<option value="Theatre">Theatre</option>
<option value="World Religions">World Religions</option>
<option value="Visual Arts">Visual Arts</option>
<option value="Other">Other</option>
        </select>
    </div>
    <div x-show="showOther" class="mt-2">
        <input
        type="text"
        id="{{ $name }}_other"
        name="{{ $name }}_other"
        value="{{ $saved == 'Other' ? old($name . '_other') : '' }}"
        class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm"
        placeholder="If you selected 'Other', enter the IB Subject"
        >
    </div>
</div>