<x-layout>
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-300 rounded-md my-4 p-4">
            <h1 class="text-green-700 text-xl font-bold mb-4">Success</h1>
            <h1 class="text-green-700">{{ session('success') }}</h1>
        </div>
    @endif
    <x-navigator class="mb-4" :links="['Home' => '/', 'My Jobs' => route('my-jobs.index')]" />
    <div class="flex justify-end mb-6">
        <x-link-button :href="route('my-jobs.create')">
            Add New
        </x-link-button>
    </div>

    @forelse ($jobs as $job)
        <x-job-card :job="$job">
            @forelse ($job->jobApplications as $application)
                <div>
                    <div>
                        <div class="flex justify-between">
                            <div class="text-slate-500">
                                <h1>
                                    {{ $application->user->name }}
                                </h1>
                                <h1>
                                    Applied {{ $application->created_at->diffForHumans() }}
                                </h1>
                                <h1>
                                    <a href="{{ Storage::url($application->cv) }}">
                                        Download Cv
                                    </a>
                                </h1>
                            </div>
                            <div class="my-auto font-semibold text-slate-400">
                                ${{ number_format($application->expected_salary) }}
                            </div>
                        </div>
                        <div class="text-slate-500 flex items-center justify-end">
                            <form id="cancel-form"
                                action="{{ route('my-jobs-applicaions.destroy', ['my_jobs_applicaion' => $application]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="p-2 shadow-sm rounded-md font-semibold hover:bg-slate-200"
                                    type="submit">Cancel</button>
                            </form>
                        </div>
                    </div>

                    <div class="text-slate-500 flex items-center justify-center space-x-4">
                        <form id="update-form" action="{{ route('my-jobs.edit', ['my_job' => $job]) }}" method="GET">
                            @csrf
                            <button class="p-2 shadow-sm rounded-md font-semibold hover:bg-slate-200"
                                type="submit">Edit
                                This Job </button>
                        </form>
                        <form id="delete-form" action="{{ route('my-jobs.destroy', ['my_job' => $job]) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="p-2 shadow-sm rounded-md font-semibold hover:bg-slate-200"
                                type="submit">Delete
                                This Job </button>
                        </form>
                    </div>
                </div>
            @empty
                <h1 class="text-2xl my-7 flex justify-center">No job Applications yet!</h1>
                <div class="text-slate-500 flex items-center justify-center space-x-4">
                    <form id="update-form" action="{{ route('my-jobs.edit', ['my_job' => $job]) }}" method="GET">
                        @csrf
                        <button class="p-2 shadow-sm rounded-md font-semibold hover:bg-slate-200" type="submit">Edit
                            This Job </button>
                    </form>
                    <form id="delete-form" action="{{ route('my-jobs.destroy', ['my_job' => $job]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="p-2 shadow-sm rounded-md font-semibold hover:bg-slate-200" type="submit">Delete
                            This Job </button>
                    </form>
                </div>
            @endforelse
        </x-job-card>
    @empty
        <div class="text-center p-10 rounded-md border-slate-200 border-2">
            <div>
                <h1 class="text-2xl mb-2">No job yet!</h1>
            </div>
            <div>
                <h1 class="inline text-xl">Post Your first Job </h1>
                <a class="text-blue-400 text-xl" href="{{ route('jobs.index') }}">here!</a>
            </div>
        </div>
    @endforelse
</x-layout>
