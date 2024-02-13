<select id="compitency" name="{{$name}}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 {{ $class }}">
        @for($i=1;$i<=3;$i++)
            <option value="{{$i}}" @if($value == $i or ($value=='' and $i == 2)) selected @endif>{{$i}}</option>
        @endfor

</select>
