<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold text-gray-800">User Management</h2>
    </x-slot>

    <div class="container my-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th style="width: 120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->roles->count())
                                        {{ $user->roles->pluck('name')->join(', ') }}
                                    @else
                                        <span class="text-muted fst-italic">No role assigned</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('users.editRole', $user->id) }}" class="btn btn-sm btn-primary">
                                        Edit Role
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted fst-italic py-4">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
