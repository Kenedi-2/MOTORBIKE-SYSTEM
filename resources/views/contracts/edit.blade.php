<x-app-layout>
    <x-slot name="header">
        Edit Contract
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow p-6 rounded">
            <form method="POST" action="{{ route('contracts.edit', $contract->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Driver</label>
                    <select name="driver_id" class="w-full border p-2 rounded" required>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ $contract->driver_id == $driver->id ? 'selected' : '' }}>
                                {{ $driver->user->name }} ({{ $driver->license_number }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Motorbike</label>
                    <select name="motorbike_id" class="w-full border p-2 rounded" required>
                        @foreach($motorbikes as $bike)
                            <option value="{{ $bike->id }}" {{ $contract->motorbike_id == $bike->id ? 'selected' : '' }}>
                                {{ $bike->model }} ({{ $bike->plate_number }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Sponsor</label>
                    <select name="sponsor_id" class="w-full border p-2 rounded" required>
                        @foreach($sponsors as $sponsor)
                            <option value="{{ $sponsor->id }}" {{ $contract->sponsor_id == $sponsor->id ? 'selected' : '' }}>
                                {{ $sponsor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $contract->start_date) }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Total Amount</label>
                    <input type="number" name="total_amount" value="{{ old('total_amount', $contract->total_amount) }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-bold">Daily Amount</label>
                    <input type="number" name="daily_amount" value="{{ old('daily_amount', $contract->daily_amount) }}" class="w-full border p-2 rounded" required>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Contract</button>
            </form>
        </div>
    </div>
</x-app-layout>