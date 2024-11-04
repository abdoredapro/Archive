<h3 class="first-chart-title">حصة كل فئة</h3>


<canvas id="barChart"></canvas>

<script>
    const url = " {{ route('api.all-projects') }} ";
    const items = @json($projects);
</script>

<script src="{{ asset('js/barchart.js') }}"></script>