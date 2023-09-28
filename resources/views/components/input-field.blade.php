<div>
    <div class="relative">
        @if ($formId)
            <button class="absolute right-2 top-auto h-full flex w-4 items-center" type="button"
                onclick="
            document.getElementById('{{ $name }}').value='';
            document.getElementById('{{ $formId }}').submit();
            ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        @endif

        <input id="{{ $name }}"
            class="{{ $width }} form-input border-0 ring-slate-100 rounded-xl ring-1 hover:ring-2  space-x-2"
            type="{{ $type ?? 'text' }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
            value="{{ $value }}">
    </div>
    @error($name)
        <div class="mt-2 text-red-500">
            {{ $message }}
        </div>
    @enderror
</div>
