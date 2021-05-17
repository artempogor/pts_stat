@guest
    <p></p>
@else

    <div class="text-center">
        <p class="small m-0">
            {{ __('') }} 2021 - {{date('Y')}}<br>
            <a href="http://orchid.software" target="_blank" rel="noopener">
                {{ __('Версия:') }} v{{\Orchid\Platform\Dashboard::VERSION}}
            </a>
        </p>
    </div>
@endguest
