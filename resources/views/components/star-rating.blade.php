@props(['rating' => 0])

<div class="inline-flex text-amber-400 text-base">
    @for($i = 1; $i <= 5; $i++)
        @if($i <= $rating)
            <span>★</span>
        @elseif($i - 0.5 <= $rating)
            <span class="relative">
                <span class="text-gray-200">★</span>
                <span class="absolute left-0 overflow-hidden w-1/2 text-amber-400">★</span>
            </span>
        @else
            <span class="text-gray-200">★</span>
        @endif
    @endfor
</div>
