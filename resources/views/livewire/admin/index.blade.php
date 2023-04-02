<div class="card-body">
    {{-- Filter --}}
    <section class="row">
        {{-- Limit --}}
        <div class="col-sm-12 col-md-6">
            <div class="dataTables_length" id="maintable_length">
                <label class="d-flex justify-content-start align-items-center">
                    <span class="me-1">Show</span>
                    <select wire:model.lazy="limit"
                        class="custom-select custom-select-sm form-control form-control-sm w-25 me-1">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="_col-auto">entries</span>
                </label>
            </div>
        </div>

        {{-- Search --}}
        <div class="col-sm-12 col-md-6">
            <div id="maintable_filter" class="dataTables_filter">
                <label class="d-flex justify-content-start align-items-center">
                    <span class="me-1">Search:</span>
                    <input type="search" class="form-control form-control-sm" placeholder="" wire:model="search">
                </label>
            </div>
        </div>
    </section>

    <div class="table-responsive">
        <table class="table mb-0 table-hover _table-striped _table-bordered">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col" class="w-50">Description</th>
                    {{-- <th class="text-center" scope="col">Count</th> --}}
                    <th class="text-center" scope="col"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($categories ?? [] as $category)
                    <tr>
                        <td>
                            <div class="media">
                                @if ($category->hasMedia(['image']))
                                    <div class="avatar me-2">
                                        <img alt="avatar" src="{{ $category->media('image')->first()->getUrl() }}"
                                            class="rounded-circle" />
                                    </div>
                                @elseif($category->icon)
                                    <i class="{{ $category->icon }} me-1"></i>
                                @else
                                    <i class="fa fa-sitemap me-1"></i>
                                @endif

                                <div class="media-body align-self-center">
                                    <h6 class="mb-0">
                                        <a href="{{ route('admin.category.show', $category->slug) }}">
                                            {{ $category->name }}
                                            @if ($category->child and $category->child->count() > 0)
                                                <span>({{ $category->child->count() }})</span>
                                            @endif
                                        </a>
                                    </h6>
                                    @if ($category->parent)
                                        <span>
                                            <a href="{{ route('admin.category.show', $category->parent->slug) }}">
                                                {{ $category->parent->name }}
                                            </a>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ Str::limit($category->description, 64, '...') }}
                        </td>

                        {{-- <td>
                            {{$category->}}
                        </td> --}}

                        <!-- Actions -->
                        <td class="text-end">
                            <div class="action-btns">
                                <a href="{{ route('admin.category.show', $category->slug) }}"
                                    class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip"
                                    data-placement="top" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>

                                <a href="{{ route('admin.category.edit', $category->slug) }}"
                                    class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip"
                                    data-placement="top" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </a>

                                <form class="d-inline" method="post"
                                    action="{{ route('admin.category.destroy', $category->slug) }}">
                                    @method('delete')
                                    @csrf

                                    <button type="submit"
                                        class="btn btn-sm bg-transparent px-2 action-btn btn-delete bs-tooltip"
                                        data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if (!$categories->count())
            <p class="text-center py-4">
                No record found.
            </p>
        @endif
    </div>
</div>
