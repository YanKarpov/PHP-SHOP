<div class="ad-theses-block">
    <h3>Рекламные тезисы</h3>
    <ul>
        @foreach($adTheses as $thesis)
            <li>{{ $thesis->text }}</li>
        @endforeach
    </ul>
</div>