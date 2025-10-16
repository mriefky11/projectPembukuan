<!DOCTYPE html>
<html lang="en" data-theme="corporate">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="min-h-screen flex items-center justify-center bg-base-200">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="text-2xl font-bold text-center mb-4">Login</h2>

            @if ($errors->any())
                <div class="alert alert-error mb-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div class="form-control mb-2">
                    <label class="label">Email</label>
                    <input type="email" name="email" class="input input-bordered" required>
                </div>

                <div class="form-control mb-4">
                    <label class="label">Password</label>
                    <input type="password" name="password" class="input input-bordered" required>
                </div>

                <button type="submit" class="btn btn-primary w-full">Masuk</button>
            </form>
        </div>
    </div>
</body>

</html>
