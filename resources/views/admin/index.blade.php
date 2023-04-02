<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="my-3">
        <x-alert />

        <div class="card">
            @can('room.create')
                <div class="card-header">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container-fluid">
                            <a class="navbar-brand d-md-none" href="javascript://" data-bs-toggle="collapse"
                                data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false">Menu</a>

                            <button class="navbar-toggler border-none outline-none" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarScroll">
                                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll"
                                    style="--bs-scroll-height: 100px;">
                                    <li class="nav-item">
                                        <button class="btn btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#createModal">Create</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            @endcan

            <livewire:category::admin.index />
        </div>
    </div>

    @push('modals')
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalForm"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title add-title" id="createModalFormLabel1">
                            Add Contact
                        </h5>
                        {{-- <h5 class="modal-title edit-title" id="createModalFormLabel2" style="display: none;">
                            Edit Contact</h5> --}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>

                    <form id="createModalForm" method="POST" action="{{ route('admin.category.store') }}">
                        <div class="modal-body">
                            <div class="row gy-3">
                                <div class="col-md-12">
                                    <div>
                                        <input type="text" id="name" class="form-control" name="category[name]"
                                            placeholder="Name" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="">
                                        <textarea id="description" class="form-control" name="category[description]" placeholder="Description"></textarea>
                                        <span class="validation-text"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group" x-data="{ icon: 'fa fa-sitemap' }">
                                        <span class="input-group-text">
                                            <i x-bind:class="icon"></i>
                                        </span>
                                        <input type="text" id="icon" class="form-control" name="category[icon]"
                                            x-model="icon" placeholder="Icon (fa fa-home)" value="fa fa-sitemap">
                                    </div>
                                    <span class="validation-text"></span>
                                </div>

                                <div class="col-md-6">
                                    <div class="">
                                        <input type="file" id="image" name="image" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {{-- <button id="btn-edit" class="float-left btn btn-success">Save</button> --}}

                            <button id="btn-add" class="btn btn-primary">Add</button>

                            <button class="btn bnt-sm" data-bs-dismiss="modal">
                                <i class="fa fa-undo"></i>
                                Cancel
                            </button>
                        </div>

                        @csrf
                    </form>
                </div>
            </div>
        </div>
    @endpush
</x-app-layout>
