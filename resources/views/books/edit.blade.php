<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Livro</h2>
        <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
            <form method="POST" action="{{ route('books.update', $book->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium">Título</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4">
                    <label for="author" class="block text-gray-700 font-medium">Autor</label>
                    <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium">Descrição</label>
                    <textarea name="description" id="description" rows="4"
                              class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>{{ old('description', $book->description) }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="isbn" class="block text-gray-700 font-medium">ISBN</label>
                    <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $book->isbn) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700 font-medium">Quantity</label>
                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $book->quantity) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>