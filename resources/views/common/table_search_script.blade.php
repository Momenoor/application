<script type="text/javascript">
    $(document).ready(function() {
        var table = window.LaravelDataTables['{{$tableName}}'];
        var searchInput = $('input[type="search"]');

        $(document).on('init.dt', function(e, settings) {

            if (table.state.loaded() !== null) {
                var searchedText = table.state.loaded().search.search ?? null;
                searchInput.val(searchedText);
            }
        });

        searchInput.on('search', function() {

            var searchText = $(this).val();
            table.search(searchText).draw();
        });
    });
</script>
