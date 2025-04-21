@props(['isPaid' => false, 'hrefMark', 'hrefDelete'])

<div @class([
    'bg-green-100 rounded border border-gray-200 px-3 py-3 my-2 flex justify-between items-center' => $isPaid,
    'bg-red-100 rounded border border-gray-200 px-3 py-3 my-2 flex justify-between items-center' => !$isPaid,
])>
    <div>{{ $slot }}</div>
    <div class="flex gap-5">
        <form
            action="{{ $hrefMark }}"
            method="POST"
            class="inline"
        >
            @csrf
            @method('PUT')
            <button
                type="submit"
                class="{{ $isPaid ? 'btn-invoice-paid' : 'btn-invoice-unpaid' }}"
            >
                {{ $isPaid ? 'Mark as unpaid' : 'Mark as paid' }}
            </button>
        </form>
        <a
            href="{{ $hrefDelete }}"
            class="btn"
        >Remove</a>
    </div>

</div>

{{-- set anoter href, call it href2 to mark as paid --}}
