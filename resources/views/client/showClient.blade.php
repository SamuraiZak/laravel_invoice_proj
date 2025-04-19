<x-layout>
    
    <h2>Client Name: {{ $client->name }}</h2>

    <div class="border-2 border-dashed bg-white px-4 pb-4 my-4 rounded">
        <h3>Client Information</h3>
        <p><strong>Email: </strong>{{ $client->email }}</p>
        <p><strong>phone: </strong>{{ $client->phone }}</p>
        <p><strong>Company: </strong>{{ $client->company }}</p>
        <p><strong>Address: </strong>{{ $client->address }}</p>
       

    </div>

</x-layout>