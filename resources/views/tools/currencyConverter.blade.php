@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl font-bold mb-6 text-center md:text-left">Currency Converter</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="from-currency" class="block text-sm font-medium text-gray-700 mb-2">From Currency:</label>
                    <select id="from-currency" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></select>
                </div>
                <div>
                    <label for="to-currency" class="block text-sm font-medium text-gray-700 mb-2">To Currency:</label>
                    <select id="to-currency" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></select>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="input-value" class="block text-sm font-medium text-gray-700 mb-2">Enter Amount:</label>
                <input type="number" id="input-value" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="any" value="1">
            </div>
            
            <button id="convert-btn" class="w-full md:w-auto px-6 py-3 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6">Convert</button>
            
            <div id="result" class="text-lg font-semibold text-gray-800"></div>
        </div>
    </div>
</div>
@endsection 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fromCurrencySelect = document.getElementById('from-currency');
        const toCurrencySelect = document.getElementById('to-currency');
        const inputValue = document.getElementById('input-value');
        const convertBtn = document.getElementById('convert-btn');
        const resultDiv = document.getElementById('result');

        // List of all non-digital currencies with ISO 4217 codes and approximate exchange rates to USD (as of 2025)
        const currencies = [
            { code: 'AED', name: 'United Arab Emirates Dirham', rate: 0.272294 },
            { code: 'AFN', name: 'Afghan Afghani', rate: 0.014084 },
            { code: 'ALL', name: 'Albanian Lek', rate: 0.011161 },
            { code: 'AMD', name: 'Armenian Dram', rate: 0.002578 },
            { code: 'ANG', name: 'Netherlands Antillean Guilder', rate: 0.554785 },
            { code: 'AOA', name: 'Angolan Kwanza', rate: 0.001108 },
            { code: 'ARS', name: 'Argentine Peso', rate: 0.001058 },
            { code: 'AUD', name: 'Australian Dollar', rate: 0.676596 },
            { code: 'AWG', name: 'Aruban Florin', rate: 0.555556 },
            { code: 'AZN', name: 'Azerbaijani Manat', rate: 0.588235 },
            { code: 'BAM', name: 'Bosnia-Herzegovina Convertible Mark', rate: 0.569113 },
            { code: 'BBD', name: 'Barbadian Dollar', rate: 0.5 },
            { code: 'BDT', name: 'Bangladeshi Taka', rate: 0.008368 },
            { code: 'BGN', name: 'Bulgarian Lev', rate: 0.569113 },
            { code: 'BHD', name: 'Bahraini Dinar', rate: 2.65252 },
            { code: 'BIF', name: 'Burundian Franc', rate: 0.000347 },
            { code: 'BMD', name: 'Bermudian Dollar', rate: 1 },
            { code: 'BND', name: 'Brunei Dollar', rate: 0.766284 },
            { code: 'BOB', name: 'Bolivian Boliviano', rate: 0.144717 },
            { code: 'BRL', name: 'Brazilian Real', rate: 0.181818 },
            { code: 'BSD', name: 'Bahamian Dollar', rate: 1 },
            { code: 'BTN', name: 'Bhutanese Ngultrum', rate: 0.011905 },
            { code: 'BWP', name: 'Botswanan Pula', rate: 0.075188 },
            { code: 'BYN', name: 'Belarusian Ruble', rate: 0.30581 },
            { code: 'BZD', name: 'Belize Dollar', rate: 0.496031 },
            { code: 'CAD', name: 'Canadian Dollar', rate: 0.740741 },
            { code: 'CDF', name: 'Congolese Franc', rate: 0.000352 },
            { code: 'CHF', name: 'Swiss Franc', rate: 1.17647 },
            { code: 'CLP', name: 'Chilean Peso', rate: 0.001098 },
            { code: 'CNY', name: 'Chinese Yuan', rate: 0.140845 },
            { code: 'COP', name: 'Colombian Peso', rate: 0.000248 },
            { code: 'CRC', name: 'Costa Rican Colón', rate: 0.001908 },
            { code: 'CUP', name: 'Cuban Peso', rate: 0.041667 },
            { code: 'CVE', name: 'Cape Verdean Escudo', rate: 0.010101 },
            { code: 'CZK', name: 'Czech Republic Koruna', rate: 0.044444 },
            { code: 'DJF', name: 'Djiboutian Franc', rate: 0.005618 },
            { code: 'DKK', name: 'Danish Krone', rate: 0.149254 },
            { code: 'DOP', name: 'Dominican Peso', rate: 0.016807 },
            { code: 'DZD', name: 'Algerian Dinar', rate: 0.007463 },
            { code: 'EGP', name: 'Egyptian Pound', rate: 0.020534 },
            { code: 'ERN', name: 'Eritrean Nakfa', rate: 0.066667 },
            { code: 'ETB', name: 'Ethiopian Birr', rate: 0.009091 },
            { code: 'EUR', name: 'Euro', rate: 1.11111 },
            { code: 'FJD', name: 'Fijian Dollar', rate: 0.452489 },
            { code: 'FKP', name: 'Falkland Islands Pound', rate: 1.28205 },
            { code: 'FOK', name: 'Faroese Króna', rate: 0.149254 },
            { code: 'GBP', name: 'British Pound Sterling', rate: 1.28205 },
            { code: 'GEL', name: 'Georgian Lari', rate: 0.37037 },
            { code: 'GGP', name: 'Guernsey Pound', rate: 1.28205 },
            { code: 'GHS', name: 'Ghanaian Cedi', rate: 0.064103 },
            { code: 'GIP', name: 'Gibraltar Pound', rate: 1.28205 },
            { code: 'GMD', name: 'Gambian Dalasi', rate: 0.014286 },
            { code: 'GNF', name: 'Guinean Franc', rate: 0.000116 },
            { code: 'GTQ', name: 'Guatemalan Quetzal', rate: 0.129032 },
            { code: 'GYD', name: 'Guyanaese Dollar', rate: 0.004785 },
            { code: 'HKD', name: 'Hong Kong Dollar', rate: 0.128205 },
            { code: 'HNL', name: 'Honduran Lempira', rate: 0.040161 },
            { code: 'HRK', name: 'Croatian Kuna', rate: 0.147059 },
            { code: 'HTG', name: 'Haitian Gourde', rate: 0.007576 },
            { code: 'HUF', name: 'Hungarian Forint', rate: 0.002833 },
            { code: 'IDR', name: 'Indonesian Rupiah', rate: 0.000065 },
            { code: 'ILS', name: 'Israeli New Sheqel', rate: 0.27027 },
            { code: 'IMP', name: 'Manx Pound', rate: 1.28205 },
            { code: 'INR', name: 'Indian Rupee', rate: 0.011905 },
            { code: 'IQD', name: 'Iraqi Dinar', rate: 0.000763 },
            { code: 'IRR', name: 'Iranian Rial', rate: 0.000024 },
            { code: 'ISK', name: 'Icelandic Króna', rate: 0.007299 },
            { code: 'JEP', name: 'Jersey Pound', rate: 1.28205 },
            { code: 'JMD', name: 'Jamaican Dollar', rate: 0.006369 },
            { code: 'JOD', name: 'Jordanian Dinar', rate: 1.40845 },
            { code: 'JPY', name: 'Japanese Yen', rate: 0.006897 },
            { code: 'KES', name: 'Kenyan Shilling', rate: 0.007752 },
            { code: 'KGS', name: 'Kyrgystani Som', rate: 0.011765 },
            { code: 'KHR', name: 'Cambodian Riel', rate: 0.000246 },
            { code: 'KMF', name: 'Comorian Franc', rate: 0.002252 },
            { code: 'KPW', name: 'North Korean Won', rate: 0.001111 },
            { code: 'KRW', name: 'South Korean Won', rate: 0.000752 },
            { code: 'KWD', name: 'Kuwaiti Dinar', rate: 3.27869 },
            { code: 'KYD', name: 'Cayman Islands Dollar', rate: 1.20482 },
            { code: 'KZT', name: 'Kazakhstani Tenge', rate: 0.002083 },
            { code: 'LAK', name: 'Laotian Kip', rate: 0.000045 },
            { code: 'LBP', name: 'Lebanese Pound', rate: 0.000011 },
            { code: 'LKR', name: 'Sri Lankan Rupee', rate: 0.003333 },
            { code: 'LRD', name: 'Liberian Dollar', rate: 0.005128 },
            { code: 'LSL', name: 'Lesotho Loti', rate: 0.056497 },
            { code: 'LYD', name: 'Libyan Dinar', rate: 0.209644 },
            { code: 'MAD', name: 'Moroccan Dirham', rate: 0.103093 },
            { code: 'MDL', name: 'Moldovan Leu', rate: 0.057471 },
            { code: 'MGA', name: 'Malagasy Ariary', rate: 0.000219 },
            { code: 'MKD', name: 'Macedonian Denar', rate: 0.018182 },
            { code: 'MMK', name: 'Myanma Kyat', rate: 0.000477 },
            { code: 'MNT', name: 'Mongolian Tugrik', rate: 0.000294 },
            { code: 'MOP', name: 'Macanese Pataca', rate: 0.124688 },
            { code: 'MRU', name: 'Mauritanian Ouguiya', rate: 0.025 },
            { code: 'MUR', name: 'Mauritian Rupee', rate: 0.021739 },
            { code: 'MVR', name: 'Maldivian Rufiyaa', rate: 0.064935 },
            { code: 'MWK', name: 'Malawian Kwacha', rate: 0.000575 },
            { code: 'MXN', name: 'Mexican Peso', rate: 0.051813 },
            { code: 'MYR', name: 'Malaysian Ringgit', rate: 0.229885 },
            { code: 'MZN', name: 'Mozambican Metical', rate: 0.015674 },
            { code: 'NAD', name: 'Namibian Dollar', rate: 0.056497 },
            { code: 'NGN', name: 'Nigerian Naira', rate: 0.000628 },
            { code: 'NIO', name: 'Nicaraguan Córdoba', rate: 0.027174 },
            { code: 'NOK', name: 'Norwegian Krone', rate: 0.095238 },
            { code: 'NPR', name: 'Nepalese Rupee', rate: 0.007463 },
            { code: 'NZD', name: 'New Zealand Dollar', rate: 0.621118 },
            { code: 'OMR', name: 'Omani Rial', rate: 2.5974 },
            { code: 'PAB', name: 'Panamanian Balboa', rate: 1 },
            { code: 'PEN', name: 'Peruvian Nuevo Sol', rate: 0.266667 },
            { code: 'PGK', name: 'Papua New Guinean Kina', rate: 0.254453 },
            { code: 'PHP', name: 'Philippine Peso', rate: 0.017857 },
            { code: 'PKR', name: 'Pakistani Rupee', rate: 0.00359 },
            { code: 'PLN', name: 'Polish Zloty', rate: 0.261097 },
            { code: 'PYG', name: 'Paraguayan Guarani', rate: 0.000132 },
            { code: 'QAR', name: 'Qatari Rial', rate: 0.274725 },
            { code: 'RON', name: 'Romanian Leu', rate: 0.223214 },
            { code: 'RSD', name: 'Serbian Dinar', rate: 0.009524 },
            { code: 'RUB', name: 'Russian Rubles', rate: 0.010989 },
            { code: 'RWF', name: 'Rwandan Franc', rate: 0.000752 },
            { code: 'SAR', name: 'Saudi Riyal', rate: 0.266667 },
            { code: 'SBD', name: 'Solomon Islands Dollar', rate: 0.119048 },
            { code: 'SCR', name: 'Seychellois Rupee', rate: 0.073529 },
            { code: 'SDG', name: 'Sudanese Pound', rate: 0.001667 },
            { code: 'SEK', name: 'Swedish Krona', rate: 0.098039 },
            { code: 'SGD', name: 'Singapore Dollar', rate: 0.766284 },
            { code: 'SHP', name: 'Saint Helena Pound', rate: 1.28205 },
            { code: 'SLL', name: 'Sierra Leonean Leone', rate: 0.000048 },
            { code: 'SOS', name: 'Somali Shilling', rate: 0.001751 },
            { code: 'SRD', name: 'Surinamese Dollar', rate: 0.034483 },
            { code: 'SSP', name: 'South Sudanese Pound', rate: 0.007674 },
            { code: 'STN', name: 'São Tomé and Príncipe Dobra', rate: 0.044843 },
            { code: 'SYP', name: 'Syrian Pound', rate: 0.000398 },
            { code: 'SZL', name: 'Swazi Lilangeni', rate: 0.056497 },
            { code: 'THB', name: 'Thai Baht', rate: 0.029412 },
            { code: 'TJS', name: 'Tajikistani Somoni', rate: 0.09434 },
            { code: 'TMT', name: 'Turkmenistani Manat', rate: 0.285714 },
            { code: 'TND', name: 'Tunisian Dinar', rate: 0.327869 },
            { code: 'TOP', name: 'Tongan Paʻanga', rate: 0.425532 },
            { code: 'TRY', name: 'Turkish Lira', rate: 0.029412 },
            { code: 'TTD', name: 'Trinidad and Tobago Dollar', rate: 0.147059 },
            { code: 'TVD', name: 'Tuvaluan Dollar', rate: 0.676596 },
            { code: 'TWD', name: 'New Taiwan Dollar', rate: 0.03125 },
            { code: 'TZS', name: 'Tanzanian Shilling', rate: 0.000369 },
            { code: 'UAH', name: 'Ukrainian Hryvnia', rate: 0.024272 },
            { code: 'UGX', name: 'Ugandan Shilling', rate: 0.000269 },
            { code: 'USD', name: 'United States Dollar', rate: 1 },
            { code: 'UYU', name: 'Uruguayan Peso', rate: 0.024752 },
            { code: 'UZS', name: 'Uzbekistan Som', rate: 0.000079 },
            { code: 'VES', name: 'Venezuelan Bolívar', rate: 0.027322 },
            { code: 'VND', name: 'Vietnamese Dong', rate: 0.00004 },
            { code: 'VUV', name: 'Vanuatu Vatu', rate: 0.008403 },
            { code: 'WST', name: 'Samoan Tala', rate: 0.357143 },
            { code: 'XAF', name: 'Central African CFA Franc', rate: 0.001694 },
            { code: 'XCD', name: 'East Caribbean Dollar', rate: 0.37037 },
            { code: 'XOF', name: 'West African CFA Franc', rate: 0.001694 },
            { code: 'XPF', name: 'CFP Franc', rate: 0.009346 },
            { code: 'YER', name: 'Yemeni Rial', rate: 0.003995 },
            { code: 'ZAR', name: 'South African Rand', rate: 0.056497 },
            { code: 'ZMW', name: 'Zambian Kwacha', rate: 0.038462 },
            { code: 'ZWL', name: 'Zimbabwean Dollar', rate: 0.003106 }
        ];

        function populateCurrencies() {
            currencies.forEach(currency => {
                const option1 = document.createElement('option');
                option1.value = currency.code;
                option1.textContent = `${currency.name} (${currency.code})`;
                fromCurrencySelect.appendChild(option1);

                const option2 = document.createElement('option');
                option2.value = currency.code;
                option2.textContent = `${currency.name} (${currency.code})`;
                toCurrencySelect.appendChild(option2);
            });

            // Set default to USD and EUR
            fromCurrencySelect.value = 'USD';
            toCurrencySelect.value = 'EUR';
        }

        function convert() {
            const amount = parseFloat(inputValue.value);
            if (isNaN(amount) || amount < 0) {
                resultDiv.textContent = 'Please enter a valid amount.';
                return;
            }

            const fromCurrency = fromCurrencySelect.value;
            const toCurrency = toCurrencySelect.value;

            if (fromCurrency === toCurrency) {
                resultDiv.textContent = `${amount} ${fromCurrency} = ${amount} ${toCurrency}`;
                return;
            }

            const fromRate = currencies.find(c => c.code === fromCurrency).rate;
            const toRate = currencies.find(c => c.code === toCurrency).rate;
            const result = (amount * fromRate / toRate).toFixed(2);

            resultDiv.textContent = `${amount} ${fromCurrency} = ${result} ${toCurrency}`;
        }

        populateCurrencies();
        convertBtn.addEventListener('click', convert);

        // Initial conversion
        convert();
    });
</script>