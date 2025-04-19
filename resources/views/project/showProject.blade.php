<x-layout>

    <div class="flex flex-row items-center justify-between gap-x-4 bg-white p-6 rounded shadow max-w-4xl">
        <h2>{{ $project->name }}</h2>

        <div class="flex gap-x-8">
            <button class="btn-green">Generate invoice</button>
            <button class="btn">Delete Project</button>
        </div>

    </div>

    <div class="border-2 border-dashed bg-white px-4 pb-4 my-4 rounded">
        <div class="flex flex-row justify-between">
            <h3>Project Information</h3>
            <button class="btn-green mt-4">Edit Project Details</button>
        </div>

        <p><strong>rate/hour: </strong>RM {{ $project->rate_per_hour }}</p>
        <p><strong>hours worked on this project: </strong>{{ $project->total_hours }} Hours</p>
        <hr>
        <p><strong>About the Project:</strong></p>
        <p>{{ $project->description }}</p>
    </div>

    {{-- <h2>Ongoing Projects</h2>

    <ul>
        @foreach ($projects as $project)
            <li>
                <x-card href="{{ route('show.client', $client->id) }}">
                    <div>
                        <h3>{{ $project->name }}</h3>
                        <p>{{ $project->company }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul> --}}

</x-layout>
