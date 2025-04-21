<x-layout>

    <div class="fixed inset-0 bg-black/50 flex justify-center items-center z-50">
        <form
            action="{{ route('destroy.invoice', $invoice) }}"
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
                            href="{{ route('show.project', $project) }}"
                            class="inline-flex items-center justify-center px-4 py-2 rounded bg-gray-500 text-white border-2 border-gray-500 hover:bg-green-100 hover:text-black"
                        >Cancel</a>
                    </div>
            </div>
        </form>

    </div>

</x-layout>
