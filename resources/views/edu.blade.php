<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        /* Ensure each employee starts on a new page */
        .page-break {
            page-break-before: always;
        }

        /* Optional: Styling for individual employee rows */
        .employee-info {
            margin-top: 20px;
        }

        /* Hide table header on each page after the first page */
        .employee-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .employee-info th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .employee-info td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
    </style>
</head>
<body>

    <h1>Employee Information for Department</h1>

    @foreach($member as $members)
        <!-- Page break before each employee's information -->
        <div class="page-break"></div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi deserunt vel ipsa dolorem consectetur libero quae fugiat, laborum inventore numquam quos itaque ex tenetur, repudiandae suscipit molestiae molestias sint nemo.</div>

        <div class="employee-info">
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Hire Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>{{ $members->member_id }}</td>
                    <td>{{ $members->name_kh }}</td>
                    <td>{{ $members->shirt_size }}</td>
                    <td>{{ $members->gender }}</td>
                    <td>{{ $members->date_of_birth }}</td>
                    <td>{{ $members->home_no }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    @endforeach

</body>
<script>
    
</script>
</html>

