<x-layout>
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-300 rounded-md my-4 p-4">
            <h1 class="text-red-700 text-xl font-bold mb-4">Error</h1>
            <h1 class="text-red-700">{{ session('error') }}</h1>
        </div>
    @endif
    <x-navigator class="mb-4" :links="['Home' => '/', 'Jobs' => route('jobs.index')]" />
    <x-card>
        <h1 class="text-xl font-bold mb-4">Register as Employer</h1>
        <form id="employer-form" action="{{ route('employers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-8">
                <x-input-label class="text-lg ml-2 mb-2 font-semibold">
                    Company Name:
                </x-input-label>
                <x-input-field form-id="employer-form" name="company_name" value="{{ old('company_name') }}"
                    placeholder="Company Name" />
                @error('company_name')
                    <div class="mt-2 text-red-500">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <x-button type="submit" value="Create" />
        </form>
    </x-card>
</x-layout>
