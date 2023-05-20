<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Artists</title>
    <style>
        * {
            color: black
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Address</th>
                <th>First Release Year</th>
                <th>Number of Albums Released</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->dob }}</td>
                    <td>
                        @if ($d->gender == 'm')
                            Male
                        @elseif ($d->gender == 'f')
                            Female
                        @else
                            Others
                        @endif
                    </td>
                    <td>{{ $d->address }}</td>
                    <td>{{ $d->first_release_year }}</td>
                    <td>{{ $d->no_of_albums_released }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
