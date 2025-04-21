<x-layout>

    <div class="flex flex-row items-center justify-between gap-x-4 bg-white p-6 rounded shadow max-w-4xl">
        <h2>{{ $project->name }}</h2>

        @if ($editing ?? false)
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
                        <h2 class="text-black">Are you sure you want to delete this Project?</h1>
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

    @if ($editing ?? false)
        <div class="border-2 border-dashed bg-white px-4 pb-4 my-4 rounded">
            <form
                action="{{ route('update.project', $project) }}"
                method="POST"
                class="flex flex-row justify-between relative px-4 pt-20"
            >
                @method('PUT')
                @csrf
                <div class="w-3/4">

                    @if ($errors->any())
                        <ul class="px-4 py-2 bg-red-100">
                            @foreach ($errors->all() as $error)
                                <li class="my-2 text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="flex items-center gap-4 mb-4">
                        <label
                            for="name"
                            class="w-32"
                        >Project Name:</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ $project->name }}"
                            class="flex-1 border px-2 py-1"
                            required
                        >
                    </div>

                    <div class="flex items-center gap-4 mb-4">
                        <label
                            for="rate_per_hour"
                            class="w-32"
                        >Rate/Hour:</label>
                        <input
                            type="number"
                            step=".01"
                            id="rate_per_hour"
                            name="rate_per_hour"
                            value="{{ $project->rate_per_hour }}"
                            class="flex-1 border px-2 py-1"
                            required
                        >
                    </div>

                    <div class="flex items-center gap-4 mb-4">
                        <label
                            for="total_hours"
                            class="w-32"
                        >total_hours:</label>
                        <input
                            type="number"
                            step=".01"
                            id="total_hours"
                            name="total_hours"
                            value="{{ $project->total_hours }}"
                            class="flex-1 border px-2 py-1"
                        >
                    </div>

                    <div class="flex items-start gap-4 mb-4">
                        <label
                            for="description"
                            class="w-32 pt-1"
                        >Project Description:</label>
                        <textarea
                            rows="5"
                            id="description"
                            name="description"
                            class="flex-1 border px-2 py-1"
                            required
                        >{{ $project->description }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end gap-2 absolute top-0 right-0 mt-4 ml-20 w-1/4">
                    <button
                        type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                    >
                        Save
                    </button>
                    <a
                        href="{{ route('show.project', $project->id) }}"
                        class="inline-flex items-center justify-center px-4 py-2 rounded bg-red-500 text-white border-2 border-red-500 hover:bg-red-100 hover:text-black"
                    >Cancel</a>
                </div>
            </form>
        </div>
    @else
        <div class="border-2 border-dashed bg-white px-4 pb-4 my-4 rounded">
            <div class="flex flex-row justify-between">
                <h3>Project Information</h3>
                <a
                    href="{{ route('edit.project', $project) }}"
                    class="mt-6 bg-gray-100 text-black px-4 py-2 rounded border-2 hover:bg-green-500"
                >Edit Project</a>
            </div>

            <p><strong>rate/hour: </strong>RM {{ $project->rate_per_hour }}</p>
            <p><strong>hours worked on this project: </strong>{{ $project->total_hours }} Hours</p>
            <hr>
            <p><strong>About the Project:</strong></p>
            <p>{{ $project->description }}</p>
        </div>
    @endif

    {{-- <h2>Invoices</h2>

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
