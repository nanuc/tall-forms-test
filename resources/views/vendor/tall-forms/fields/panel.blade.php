<div x-data="{ showPanel: false }" class="w-full">

    {{-- panel link --}}
    <div class="w-full" wire:ignore>
        <button
            type="button" x-bind:class="[ showPanel ? 'tf-panel-active' : 'tf-panel-inactive']" class="tf-panel justify-between"
            x-on:click.prevent="showPanel = !showPanel">
            <div class="flex flex-row items-center">
                @if($field->hasIcon)
                    @if($field->icon)
                        @svg($field->icon, 'tf-panel-icon')
                    @endif
                    @if($field->tallIcon)
                        <x-tall-svg :path="$field->tallIcon" class="tf-panel-icon" />
                    @endif
                    @if($field->htmlIcon)
                        {!! $field->htmlIcon !!}
                    @endif
                @endif
                <span class="ml-4">{{ $field->label }}</span>
            </div>
            <div x-show="showPanel" x-cloak><x-tall-svg path="icons.cheveron-outline-up" class="tf-panel-icon" /></div>
            <div x-show="!showPanel" x-cloak><x-tall-svg path="icons.cheveron-outline-down" class="tf-panel-icon" /></div>
        </button>
    </div>


    {{-- Panel content --}}
    <div
        x-show="showPanel"
        wire:key="{{ 'tab-'. md5($field->key) }}"
        class="{{ $field->array_wrapper_class ?? 'tf-panel-wrapper' }}"
        x-cloak>
        <div class="{{ $field->array_wrapper_grid_class ?? 'tf-panel-wrapper-grid' }}">
            @foreach($field->fields as $nested_field)
                @php
                    $nested_field->inline = $nested_field->inline ?? $field->childInline;
                    $nested_field->colspan = $field->childCols ?? $nested_field->colspan;
                    $nested_field->inArray = true;
                @endphp
                @include('tall-forms::includes.field-root', ['field' => $nested_field])
            @endforeach
        </div>
    </div>

</div>

{{-- after field --}}
@include('tall-forms::includes.below')



