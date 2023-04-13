<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('categories.create_s') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('category.partials.create-category-secondary-form')
                </div>
            </div>
        </div>
    </div>
    <script>
        function pCategoryChange(){
            var p_id = $('#pCategorySelect').val();
            $("#sCategorySelect option").remove();
            $.ajax({
                type: "GET",
                url: "/api/category/get_secondaries/" + p_id,
                dataType : "json"
            }).done(function(data){
                str = "";

                $.map(data,function(index, element) {
                    $('#sCategorySelect').append("<option value=" + element + ">" + index + "</option>");
                });



            }).fail(function(XMLHttpRequest, textStatus, error){
                alert("エラーが発生しました。");
            });
        }

    </script>
</x-admin-layout>


