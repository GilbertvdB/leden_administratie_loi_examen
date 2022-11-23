<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>View Ledens | Leden View</title>
        <!-- Styles etc. -->
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <h1>Here's a list of available ledens</h1>
                <table>
                    <thead>
                        <td>Name</td>
                        <td>Lastname</td>
                        <td>Age</td>
                        <td>Adres</td>
						<td>Contribution</td>
                    </thead>
                    <tbody>
                        @foreach ($allLedens as $leden)
                            <tr>
                                <td>{{ $leden->name }}</td>
                                <td class="inner-table">{{ $leden->lastname }}</td>
                                <td class="inner-table">{{ $leden->age }}</td>
                                <td class="inner-table">{{ $leden->adres }}</td>
								<td class="inner-table">{{ $leden->contribution }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>