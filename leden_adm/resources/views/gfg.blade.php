<!DOCTYPE html>
<html>
<head>
	<title>GeeksforGeeks</title>
</head>
<body>
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
</body>
</html>
