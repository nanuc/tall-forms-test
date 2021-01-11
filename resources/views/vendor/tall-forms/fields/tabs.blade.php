<div x-data="{ tab: window.location.hash ? window.location.hash : '#{{ $activeTab }}' }" class="w-full">

    {{-- Links as select on small screen --}}
    <div class="sm:hidden" wire:ignore>
        <select x-model="tab" aria-label="Selected tab" class="form-select block w-full">
            @foreach($fields as $field)
                @if(filled($field) && $field->type === 'tab')
                    <option value="#{{ $field->name }}"> {{ $field->label }}</option>
                @endif
            @endforeach
        </select>
    </div>

    {{-- links --}}
    <div class="hidden sm:block" wire:ignore>
        <div class="flex flex-col sm:flex-row">
            @foreach($fields as $field)
                @if(filled($field) && $field->type === 'tab')
                    <a x-bind:class="[ tab == '#{{ $field->name }}' ? 'tf-tab-active' : 'tf-tab-inactive']" class="tf-tab"
                       @if($tabClickUpdatesUrl) href="#{{ $field->name }}" x-on:click="tab='#{{ $field->name }}'" @else
                       href="#" x-on:click.prevent="tab='#{{ $field->name }}'" @endif>
                        @if($field->hasIcon)
                            @if($field->icon)
                                @svg($field->icon, 'tf-tab-icon')
                            @endif
                            @if($field->tallIcon)
                                <x-tall-svg :path="$field->tallIcon" class="tf-tab-icon" />
                            @endif
                            @if($field->htmlIcon)
                                {!! $field->htmlIcon !!}
                            @endif
                        @endif
                        <span class="tf-tab-label">{{ $field->label }}</span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>


    {{-- Tab content --}}
    <div>
        @foreach($fields as $field)
            @if(filled($field) && $field->type === 'tab')
                <div x-show="tab == '#{{ $field->name }}'" wire:key="{{ 'tab-'. md5($field->key) }}"  x-cloak>
                    @php $fields = $field->fields @endphp
                    @include('tall-forms::includes.field-loop')
                </div>
            @endif
        @endforeach
    </div>

    {{-- errors --}}
    <div>
        @if ($errors->any())
            <div class="tf-tab-errors-callout">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x-tall-svg :path="config('tall-forms.exclamation')" class="tf-tab-error-icon" />
                    </div>
                    <div class="ml-3">
                        <ul class="tf-tab-error-ul">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>

</div>


