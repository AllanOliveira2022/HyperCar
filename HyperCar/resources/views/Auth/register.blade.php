<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>

    <h2>Registrar um Novo Usuário</h2>

    <!-- Formulário de Registro -->
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <!-- Nome -->
        <div>
            <label for="Nome">Nome</label>
            <input type="text" name="Nome" id="Nome" value="{{ old('Nome') }}" required>
            @error('Nome')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="Email">Email</label>
            <input type="email" name="Email" id="Email" value="{{ old('Email') }}" required>
            @error('Email')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <!-- CPF -->
        <div>
            <label for="Cpf">CPF</label>
            <input type="text" name="Cpf" id="Cpf" value="{{ old('Cpf') }}" required maxlength="11" pattern="\d{11}">
            @error('Cpf')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <!-- Endereço -->
        <div>
            <label for="Endereco">Endereço</label>
            <input type="text" name="Endereco" id="Endereco" value="{{ old('Endereco') }}">
            @error('Endereco')
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

        <!-- Confirmação de Senha -->
        <div>
            <label for="Senha_confirmation">Confirmar Senha</label>
            <input type="password" name="Senha_confirmation" id="Senha_confirmation" required>
            @error('Senha_confirmation')
                <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Registrar</button>
    </form>

</body>
</html>
