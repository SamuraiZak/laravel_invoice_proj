<x-layout>

    <div class="flex flex-row items-center justify-between gap-x-4 bg-white p-6 rounded shadow max-w-6xl">
        <h2>Client Name: {{ $client->name }}</h2>

        @if ($editing ?? false)
        @else
            <a
                href="{{ route('delete.client', $client) }}"
                class="inline-flex items-center justify-center px-4 py-2 rounded bg-red-500 text-white border-2 border-red-500 hover:bg-red-100 hover:text-black"
            >Delete Client</a>
        @endif

        {{-- Popup to ask sure delete or not --}}
        @if ($deleting ?? false)
            <div class="fixed inset-0 bg-black/50 flex justify-center items-center z-50">
                <form
                    action="{{ route('destroy.client', $client) }}"
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
                                        href="{{ route('show.client', $client) }}"
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
                action="{{ route('update.client', $client) }}"
                method="POST"
                class="flex flex-row justify-between relative px-4 pt-20"
            >
                @method('put')
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
                            for="email"
                            class="w-32"
                        >Email:</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ $client->email }}"
                            class="flex-1 border px-2 py-1"
                            required
                        >
                    </div>

                    <div class="flex items-center gap-4 mb-4">
                        <label
                            for="phone"
                            class="w-32"
                        >Contact Number:</label>
                        <input
                            type="number"
                            id="phone"
                            name="phone"
                            value="{{ $client->phone }}"
                            class="flex-1 border px-2 py-1"
                            required
                        >
                    </div>

                    <div class="flex items-center gap-4 mb-4">
                        <label
                            for="company"
                            class="w-32"
                        >Company:</label>
                        <input
                            type="text"
                            id="company"
                            name="company"
                            value="{{ $client->company }}"
                            class="flex-1 border px-2 py-1"
                            required
                        >
                    </div>

                    <div class="flex items-start gap-4 mb-4">
                        <label
                            for="address"
                            class="w-32 pt-1"
                        >Address:</label>
                        <textarea
                            rows="5"
                            id="address"
                            name="address"
                            class="flex-1 border px-2 py-1"
                            required
                        >{{ $client->address }}</textarea>
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
                        href="{{ route('show.client', $client->id) }}"
                        class="inline-flex items-center justify-center px-4 py-2 rounded bg-red-500 text-white border-2 border-red-500 hover:bg-red-100 hover:text-black"
                    >Cancel</a>
                </div>
            </form>
        </div>
    @else
        <div class="border-2 border-dashed bg-white px-4 pb-4 my-4 rounded">
            <div class="flex flex-row justify-between">
                <h3>Client Information</h3>
                <a
                    href="{{ route('edit.client', $client) }}"
                    class="mt-6 bg-gray-100 text-black px-4 py-2 rounded border-2 hover:bg-green-500"
                >Edit</a>
            </div>

            <p><strong>Email: </strong>{{ $client->email }}</p>
            <p><strong>phone: </strong>{{ $client->phone }}</p>
            <p><strong>Company: </strong>{{ $client->company }}</p>
            <p><strong>Address: </strong>{{ $client->address }}</p>
        </div>
    @endif

    <div class="flex justify-between pt-10">
        <h2>Ongoing Projects</h2>
        <button
            class="border-2 border-y-gray-600  rounded px-3 py-2 bg-green-200 hover:bg-green-500 hover:text-black;">Add
            a
            project</button>
    </div>

    <ul>
        @foreach ($client->project as $project)
            <li>
                <x-card href="{{ route('show.project', $project->id) }}">
                    <div>
                        <h3>{{ $project->name }}</h3>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>

</x-layout>
