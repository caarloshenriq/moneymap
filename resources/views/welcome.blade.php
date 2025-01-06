<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Money Map</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        :root {
            --primary-color: #31b795;
            --second-color: #33b795;
            --light-blue: #56dcaf;
            --primary-text: #1a3b43;
            --second-text: #2d6c67;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Figtree', sans-serif;
            background-color: #f3f4f6;
            color: var(--primary-text);
            margin: 0;
        }

        header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem 0;
            text-align: center;
        }

        header img {
            height: 3rem;
            margin-bottom: 1rem;
        }

        header h1 {
            font-size: 1.875rem;
            font-weight: bold;
        }

        header p {
            font-size: 1.125rem;
            margin-top: 0.5rem;
        }

        main {
            flex: 1;
            padding: 2rem 1rem;
            text-align: center;
        }

        main h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-text);
        }

        main p {
            font-size: 1.125rem;
            color: var(--second-text);
            margin-top: 1rem;
            max-width: 40rem;
            margin-left: auto;
            margin-right: auto;
        }

        main .actions a {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: var(--second-color);
            color: white;
            border-radius: 0.375rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            transition: background-color 0.2s ease;
            margin-right: 1rem;
        }

        main .actions a:hover {
            background-color: var(--light-blue);
        }

        footer {
            background-color: var(--light-blue);
            color: var(--primary-text);
            text-align: center;
            padding: 1rem 0;
            margin-top: auto;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0.25rem 0;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <img src="{{ asset('img/moneymap.png') }}" alt="Money Map Logo">
            <h1>Bem-vindo ao Money Map</h1>
            <p>O seu sistema completo para controle de finanças pessoais.</p>
        </div>
    </header>

    <main>
        <h2>Sobre o Money Map</h2>
        <p>
            O Money Map é uma ferramenta projetada para ajudar você a controlar suas finanças de maneira simples e eficiente.
            Acompanhe seus gastos, organize seu orçamento e alcance seus objetivos financeiros com facilidade.
        </p>

        <div class="actions">
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}">Acessar Dashboard</a>
            @else
            <a href="{{ route('login') }}">Entrar</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}">Criar Conta</a>
            @endif
            @endauth
            @endif
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Money Map. Todos os direitos reservados.</p>
        <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
    </footer>
</body>

</html>