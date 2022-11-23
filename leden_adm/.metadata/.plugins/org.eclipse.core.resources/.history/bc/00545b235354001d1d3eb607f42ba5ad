<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <title>Create Leden | Ledens View</title>
      <!-- styling etc. -->
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <form method="POST" action="{{ route('ledens.store') }}">
                    @csrf
                    <h1> Enter details to create a leden</h1>
                    <pre>
                    <div class="form-input"><label>Name        </label> <input type="text" name="name"></div>
					<div class="form-input"><label>Lastname    </label> <input type="text" name="lastname"></div>
					<div class="form-input"><label>Age         </label> <input type="number" name="age"></div>
					<div class="form-input"><label>Adres       </label> <input type="text" name="adres"></div>
                    <div class="form-input"><label>Contribution</label> <input type="number" name="contribution"></div>
				<button type="submit">Submit</button>
                    </pre>
                </form>
            </div>
        </div>
    </body>
    </html>