<select id="pCategorySelect" name="{{$name}}" onChange="pCategoryChange()"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $class }}">
    <option value="" @if($value==null) selected @endif></option>
    @if(!empty($options))
    @foreach($options as $key => $category)
        <option value="{{$category->id}}" @if($value == $category->id) selected @endif>[{{$category->code}}]{{$category->name}}</option>
    @endforeach
        @endif
</select>
<input type="hidden" id="pCategoryDSelect" value="{{$value}}">
