<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Cabeçalho com título, botão de cadastro e formulário de pesquisa -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4 sm:mb-0">Livros Cadastrados</h2>
            <form method="GET" action="{{ route('books.index') }}" class="flex items-center mb-4 sm:mb-0">
                <input type="text" name="search" placeholder="Pesquisar por título, autor ou ISBN"
                       class="border border-gray-300 rounded py-2 px-4 mr-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <span class="hidden sm:inline">Pesquisar</span>
                    <i class="fas fa-search sm:hidden"></i>
                </button>
            </form>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('books.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Cadastrar Novo Livro
                </a>
            @endif
        </div>

        <!-- Tabela de livros -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Título</th>
                        <th class="py-3 px-6 text-left">Autor</th>
                        <th class="py-3 px-6 text-left">ISBN</th>
                        <th class="py-3 px-6 text-left">Quantidade</th>
                        <th class="py-3 px-6 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @forelse($books as $book)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">{{ $book->title }}</td>
                        <td class="py-3 px-6 text-left">{{ $book->author }}</td>
                        <td class="py-3 px-6 text-left">{{ $book->isbn }}</td>
                        <td class="py-3 px-6 text-left">{{ $book->quantity }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex justify-center items-center">
                                @if(auth()->user()->isAdmin())
                                    <!-- Botão para editar -->
                                    <a href="{{ route('books.edit', $book->id) }}" class="text-green-600 hover:text-green-900 mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                <!-- Botão para reservar -->
                                @if(auth()->user()->isReservedBy($book->id))
                                    <a href="{{ route('books.cancelReservation', $book->id) }}" class="text-red-600 hover:text-red-900 mr-2">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                @else
                                    <a href="{{ route('books.reserve', $book->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">
                                        <i class="fas fa-bookmark"></i>
                                    </a>
                                @endif
                                @if(auth()->user()->isAdmin())
                                    <!-- Formulário para excluir com Alpine.js -->
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir este livro?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-3 px-6 text-center text-gray-500">
                            Nenhum livro cadastrado.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
