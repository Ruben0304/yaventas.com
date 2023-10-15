

    @if($usuario==Auth::user()->id)
<script> document.location.href='./addcart?uid='.{{Auth::user()->id}}.'&pid='.{{$producto}}.'&cant='.{{$cantidad}}.''</script>
  

    
   @else
   {{redirect(route('home'))}}

@endif


