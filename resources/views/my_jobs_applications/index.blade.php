<x-layout>
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-300 rounded-md my-4 p-4">
            <h1 class="text-green-700 text-xl font-bold mb-4">Success</h1>
            <h1 class="text-green-700">{{ session('success') }}</h1>
        </div>
    @endif
    <x-navigator class="mb-4" :links="[
        'Home' => '/',
        'My Job Applications' => route('my-jobs-applicaions.index'),
    ]" />

    @forelse ($applications as $application)
        <x-job-card :job="$application->job">
            <div class="flex justify-between">
                <div class="text-slate-500">
                    <h1>
                        Applied {{ $application->created_at->diffForHumans() }}
                    </h1>
                    <h1>
                        Other Applicant {{ $application->job->job_applications_count }}
                    </h1>
                    <h1>
                        Your Expected Salary :{{ number_format($application->expected_salary) }}
                    </h1>
                    <h1>
                        Avarage Asked Salary
                        :{{ number_format($application->job->job_applications_avg_expected_salary) }}
                    </h1>
                    <h1>
                        Applied {{ $application->created_at->diffForHumans() }}
                    </h1>
                </div>
                <div class="text-slate-500 flex items-center">
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
        </x-job-card>
    @empty
        <div class="text-center p-10 rounded-md border-slate-200 border-2">
            <div>
                <h1 class="text-2xl mb-2">No job Applications yet!</h1>
            </div>
            <div>
                <h1 class="inline text-xl">Go find some jobs </h1>
                <a class="text-blue-400 text-xl" href="{{ route('jobs.index') }}">here!</a>
            </div>
        </div>
    @endforelse
</x-layout>
