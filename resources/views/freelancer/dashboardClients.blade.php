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

        <!-- Modal Shenanigans -->
        <div x-data="{
            open: false,
            errors: @js($errors->all()),
            show() {
                console.log(this.errors.length)
                this.open = true;
            },
            cancel() {
                console.log(this.errors.length)
                this.open = false;
                this.errors = [];
            },
            submitAttempt(event) {
                console.log(this.errors.length);
                if (this.errors.length > 0) {
                    this.open = true
                } else {
                    this.open = false;
                }
            }
        }">
            <button
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-blue-400 hover:text-black"
                @click="show()"
            >
                Add New Client
            </button>

            <div
                x-show="open"
                x-transition
                class="fixed inset-0 bg-black/50 flex justify-center items-center z-50"
            >
                <div
                    id="modal-form"
                    class="bg-white p-6 rounded-b-lg border-4 shadow-lg w-[90%] md:w-[30%] relative border-green-500 overflow-y-auto h-[90%]"
                >
                    <h2 class="text-xl font-bold mb-4">Please fill in client data</h2>
                    <form
                        action="{{ route('store.client') }}"
                        method="POST"
                    >
                        @csrf

                        <label for="name">Name:</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                        >

                        <label for="email">Email:</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                        >

                        <label for="phone">Contact Number:</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                        >

                        <label for="company">Company:</label>
                        <input
                            type="text"
                            id="company"
                            name="company"
                            value="{{ old('company') }}"
                            required
                        >

                        <label for="address">Address:</label>
                        <textarea
                            rows="5"
                            id="address"
                            name="address"
                            required
                        >{{ old('address') }}</textarea>

                        <ul
                            x-show="errors.length > 0"
                            class="px-4 py-2 bg-red-100"
                        >
                            <template
                                x-for="(error, index) in errors"
                                :key="index"
                            >
                                <li
                                    class="my-2 text-red-500"
                                    x-text="error"
                                ></li>
                            </template>
                        </ul>

                        <div></div>

                        <div class="flex justify-between">
                            <button
                                type="button"
                                class="mt-6 bg-gray-100 text-black px-4 py-2 rounded hover:bg-red-500"
                                @click="cancel()"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="mt-6 bg-gray-100 text-black px-4 py-2 rounded hover:bg-green-500"
                                @click="submitAttempt()"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Modal Shenanigans End -->

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
