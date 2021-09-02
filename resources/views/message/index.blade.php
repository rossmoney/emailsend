@extends('layouts.app')

@section('content')

<table class="shadow-lg bg-white">
    <tr>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Sender</th>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Recipient</th>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Subject</th>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Message Body</th>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Timestamp</th>
    <th class="bg-indigo-500 border text-left px-8 py-4 white-text">Mailgun Status</th>
    {{--<th class="bg-indigo-500 border text-left px-8 py-4 white-text">Mailgun Payload</th>--}}
    </tr>
    @foreach($messages as $message)
    <tr>
        <td class="border px-8 py-4">{{ $message->sender_email }}</td>
        <td class="border px-8 py-4">{{ $message->recipient_email }}</td>
        <td class="border px-8 py-4">{{ $message->subject }}</td>
        <td class="border px-8 py-4">{{ $message->body }}</td>
        <td class="border px-8 py-4">{{ \Carbon\Carbon::parse($message->timestamp)->format('d/m/Y H:i') }}</td>
        <td class="border px-8 py-4">{{ $message->mailgun_status }}</td>
        {{--<td class="border px-8 py-4">{{ $message->mailgun_payload }}</td>--}}
    </tr>
    @endforeach
</table>

@endsection