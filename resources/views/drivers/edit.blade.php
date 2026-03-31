<x-app-layout>
    <x-slot name="header">
        Edit Driver
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow p-6 rounded">
            <form method="POST" action="{{ route('drivers.update', $driver->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1 font-bold">User</label>
                    <select name="user_id" class="w-full border p-2 rounded" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $driver->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $driver->phone) }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">License Number</label>
                    <input type="text" name="license_number" value="{{ old('license_number', $driver->license_number) }}" class="w-full border p-2 rounded" required>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Driver</button>
            </form>
        </div>
    </div>
</x-app-layout>