<x-layout>

<div x-data="{ open: false }">
    <!-- Trigger Button -->
    <button 
        class="bg-green-500 text-white px-4 py-2 rounded"
        @click="open = true"
    >
        Open Modal
    </button>

    <!-- Modal -->
    <div 
        x-show="open"
        x-transition
        class="fixed inset-0 bg-black/50 flex justify-center items-center z-50"
    >
        <div 
            {{-- @click.away="open = false" --}}
            class="bg-white p-6 rounded shadow-lg w-[90%] md:w-[30%] relative"
        >
            <h2 class="text-xl font-bold mb-4">Modal Title</h2>
            <p>This is the content of the modal.</p>

            <button 
                class="mt-6 bg-red-500 text-white px-4 py-2 rounded"
                @click="open = false"
            >
                Close
            </button>
        </div>
    </div>
</div>

</x-layout>
