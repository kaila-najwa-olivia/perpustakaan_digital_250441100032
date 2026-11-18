@props(['judul', 'penulis', 'tahun', 'url'])

<div class="kartu">
    <span class="tag">{{ $slot }}</span>

    {{-- A1: Sengaja menggunakan sintaks tanpa escaping --}}
    <!-- <h3>{!! $judul !!}</h3> -->
    <h3>{{  $judul }}</h3>

    <p>{{ $penulis }}</p>
    <p class="tahun">{{ $tahun }}</p>

    <a href="{{ $url }}" class="btn btn-sm">Lihat Detail</a>
</div>
