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
        <h2>All Outstanding Invoices</h2>

    </div>

    </div>

    @if ($deletingInvoice ?? false)
        <div class="fixed inset-0 bg-black/50 flex justify-center items-center z-50">
            <form
                action="{{ route('destroyInvoice.dashboard', $invoice) }}"
                method="POST"
            >
                @csrf
                @method('DELETE')
                <div class="rounded-lg border border-black bg-white p-4 h-1/4 pt-10">
                    <h2 class="text-black">Are you sure you want to delete this Invoice?</h1>
                        <div class="flex justify-around pt-5">
                            <button
                                type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                            >Delete</button>

                            <a
                                href="{{ route('show.dashboardInvoices') }}"
                                class="inline-flex items-center justify-center px-4 py-2 rounded bg-gray-500 text-white border-2 border-gray-500 hover:bg-green-100 hover:text-black"
                            >Cancel</a>
                        </div>
                </div>
            </form>

        </div>
    @endif
    <ul>
        @foreach ($outStandingInvoices as $outStandingInvoice)
            <li>
                <x-invoiceCard
                    :isPaid="$outStandingInvoice->isPaid"
                    :hrefDownloadInvoice="route('invoice_download', $outStandingInvoice)"
                    :hrefMark="$outStandingInvoice->isPaid
                        ? route('markInvoiceAsUnpaid.dashboard', $outStandingInvoice)
                        : route('markInvoiceAsPaid.dashboard', $outStandingInvoice)"
                    :hrefDelete="route('deleteInvoice.dashboard', $outStandingInvoice)"
                >
                    <div>
                        <h3 class="text-green-700">${{ number_format($outStandingInvoice->total, 2)}}</h3>
                        <p>{{ $outStandingInvoice->project->client->name }}</p>
                        <p>{{ $outStandingInvoice->project->client->company }}</p>
                    </div>
                </x-invoiceCard>
            </li>
        @endforeach
    </ul>
    {{ $outStandingInvoices->links() }}
</x-layout>
