@extends('layouts.app')

@section('content')

<h1 class="text-2xl w-full mb-4 font-bold">Messages Sent</h1>

<table class="shadow-lg bg-white">
    <tr>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Sender</th>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Recipient</th>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Subject</th>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Message Body</th>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Timestamp</th>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Mailgun Status</th>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Mailgun Info</th>
    </tr>
    @foreach($messages as $message)
        @php $payload = json_decode($message->mailgun_payload, true); @endphp
    <tr>
        <td class="border px-4 py-2">{{ $message->sender_email }}</td>
        <td class="border px-4 py-2">{{ $message->recipient_email }}</td>
        <td class="border px-4 py-2">{{ $message->subject }}</td>
        <td class="border px-4 py-2">{{ $message->body }}</td>
        <td class="border px-4 py-2">{!! \Carbon\Carbon::parse($message->timestamp)->format('d/m/Y <b>H:i</b>') !!}</td>
        <td class="border px-4 py-2">{{ $message->mailgun_status }}</td>
        <td class="border px-4 py-2 w-24 text-sm" x-data="{ show: false }"">
            {!! 
            (isset($payload['event-data']['envelope']['sending-ip']) ? '<b>Sending IP:</b> ' . $payload['event-data']['envelope']['sending-ip'] . '<br>' : '') . 
            (isset($payload['event-data']['timestamp']) ? '<b>Server Time:</b> ' . \Carbon\Carbon::parse($payload['event-data']['timestamp'])->format('H:i'). '<br>' : '') .
            (isset($payload['event-data']['timestamp']) ? '<b>Message ID:</b> ' . str_replace("@swift.generated", "", $payload['event-data']['message']['headers']['message-id']) . '<br>' : '')
            !!}
            <br>
            @if(!empty($payload))
            <button @click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }">More Info
                <i x-show="show" class="fas fa-chevron-up"></i>
                <i x-show="!show" class="fas fa-chevron-down"></i>
            </button>
            <div x-show="show" style="display: none;" class="bg-white"><pre>{!! json_encode($payload, JSON_PRETTY_PRINT) !!}</pre></div>
            @endif
        </td>
    </tr>
    @endforeach
</table>

@endsection