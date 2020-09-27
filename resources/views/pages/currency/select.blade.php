<currency-select-component
    :currencies-data = "{{json_encode($currencies)}}"
    :currency-cookie = "{{json_encode(isset($_COOKIE['Currency']) ? $_COOKIE['Currency'] : 'EUR')}}"
>
</currency-select-component>
