@php
    $alertId = 'alert-' . uniqid();
@endphp

@if ($type == 'success')
    <div id="{{ $alertId }}"
        class="alert flex items-center gap-2 bg-green-500 text-white whitespace-nowrap rounded-md text-sm font-medium ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 justify-start h-auto p-4 z-99 transition-all duration-500 ease-out">
        <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-circle-check-big w-5 h-5 text-success">
                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                <path d="m9 11 3 3L22 4"></path>
            </svg>
            <div class="text-left">
                <div class="font-medium text-foreground">Success!</div>
                <div class="text-sm text-muted-foreground">{{ $message }}
                </div>
            </div>
        </div>
    </div>
@else
    <div id="{{ $alertId }}"
        class="alert flex items-center bg-red-500 gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background  transition-all duration-500 ease-out focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 text-white  z-99 justify-start h-auto p-4">
        <div class="flex items-center space-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-circle-alert w-5 h-5 ">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" x2="12" y1="8" y2="12"></line>
                <line x1="12" x2="12.01" y1="16" y2="16"></line>
            </svg>
            <div class="text-left">
                <div class="font-medium text-foreground">Error occurred</div>
                <div class="text-sm text-muted-foreground">{{ $message }}
                </div>
            </div>
        </div>
    </div>
@endif
