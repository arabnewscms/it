@if(!empty($module_data))
@include('baboon.new_input_edit')
@else
@include('baboon.new_input_add')
@endif