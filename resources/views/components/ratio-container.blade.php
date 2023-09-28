<div>
    <div class="mb-4">
        <label class="text-lg " for="{{ $name }}">{{ Str::ucfirst($name) }}</label>
    </div>
    <div>
        {{ $slot }}
        @foreach ($options as $option)
            <div class="flex items-center space-x-2 ">
                <input type="radio" name="{{ $name }}" value="{{ $option }}"
                    {{ request($name) === $option || old($name) === $option ? 'checked' : '' }}>
                <p>{{ Str::ucfirst($option) }}</p>
            </div>
        @endforeach
    </div>
    @error($name)
        <div class="mt-2 text-red-500">
            {{ $message }}
        </div>
    @enderror
</div>
