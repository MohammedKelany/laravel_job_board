<x-layout>
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-300 rounded-md my-4 p-4">
            <h1 class="text-green-700 text-xl font-bold mb-4">Success</h1>
            <h1 class="text-green-700">{{ session('success') }}</h1>
        </div>
    @endif
    <x-navigator class="mb-4" :links="['Home' => '/', 'My Jobs' => route('my-jobs.index'), 'Create Job' => route('my-jobs.create')]" />
    <form id="create-job" class="px-10 pt-10 bg-white mb-4 rounded-md" action="{{ route('my-jobs.store') }}" method="POST">
        @csrf
        <div class="mb-4 flex space-x-2">
            <div class="w-full">
                <label class="text-lg mb-4 font-semibold">Job Title*</label>
                <x-input-field form-id="create-job" name="title" value="{{ old('title') }}" placeholder="Title" />
            </div>
            <div class="w-full">
                <label class="text-lg font-semibold">Location*</label>
                <x-input-field form-id="create-job" name="location" value="{{ old('location') }}"
                    placeholder="location" />
            </div>
        </div>
        <div>
            <div class="mb-2">
                <label class="text-lg font-semibold">Salary*</label>
            </div>
            <x-input-field form-id="create-job" name="salary" value="{{ old('salary') }}" placeholder="Salary" />
        </div>
        <div class="mt-4">
            <div class="mb-2">
                <label class="text-lg font-semibold">Description*</label>
            </div>
            <x-input-field form-id="create-job" name="description" value="{{ old('description') }}"
                placeholder="Description" />
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4 mb-8">
            <x-ratio-container :value="old('experience')" name="experience" :options="\App\Models\Job::$experience">
            </x-ratio-container>
            <x-ratio-container :value="old('category')" name="category" :options="\App\Models\Job::$category">
            </x-ratio-container>
        </div>
        <x-button type="submit" value="Create Job" />
    </form>
</x-layout>
