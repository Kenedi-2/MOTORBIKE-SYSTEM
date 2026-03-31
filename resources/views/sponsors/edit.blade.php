<x-app-layout>
    <x-slot name="header">
        Edit Sponsor
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow p-6 rounded">
            <form method="POST" action="{{ route('sponsors.update', $sponsor->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Name</label>
                    <input type="text" name="name" value="{{ old('name', $sponsor->name) }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $sponsor->phone) }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Address</label>
                    <input type="text" name="address" value="{{ old('address', $sponsor->address) }}" class="w-full border p-2 rounded">
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Sponsor</button>
            </form>
        </div>
    </div>
</x-app-layout>