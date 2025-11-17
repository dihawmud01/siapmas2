<label for="village">{{ __('Kelurahan/Desa') }}</label>
{!!
    Form::select('village_id', $village, '', [
        'class' => 'form-control',
        'placeholder' => '',
        'id' => 'villageId',
    ])
!!}
