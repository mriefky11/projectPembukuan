<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="flex items-center justify-center min-h-screen bg-base-200">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title justify-center mb-4">Login</h2>

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="form-control">
                    <label class="label">Email</label>
                    <input type="email" name="email" placeholder="Email" class="input input-bordered" required>
                </div>

                <div class="form-control mt-4">
                    <label class="label">Password</label>
                    <input type="password" name="password" placeholder="Password" class="input input-bordered" required>
                </div>

                @if ($errors->any())
                    <div class="text-red-500 mt-2">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
