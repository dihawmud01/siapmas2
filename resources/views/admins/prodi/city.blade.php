<label for="city">{{ __('Kota') }}</label>
{!!
    Form::select('city_id', $city, '', [
        'class' => 'form-control',
        'placeholder' => 'Pilih Kota',
        'id' => 'cityId',
    ])
!!}
