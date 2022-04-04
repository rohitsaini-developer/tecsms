<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>

<script>
    $(document).ready(function(){
        @if(isset($postpaidUser))
            changeCurrencyFlag('+'+$('#country_code').val()+$('#phone_number').val());
        @else 
            changeCurrencyFlag("+1");
        @endif
    });
    function changeCurrencyFlag(flagcode){
        $('.iti__selected-flag').remove();
        // $('#phone_number').mask('(999) 999-9999');

        var input = document.querySelector("#phone_number");
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
            preferredCountries:['in','us'],
            initialCountry: "us",
        });
    
        iti.setNumber(flagcode);
        var countryData = iti.getSelectedCountryData();
        // console.log(countryData);
        $('#country_code').val(countryData['dialCode']);
        
        input.addEventListener("countrychange", function() {
        // do something with iti.getSelectedCountryData()
            var countryData = iti.getSelectedCountryData();
            console.log(countryData);
            $('#country_code').val(countryData['dialCode']);
        });
    }
</script>