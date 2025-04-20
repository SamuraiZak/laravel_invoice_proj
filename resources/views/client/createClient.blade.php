<x-layout>
    <form
        action="{{ route('store.client') }}"
        method="POST"
    >
        @csrf

        <!-- validation errors -->
        @if ($errors->any())
            <ul class="px-4 py2 bg-red-100">
                @foreach ($errors->all() as $error)
                    <li class="my-2 text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="flex justify-end gap-10">
            <button
                type="submit"
                class="mt-6 bg-gray-100 text-black px-4 py-2 rounded border-green-500 border-2 hover:bg-green-500"
            >
                Save
            </button>
            <a
                href="{{ route('show.dashboard') }}"
                class="mt-6 bg-gray-100 text-black px-4 py-2 rounded border-red-500 border-2 hover:bg-red-500"
            >
                Cancel
            </a>
        </div>

        <br>
        <br>
        <hr>
        <br>
        <br>

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
            type="number"
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

    </form>
</x-layout>
