<x-layout>

    <div class="flex flex-row items-center gap-x-4 bg-white p-6 rounded shadow max-w-4xl">
        <h2 class="text-lg font-extrabold text-gray-700">Monthly Income :</h2>
        <p class="text-6xl font-semibold text-green-500">$ {{ number_format($monthlyIncome, 2) }}</p>
    </div>
    <div class="container mx-auto px-4 py-8">

        <div class="flex flex-row gap-x-12 justify-between">

            <a
                href="{{ route('show.dashboard') }}"
                class="flex-1"
            >
                <div class="h-full bg-white p-6 rounded shadow border-b-4 border-lime-500 group hover:bg-green-300">
                    <h2 class="text-lg text-center font-semibold text-gray-700 group-hover:text-white">Clients</h2>
                    <p class="text-2xl text-center text-blue-500 mt-2 group-hover:text-white">{{ $numberOfClients }}</p>
                </div>
            </a>
            <a
                href="{{ route('show.dashboardProjects') }}"
                class="flex-1"
            >
                <div class="h-full bg-white p-6 rounded shadow border-b-4 border-lime-500 group hover:bg-green-300">
                    <h2 class="text-lg text-center font-semibold text-gray-700 group-hover:text-white">Projects</h2>
                    <p class="text-2xl text-center text-purple-500 mt-2 group-hover:text-white">{{ $projectCount }}</p>
                </div>
            </a>
            <a
                href="{{ route('show.dashboardInvoices') }}"
                class="flex-1"
            >
                <div class="h-full bg-white p-6 rounded shadow border-b-4 border-lime-500 group hover:bg-green-300">
                    <h2 class="text-lg text-center font-semibold text-gray-700 group-hover:text-white">Outstanding
                        Invoices</h2>
                    <p class="text-2xl text-center text-red-500 mt-2 group-hover:text-white">
                        {{ $outstandingInvoiceCount }}</p>
                </div>
            </a>
        </div>
    </div>

    <div class="flex justify-between mt-10">
        <h2>All Projects</h2>

    </div>

    </div>

    <ul>
        @foreach ($projects as $project)
            <li>
                <x-card href="{{ route('show.project', $project->id) }}">
                    <div>
                        <h3>{{ $project->name }}</h3>
                        <p>{{ $project->client->name }}</p>
                        <p>{{ $project->client->company }}</p>
                    </div>
                </x-card>
            </li>
        @endforeach
    </ul>

    {{-- down here is related to paginating --}}
    {{ $projects->links() }}
</x-layout>
