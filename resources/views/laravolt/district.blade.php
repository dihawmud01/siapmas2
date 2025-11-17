<label for="district">{{ __('Kecamatan') }}</label>
{!!
    Form::select('district_id', $district, '', [
        'class' => 'form-control',
        'placeholder' => '',
        'id' => 'districtId',
    ])
!!}
