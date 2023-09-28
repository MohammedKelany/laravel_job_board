<x-layout>
    <x-navigator class="mb-4" :links="['Home' => '/', 'Jobs' => route('jobs.index')]" />
    <form id="filter" class="px-10 pt-10 bg-white mb-4 rounded-md" action="{{ route('jobs.index') }}" method="GET">
        <div class="pb-4 grid grid-cols-2 gap-6 rounded-md">
            <div>
                <div class="mb-4">
                    <label class="text-lg">Search</label>
                </div>
                <x-input-field form-id="filter" name="search" value="{{ request('search') }}" placeholder="Search" />
            </div>
            <div>
                <div class="mb-4">
                    <label class="text-lg ">Salary</label>
                </div>
                <div class="flex space-x-2">
                    <x-input-field form-id="filter" name="from" value="{{ request('from') }}" placeholder="From" />
                    <x-input-field form-id="filter" name="to" value="{{ request('to') }}" placeholder="To" />
                </div>
            </div>
            <x-ratio-container name="experience" :options="\App\Models\Job::$experience">
                <div class="flex items-center space-x-2">
                    <input type="radio" name="experience" value="" checked>
                    <p>All</p>
                </div>
            </x-ratio-container>

            <x-ratio-container name="category" :options="\App\Models\Job::$category">
                <div class="flex items-center space-x-2">
                    <input type="radio" name="category" value="" checked>
                    <p>All</p>
                </div>
            </x-ratio-container>
        </div>
        <x-button type="submit" value="Filter" />
    </form>
    @foreach ($jobs as $job)
        <x-job-card class="mb-4 pt-4 pb-4" :$job>
            <x-link-button :href="route('jobs.show', $job)">
                Show
            </x-link-button>
        </x-job-card>
    @endforeach
</x-layout>
