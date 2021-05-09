<div class="row">
    <div class="col-md-4 col-lg-3">
        <ul class="px-0 border">
            @foreach($tabs as $item)
            <li data-tab="$item" class="border list-none rounded-sm @if ($item == $tab) bg-gray-800 text-gray-200 border-blue-800 @endif">
                <a class="block px-3 py-2" href="{{ route('settings', $item) }}">{{ ucwords($item) }}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-8 col-lg-9">
        <div class="p-4 border">
            <h3 class="text-xl mb-3">
                <span class="border-b-2 border-dashed">{{ ucwords($tab) }}</span>
            </h3>
            @if(view()->exists('livewire.admin.'.$tab.'-setting'))
                @livewire('admin.'.$tab.'-setting')
            @endif
        </div>
    </div>
</div>
