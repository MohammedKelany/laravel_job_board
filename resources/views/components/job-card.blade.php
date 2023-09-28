<x-card class="mb-4 pt-4 pb-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">{{ $job->title }}</h1>
        <h1 class="text-slate-500 text-sm font-bold">${{ number_format($job->salary) }}</h1>
    </div>
    <div class="flex justify-between items-center mb-4">
        <div class="flex space-x-2">
            <p class="text-slate-400 text-sm">{{ $job->employer->company_name }}: </p>
            <p class="text-slate-400 text-sm">{!! e($job->location) !!}</p>
        </div>
        <div class="flex space-x-2">
            <x-tag :href="route('jobs.index', ['experience' => $job->experience])">{{ Str::ucfirst($job->experience) }} </x-tag>
            <x-tag :href="route('jobs.index', ['category' => $job->category])">{{ $job->category }}</x-tag>
        </div>
    </div>
    {{ $slot }}

</x-card>
