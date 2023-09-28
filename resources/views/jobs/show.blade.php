<x-layout>
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-300 rounded-md my-4 p-4">
            <h1 class="text-green-700 text-xl font-bold mb-4">Success</h1>
            <h1 class="text-green-700">{{ session('success') }}</h1>
        </div>
    @endif
    <x-navigator class="mb-4" :$job :links="['Home' => '/', 'Jobs' => route('jobs.index'), $job->title => route('jobs.show', $job)]" />
    <x-job-card :$job>
        <p class="text-slate-400 text-sm mb-4">{!! nl2br(e($job->description)) !!}</p>
        @auth
            <x-link-button :href="route('jobs.applications.create', $job)">
                Apply
            </x-link-button>
        @endauth
    </x-job-card>
    <x-card class="mt-4">
        <h1 class="text-xl font-semibold mb-4">More {{ $job->employer->company_name }}</h1>
        @foreach ($job->employer->jobs as $job)
            <a href="{{ route('jobs.show', ['job' => $job]) }}">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h1 class="text-lg font-bold">{{ $job->title }}</h1>
                        <h1 class="text-slate-500">{{ $job->created_at->diffForHumans() }}</h1>
                    </div>
                    <h1 class="text-slate-500 text-sm font-bold">${{ number_format($job->salary) }}</h1>
                </div>
            </a>
        @endforeach
    </x-card>
</x-layout>
