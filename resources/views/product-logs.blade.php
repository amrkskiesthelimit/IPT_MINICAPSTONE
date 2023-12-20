@extends('base')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Logs</h1>

    <table class="table table-bordered">
        <thead class="bg-primary text-white">
            <tr>
                <th>Timestamp</th>
                <th>Log Entry</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($logEntries as $logEntry)
                <tr>
                    <td>{{ $logEntry->formattedCreatedAt }}</td>
                    <td>{{ $logEntry->log_entry }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">No log entries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

<style scoped>
    /* public/css/styles.css */


h1 {
    color: #333;
}

table {
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    border-collapse: collapse;
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #007bff;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

td {
    border-bottom: 1px solid #ddd;
}

.text-center {
    text-align: center;
}

</style>
