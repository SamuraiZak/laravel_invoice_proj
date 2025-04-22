@props(['isPaid' => false, 'hrefMark', 'hrefDelete', 'hrefDownloadInvoice'])

<div @class([
    'bg-green-100 rounded border border-gray-200 px-3 py-3 my-2 flex justify-between items-center' => $isPaid,
    'bg-red-100 rounded border border-gray-200 px-3 py-3 my-2 flex justify-between items-center' => !$isPaid,
])>
    <div>{{ $slot }}</div>
    <div class="flex gap-5">
        <a
            href="{{ $hrefDownloadInvoice }}"
            class="btn-download"
        ><svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 text-white"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4"
                />
            </svg>
            <span class="sr-only">Download</span></a>
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

        <a href=""></a>
    </div>

</div>

{{-- set anoter href, call it href2 to mark as paid --}}
