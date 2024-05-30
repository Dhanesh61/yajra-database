<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body>
    <div>
        <label for="min-price">Min Price:</label>
        <input type="text" id="min-price" name="min-price">
        <label for="max-price">Max Price:</label>
        <input type="text" id="max-price" name="max-price">
        <select id="email-filter">
            <option value="">Email</option>
        </select>
        <button id="apply-filter">Apply Filter</button>
    </div>

    <table id="students-table" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Price</th>
            </tr>
        </thead>
    </table>

    <script>
        $(document).ready(function() {
            var dataTable = $('#students-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('students.data') }}",
                    data: function (d) {
                        d.min_price = $('#min-price').val();
                        d.max_price = $('#max-price').val();
                        d.email = $('#email-filter').val();
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'price', name: 'price' }
                ]
            });

            $.ajax({
                url: "{{ route('students.emails') }}",
                success: function(data) {
                    $.each(data, function(key, value) {
                        $('#email-filter').append('<option value="' + value + '">' + value + '</option>');
                    });
                }
            });

            $('#apply-filter').on('click', function() {
                dataTable.ajax.reload();
            });
        });
    </script>
</body>
</html>
