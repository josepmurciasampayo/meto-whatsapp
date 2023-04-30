@props(['name', 'label', 'saved' => '', 'req' => false])

<div>
    @php $required = ($req) ? "*" : ""  @endphp
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
    <div class="relative">
        @php $required = ($req) ? "required" : ""  @endphp
        <select id="{{ $name }}" name="{{ $name }}" {{ $required }}
            class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm">
            <option value="">Select a Grade</option>
            <option value="A" {{ $saved == 'A' ? 'selected' : '' }}>A</option>
            <option value="A-" {{ $saved == 'A-' ? 'selected' : '' }}>A-</option>
            <option value="B+" {{ $saved == 'B+' ? 'selected' : '' }}>B+</option>
            <option value="B" {{ $saved == 'B' ? 'selected' : '' }}>B</option>
            <option value="B-" {{ $saved == 'B-' ? 'selected' : '' }}>B-</option>
            <option value="C+" {{ $saved == 'C+' ? 'selected' : '' }}>C+</option>
            <option value="C" {{ $saved == 'C' ? 'selected' : '' }}>C</option>
            <option value="C-" {{ $saved == 'C-' ? 'selected' :'' }}>C-</option>
            <option value="D+" {{ $saved == 'D+' ? 'selected' : '' }}>D+</option>
            <option value="D" {{ $saved == 'D' ? 'selected' : '' }}>D</option>
            <option value="D-" {{ $saved == 'D-' ? 'selected' : '' }}>D-</option>
            <option value="E" {{ $saved == 'E' ? 'selected' : '' }}>E</option>
            <option value="F" {{ $saved == 'F' ? 'selected' : '' }}>F</option>
        </select>
    </div>
</div>
