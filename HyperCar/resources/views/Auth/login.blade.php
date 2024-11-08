<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <h2>Login</h2>

    <!-- Formulário de Login -->
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <!-- Email -->
        <div>
            <label for="Email">Email</label>
            <input type="email" name="Email" id="Email" value="{{ old('Email') }}" required>
            @error('Email')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Senha -->
        <div>
            <label for="Senha">Senha</label>
            <input type="password" name="Senha" id="Senha" required>
            @error('Senha')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Login</button>
    </form>

</body>
</html>
