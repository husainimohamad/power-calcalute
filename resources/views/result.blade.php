<!DOCTYPE html>
<html>
<head>
    <title>Time Differences Between ON Events</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    
    <!-- jQuery (required by DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <h1>Time Differences Between Each ON Event</h1>

    <table id="timeTable" class="display" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Previous ON Time</th>
                <th>Current ON Time</th>
                <th>Difference</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($timeDiffs as $diff)
                <tr>
                    <td>{{ $diff['previous_time'] }}</td>
                    <td>{{ $diff['current_time'] }}</td>
                    <td>{{ $diff['difference'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Total Time Difference: {{ $totalTime }}</h2>

    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#timeTable').DataTable({
                "paging": true,           // Enable pagination
                "searching": true,        // Enable search
                "ordering": true,         // Enable sorting
                "info": true,             // Enable info on data table entries
                "pageLength": 10,         // Number of rows per page
                "lengthMenu": [5, 10, 25, 50], // Pagination options
                "language": {
                    "search": "Filter records:" // Custom search label
                }
            });
        });
    </script>
</body>
</html>
