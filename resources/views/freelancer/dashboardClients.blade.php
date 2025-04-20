<x-layout>

    <div class="flex flex-row items-center gap-x-4 bg-white p-6 rounded shadow max-w-4xl">
        <h2 class="text-lg font-extrabold text-gray-700">Monthly Income :</h2>
        <p class="text-6xl font-semibold text-green-500">$200</p>
    </div>
    <div class="container mx-auto px-4 py-8">

        <div class="flex flex-row gap-x-12 justify-between">

            <div class="flex-1 bg-white p-6 rounded shadow border-b-4 border-lime-500 group hover:bg-green-300">
                <h2 class="text-lg text-center font-semibold text-gray-700 group-hover:text-white">Clients</h2>
                <p class="text-2xl text-center text-blue-500 mt-2 group-hover:text-white">50</p>
            </div>

            <div class="flex-1 bg-white p-6 rounded shadow border-b-4 border-lime-500 group hover:bg-green-300">
                <h2 class="text-lg text-center font-semibold text-gray-700 group-hover:text-white">Projects</h2>
                <p class="text-2xl text-center text-purple-500 mt-2 group-hover:text-white">30</p>
            </div>

            <div class="flex-1 bg-white p-6 rounded shadow border-b-4 border-lime-500 group hover:bg-green-300">
                <h2 class="text-lg text-center font-semibold text-gray-700 group-hover:text-white">Outstanding Invoices
                </h2>
                <p class="text-2xl text-center text-red-500 mt-2 group-hover:text-white">12</p>
            </div>
        </div>
    </div>

    <div class="flex justify-between mt-10">
        <h2>All Clients</h2>

        <a
            href="{{ route('create.client') }}"
            class="bg-green-500 text-white px-4 pt-4 rounded hover:bg-blue-400 hover:text-black"
        > Add New Client</a>

    </div>

    </div>

    <ul>
        @foreach ($clients as $client)
            <li>
                <x-card href="{{ route('show.client', $client->id) }}">
                    <div>
                        <h3>{{ $client->name }}</h3>
                        <p>{{ $client->company }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>

    {{ $clients->links() }}
</x-layout>
