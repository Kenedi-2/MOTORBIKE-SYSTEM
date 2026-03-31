<x-app-layout>
    <x-slot name="header">
        Edit Motorbike
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow p-6 rounded">
            <form method="POST" action="{{ route('motorbikes.update', $motorbike->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Plate Number</label>
                    <input type="text" name="plate_number" value="{{ old('plate_number', $motorbike->plate_number) }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Model</label>
                    <input type="text" name="model" value="{{ old('model', $motorbike->model) }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Engine Number</label>
                    <input type="text" name="engine_number" value="{{ old('engine_number', $motorbike->engine_number) }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Status</label>
                    <select name="status" class="w-full border p-2 rounded" required>
                        <option value="available" {{ $motorbike->status=='available' ? 'selected' : '' }}>Available</option>
                        <option value="rented" {{ $motorbike->status=='rented' ? 'selected' : '' }}>Rented</option>
                        <option value="owned" {{ $motorbike->status=='owned' ? 'selected' : '' }}>Owned</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Motorbike</button>
            </form>
        </div>
    </div>
</x-app-layout>