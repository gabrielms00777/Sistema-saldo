<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão Financeira</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-[#f4f4f4]">
    <nav class="py-4 text-white bg-gray-900">
        <div class="container flex items-center justify-between mx-auto">
            <img src="caminho-para-o-logo.png" alt="Logo" class="w-10 h-10">
            <div>
                @auth
                    <a href="{{ asset('balance') }}" class="text-white hover:underline">Dashboard</a>
                @else
                    <a href="{{ asset('login') }}" class="mr-6 text-white hover:underline">Login</a>
                    <a href="{{ asset('register') }}" class="text-white hover:underline">Registro</a>
                @endauth
            </div>
        </div>
    </nav>
    <header class="p-8 text-center text-white bg-indigo-800">
        <h1 class="mb-2 text-4xl font-bold">Sistema de Gestão Financeira</h1>
        <p class="mb-4 text-lg">Pratique suas habilidades financeiras com nosso projeto de estudo.</p>
        <a href="#features" class="text-indigo-300 hover:underline">Saiba Mais</a>
    </header>


    <section id="features" class="py-16">
        <div class="container mx-auto">
            <div class="mb-8 text-center">
                <h2 class="mb-2 text-3xl font-semibold">Recursos Principais</h2>
                <p class="text-gray-600">Explore o que nosso sistema de gestão oferece.</p>
            </div>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="mb-4 text-xl font-semibold">Registro de Transações</h3>
                    <p class="text-gray-700">
                        Registre suas entradas e saídas financeiras para manter o controle de suas finanças pessoais.
                    </p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="mb-4 text-xl font-semibold">Histórico Personalizado</h3>
                    <p class="text-gray-700">
                        Mantenha um histórico organizado de todas as suas transações anteriores para referência futura.
                    </p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h3 class="mb-4 text-xl font-semibold">Prática de Tomada de Decisão</h3>
                    <p class="text-gray-700">
                        Aperfeiçoe suas habilidades ao tomar decisões financeiras em um ambiente de aprendizado seguro.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="mb-4 text-3xl font-semibold">Comece agora mesmo!</h2>
            <p class="mb-6 text-gray-600">Faça o login ou registre-se para acessar o sistema.</p>
            <a href="{{ asset('login') }}"
                class="px-6 py-2 mr-4 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Login</a>
            <a href="{{ asset('register') }}"
                class="px-6 py-2 text-white bg-gray-600 rounded-lg hover:bg-gray-700">Registro</a>
        </div>
    </section>

    <footer class="py-6 text-center text-white bg-gray-900">
        <p>&copy; 2023 Sistema de Gestão Financeira</p>
    </footer>
</body>

</html>
