<x-app-layout>
    <div class="row layout-top-spacing">
        <h2 class="mb-4 border-bottom">{{ $title }}</h2>

        <x-alert />

        <form method="POST" action="{{ route('admin.category.store') }}">
            @csrf
            {{-- <input type="hidden" name="category[user_id]" value="{{ $user->id }}"> --}}

            <div class="row mb-4 gy-3">
                <div class="col-col-12">
                    <input type="text" class="form-control" name="category[name]" placeholder="Title" required />
                    @error('category.name')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <textarea rows="6" class="form-control" name="category[description]" placeholder="Description"></textarea>
                    @error('category.description')
                        <div class="text-danger form-text">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <input type="submit" class="mb-4 btn btn-primary">
        </form>
    </div>
</x-app-layout>
