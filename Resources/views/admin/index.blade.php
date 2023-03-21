<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="my-3">
        <div class="card">
            @can('category.create')
                <div class="card-header">
                    <!-- Create modal -->
                    <a href="{{ route('admin.category.create') }}" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-plus"></i>
                        Create
                    </a>
                </div>
            @endcan

            <livewire:category.admin.index />
        </div>
    </div>
</x-app-layout>
