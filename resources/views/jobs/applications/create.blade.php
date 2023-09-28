<x-layout>
    <x-navigator class="mb-4" :links="[
        'Home' => '/',
        'Jobs' => route('jobs.index'),
        $job->title => route('jobs.show', $job),
        'Application Create' => route('jobs.applications.create', $job),
    ]" />
    <x-job-card class="mb-4 pt-4 pb-4" :$job />
    <x-card>
        <h1 class="text-xl font-bold mb-4">Your Job Application</h1>
        <form id="apply-form" action="{{ route('jobs.applications.store', ['job' => $job]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-8">
                <x-input-label class="text-lg ml-2 mb-2 font-semibold">
                    Expected Salary
                </x-input-label>
                <x-input-field form-id="apply-form" name="expected_salary" value="{{ old('expected_salary') }}"
                    placeholder="Expected Salary" />
                @error('expected_salary')
                    <div class="mt-2 text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-8">
                <x-input-label class="text-lg ml-2 mb-2 font-semibold">
                    CV
                </x-input-label>
                <x-input-field name="cv" value="CV" type="file" placeholder="CV" />
                @error('cv')
                    <div class="mt-2 text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <x-button type="submit" value="Apply" />
        </form>
    </x-card>
</x-layout>
