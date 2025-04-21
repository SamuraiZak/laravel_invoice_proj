<x-layout>

    <div class="flex flex-row items-center justify-between gap-x-4 bg-white p-6 rounded shadow max-w-4xl">
        <h2>{{ $project->name }}</h2>

        @if($editing ?? false)
        @else
        <div class="flex gap-x-8">
            <button class="btn-green">Generate invoice</button>
             <a
                href="{{ route('delete.project', $project) }}"
                class="inline-flex items-center justify-center px-4 py-2 rounded bg-red-500 text-white border-2 border-red-500 hover:bg-red-100 hover:text-black"
            >Delete Project</a>
        </div>
        
        @endif
        


        {{-- Popup to ask sure delete or not --}}
        @if ($deleting ?? false)
            <div class="fixed inset-0 bg-black/50 flex justify-center items-center z-50">
                <form
                    action="{{ route('destroy.project', $project) }}"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')
                    <div class="rounded-lg border border-black bg-white p-4 h-1/4 pt-10">
                        <h2 class="text-black">Are you sure you want to delete this Client?</h1>
                            <div class="flex justify-around pt-5">
                                <button
                                    type="submit"
                                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                                >Delete</button>

                                <a
                                    href="{{ route('show.project', $project) }}"
                                    class="inline-flex items-center justify-center px-4 py-2 rounded bg-gray-500 text-white border-2 border-gray-500 hover:bg-green-100 hover:text-black"
                                >Cancel</a>
                            </div>
                    </div>
                </form>

            </div>
        @endif

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
