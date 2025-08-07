<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold text-gray-800">Edit Role for {{ $user->name }}</h2>
    </x-slot>

    <div class="container my-4" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('users.updateRole', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="role" class="form-label">Select Role</label>
                        <select id="role" name="role" class="form-select" required>
                            <option value="">-- Choose Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Update Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
