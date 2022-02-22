@if ($showFilterDropdown && ($filtersView || count($customFilters)))
    <div x-cloak x-data="{ open: false }" x-on:keydown.escape.stop="open = false" x-on:mousedown.away="open = false"
        class="btn-group d-block d-md-inline">
        <button x-on:click="open = !open" type="button" class="btn btn-primary dropdown-toggle d-block w-100 d-md-inline"
            data-bs-toggle="dropdown">

            <span class="me-5">@lang('Filters')
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>

            @if (count($this->getFiltersWithoutSearch()))
                <span class="badge badge-light rounded-pill">
                    {{ count($this->getFiltersWithoutSearch()) }}
                </span>
            @endif

            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu w-100" x-bind:class="{'show' : open}" role="menu">
            <li>
                @if ($filtersView)
                    @include($filtersView)
                @elseif (count($customFilters))
                    @foreach ($customFilters as $key => $filter)
                        <div wire:key="filter-{{ $key }}" class="p-2">
                            <label for="filter-{{ $key }}" class="mb-2">
                                {{ $filter->name() }}
                            </label>

                            @if ($filter->isSelect())
                                @include('livewire-tables::bootstrap-5.includes.filter-type-select')
                            @elseif($filter->isMultiSelect())
                                @include('livewire-tables::bootstrap-5.includes.filter-type-multiselect')
                            @elseif($filter->isDate())
                                @include('livewire-tables::bootstrap-5.includes.filter-type-date')
                            @elseif($filter->isDatetime())
                                @include('livewire-tables::bootstrap-5.includes.filter-type-datetime')
                            @endif
                        </div>
                    @endforeach
                @endif

            </li>
        </ul>
    </div>
@endif
