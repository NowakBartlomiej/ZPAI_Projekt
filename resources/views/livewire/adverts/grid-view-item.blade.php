@props([
    'image' => '',
    'title' => '',
    'subtitle' => '',
    'price' => '',
    'withBackground' => false,
    'model',
    'actions' => [],
    'hasDefaultAction' => false,
    'selected' => false
])

<div class="{{ $withBackground ? 'rounded-md shadow-md' : '' }} {{ $model->deleted_at ? 'opacity-60' : '' }}">
    @if ($hasDefaultAction)
      <a href="#!" wire:click.prevent="onCardClick({{ $model->id }})">
        <img src="{{ $image }}" alt="{{ $image }}" class="hover:shadow-lg cursor-pointer rounded-md h-48 w-full object-cover {{ $withBackground ? 'rounded-b-none' : '' }} {{ $selected ? variants('gridView.selected') : "" }}">
      </a>
    @else
      <img src="{{ $image }}" alt="{{ $image }}" class="rounded-md h-48 w-full object-cover {{ $withBackground ? 'rounded-b-none' : '' }}  {{ $selected ? variants('gridView.selected') : "" }}">
    @endif
  
    <div class="pt-4 {{ $withBackground ? 'bg-white rounded-b-md p-4' : '' }}">
      <div class="flex items-start">
        <div class="flex-1">
          <h3 class="font-bold text-2xl leading-6 text-gray-900 py-2 {{ $model->deleted_at ? 'line-through' : '' }}">
            @if ($hasDefaultAction)
              <a href="#!" class="hover:underline" wire:click.prevent="onCardClick({{ $model->getKey() }})">
                {!! $title !!}
              </a>
            @else
              {!! $title !!}
            @endif
          </h3>
          @if ($subtitle)
            <span class="text-sm text-gray-600 py-2 {{ $model->deleted_at ? 'line-through' : '' }}">
              {!! $subtitle !!}
            </span>
          @endif
          <br>
          @if ($price)
            <span class="text-2xl text-red-600 {{ $model->deleted_at ? 'line-through' : '' }}">
              {!! $price !!}
            </span>
          @endif
        </div>
  
        @if (count($actions))
          <div class="flex justify-end items-center ">
            <x-lv-actions.drop-down :actions="$actions" :model="$model"/>
          </div>
        @endif
      </div>
  
      @if (isset($description))
        <p class="line-clamp-3 mt-2">
          {!! $description !!}
        </p>
      @endif
    </div>
  
  </div>
