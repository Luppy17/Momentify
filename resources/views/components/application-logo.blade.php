<div>
    <!-- Light mode logo -->
    <img 
        src="{{ asset('images/momentify1.png') }}" 
        alt="Application Logo" 
        class="logo-light h-auto w-auto hidden dark:block" 
        {{ $attributes->merge(['class' => '']) }}
    />
    
    <!-- Dark mode logo -->
    <img 
        src="{{ asset('images/momentify.png') }}" 
        alt="Application Logo" 
        class="logo-dark h-auto w-auto block dark:hidden" 
        {{ $attributes->merge(['class' => '']) }}
    />
</div>
