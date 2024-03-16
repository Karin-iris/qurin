 @if(!empty($options))
        @foreach($options as $id => $section)
            <input type="checkbox" value="{{$id}}" @if($value == $id) checked @endif>{{$section}}</input>
        @endforeach
@endif
