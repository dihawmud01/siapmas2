<label for="city">{{ __('Kota/Kabupaten') }}</label>
{!!
    Form::select('city_id', $city, '', [
        'class' => 'form-control',
        'placeholder' => ' ',
        'id' => 'cityId',
    ])
!!}
