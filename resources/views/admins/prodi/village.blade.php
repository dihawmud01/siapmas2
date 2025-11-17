<label for="district">{{ __('Kelurahan') }}</label>
{!!
    Form::select('district_id', $district, '', [
        'class' => 'form-control',
        'placeholder' => 'Pilih kelurahan',
        'id' => 'districtId',
    ])
!!}
