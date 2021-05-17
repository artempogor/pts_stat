@push('head')
    <meta name="robots" content="noindex" />
    <link
          href="{{ route('platform.resource', ['orchid', 'favicon.svg']) }}"
          sizes="any"
          type="image/svg+xml"
          id="favicon"
          rel="icon"
    >
@endpush

<p class="h2 n-m font-weight-light v-center">
   <x-orchid-icon path="orchid" width="1.2em" height="1.2em"/>

    <span class="ml-3 d-none d-sm-block">
        PTS
    <small class="v-top opacity"></small>
    </span>
</p>
