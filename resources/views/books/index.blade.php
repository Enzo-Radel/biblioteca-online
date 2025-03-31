<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Cabeçalho com título e botão de cadastro -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Livros Cadastrados</h2>
            <a href="{{ route('books.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Cadastrar Novo Livro
            </a>
        </div>

        <!-- Tabela de livros -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Título</th>
                        <th class="py-3 px-6 text-left">ISBN</th>
                        <th class="py-3 px-6 text-left">Quantidade</th>
                        <th class="py-3 px-6 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @forelse($books as $book)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">{{ $book->titulo }}</td>
                        <td class="py-3 px-6 text-left">{{ $book->isbn }}</td>
                        <td class="py-3 px-6 text-left">{{ $book->quantidade }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex justify-center items-center">
                                <!-- Botão para visualizar -->
                                <a href="{{ route('books.show', $book->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                    Visualizar
                                </a>
                                <!-- Botão para editar -->
                                <a href="{{ route('books.edit', $book->id) }}" class="text-green-600 hover:text-green-900 mr-2">
                                    Editar
                                </a>
                                <!-- Formulário para excluir com Alpine.js -->
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                      class="inline-block" x-data="{ confirmDelete: false }"
                                      @submit.prevent="confirmDelete ? $el.submit() : confirmDelete = confirm('Tem certeza que deseja excluir este livro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        Excluir
                                    </button>
                                </form>
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
