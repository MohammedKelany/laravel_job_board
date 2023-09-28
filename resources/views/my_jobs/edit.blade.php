<x-layout>
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-300 rounded-md my-4 p-4">
            <h1 class="text-green-700 text-xl font-bold mb-4">Success</h1>
            <h1 class="text-green-700">{{ session('success') }}</h1>
        </div>
    @endif
    <x-navigator class="mb-4" :links="[
        'Home' => '/',
        'My Jobs' => route('my-jobs.index'),
        'Edit Job' => route('my-jobs.edit', ['my_job' => $my_job]),
    ]" />
    <form id="update-job" class="px-10 pt-10 bg-white mb-4 rounded-md" action="{{ route('my-jobs.update', $my_job) }}"
        method="POST">
        @method('PUT')
        @csrf
        <div class="mb-4 flex space-x-2">
            <div class="w-full">
                <label class="text-lg mb-4 font-semibold">Job Title*</label>
                <x-input-field form-id="update-job" name="title" value="{{ old('title') ?? $my_job->title }}"
                    placeholder="Title" />
            </div>
            <div class="w-full">
                <label class="text-lg font-semibold">Location*</label>
                <x-input-field form-id="update-job" name="location" value="{{ old('location') ?? $my_job->location }}"
                    placeholder="location" />
            </div>
        </div>
        <div>
            <div class="mb-2">
                <label class="text-lg font-semibold">Salary*</label>
            </div>
            <x-input-field form-id="update-job" name="salary" value="{{ old('salary') ?? $my_job->salary }}"
                placeholder="Salary" />
        </div>
        <div class="mt-4">
            <div class="mb-2">
                <label class="text-lg font-semibold">Description*</label>
            </div>
            <x-input-field form-id="update-job" name="description"
                value="{{ old('description') ?? $my_job->description }}" placeholder="Description" />
        </div>
        <div class="grid grid-cols-2 gap-4 mt-4 mb-8">
            <x-ratio-container :value="old('experience') ?? $my_job->experience" name="experience" :options="\App\Models\Job::$experience">
            </x-ratio-container>
            <x-ratio-container :value="old('category') ?? $my_job->category" name="category" :options="\App\Models\Job::$category">
            </x-ratio-container>
        </div>
        <x-button type="submit" value="Update Job" />
    </form>
</x-layout>
