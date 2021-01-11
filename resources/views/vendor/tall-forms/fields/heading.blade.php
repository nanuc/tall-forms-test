<div class="w-full">
    @if($field->asHtml)
        {!! $field->html !!}
    @else
        <div class="{{ $field->root_class ?? 'tf-heading-root' }}">
            <div class="{{ $field->wrapper_class ?? 'tf-heading-wrapper' }}">
                @if($field->hasIcon)
                    <div class="tf-heading-icon-col">
                        @if($field->icon)
                            @svg($field->icon, 'tf-heading-icon')
                        @endif
                        @if($field->tallIcon)
                            <x-tall-svg :path="$field->tallIcon" class="tf-heading-icon"/>
                        @endif
                        @if($field->htmlIcon)
                            {!! $field->htmlIcon !!}
                        @endif
                    </div>
                @endif
                <div>
                    <h3 class="tf-heading">
                        {{ $field->label }}
                    </h3>
                    @if($field->subtitle)
                        <div class="tf-subtitle">
                            {{ $field->subtitle }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
