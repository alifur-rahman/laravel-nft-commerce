<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //START: Country data
        // ----------------------------------------------------
        $country_iso = [
            'AD',
            'AE',
            'AF',
            'AG',
            'AL',
            'AO',
            'AQ',
            'AR',
            'AT',
            'AU',
            'AZ',
            'BA',
            'BB',
            'BD',
            'BE',
            'BF',
            'BG',
            'BH',
            'BJ',
            'BN',
            'BO',
            'BR',
            'BS',
            'BT',
            'BW',
            'BY',
            'BZ',
            'CA',
            'CF',
            'CG',
            'CH',
            'CI',
            'CL',
            'CM',
            'CN',
            'CO',
            'CR',
            'CU',
            'CV',
            'CY',
            'CZ',
            'DE',
            'DJ',
            'DK',
            'DM',
            'DO',
            'DZ',
            'EC',
            'EE',
            'EG',
            'ER',
            'ES',
            'ET',
            'FI',
            'FJ',
            'FK',
            'FM',
            'FR',
            'GA',
            'GD',
            'GE',
            'GH',
            'GL',
            'GM',
            'GN',
            'GQ',
            'GR',
            'GT',
            'GU',
            'GW',
            'GY',
            'HK',
            'HN',
            'HR',
            'HT',
            'HU',
            'ID',
            'IE',
            'IL',
            'IN',
            'IQ',
            'IR',
            'IS',
            'IT',
            'JM',
            'JO',
            'JP',
            'KE',
            'KG',
            'KH',
            'KI',
            'KM',
            'KP',
            'KR',
            'KW',
            'KZ',
            'LA',
            'LB',
            'LC',
            'LI',
            'LK',
            'LR',
            'LS',
            'LT',
            'LU',
            'LV',
            'LY',
            'MA',
            'MD',
            'MG',
            'MH',
            'MK',
            'ML',
            'MN',
            'MR',
            'MT',
            'MU',
            'MV',
            'MW',
            'MX',
            'MY',
            'MZ',
            'NA',
            'NE',
            'NG',
            'NI',
            'NL',
            'NO',
            'NP',
            'NR',
            'NZ',
            'OM',
            'PA',
            'PE',
            'PG',
            'PH',
            'PK',
            'PL',
            'PS',
            'PT',
            'PY',
            'QA',
            'RO',
            'RU',
            'RW',
            'SA',
            'SB',
            'SC',
            'SD',
            'SE',
            'SG',
            'SI',
            'SK',
            'SL',
            'SN',
            'SO',
            'SR',
            'ST',
            'SV',
            'SY',
            'SZ',
            'TD',
            'TG',
            'TH',
            'TJ',
            'TM',
            'TN',
            'TO',
            'TR',
            'TT',
            'TV',
            'TW',
            'TZ',
            'UA',
            'UG',
            'UK',
            'US',
            'UY',
            'UZ',
            'VA',
            'VC',
            'VE',
            'VN',
            'VU',
            'WS',
            'YE',
            'ZA',
            'ZM',
            'ZW',
        ];
        $country_name = [
            'Andorra',
            'United Arab Emirates',
            'Afghanistan',
            'Antigua and Barbuda',
            'Albania',
            'Angola',
            'Antarctica',
            'Argentina',
            'Austria',
            'Australia',
            'Azerbaijan',
            'Bosnia and Herzegovina',
            'Barbados',
            'Bangladesh',
            'Belgium',
            'Burkina Faso',
            'Bulgaria',
            'Bahrain',
            'Benin',
            'Brunei Darussalam',
            'Bolivia',
            'Brazil',
            'Bahamas',
            'Bhutan',
            'Botswana',
            'Belarus',
            'Belize',
            'Canada',
            'Central African Republic',
            'Congo',
            'Switzerland',
            'Cote D\'Ivoire',
            'Chile',
            'Cameroon',
            'China',
            'Colombia',
            'Costa Rica',
            'Cuba',
            'Cape Verde',
            'Cyprus',
            'Czech Republic',
            'Germany',
            'Djibouti',
            'Denmark',
            'Dominica',
            'Dominican Republic',
            'Algeria',
            'Ecuador',
            'Estonia',
            'Egypt',
            'Eritrea',
            'Spain',
            'Ethiopia',
            'Finland',
            'Fiji',
            'Falkland Islands (Malvinas)',
            'Micronesia, Federated States of',
            'France',
            'Gabon',
            'Grenada',
            'Georgia',
            'Ghana',
            'Greenland',
            'Gambia',
            'Guinea',
            'Equatorial Guinea',
            'Greece',
            'Guatemala',
            'Guam',
            'Guinea-Bissau',
            'Guyana',
            'Hong Kong',
            'Honduras',
            'Croatia',
            'Haiti',
            'Hungary',
            'Indonesia',
            'Ireland',
            'Israel',
            'India',
            'Iraq',
            'Iran, Islamic Republic of',
            'Iceland',
            'Italy',
            'Jamaica',
            'Jordan',
            'Japan',
            'Kenya',
            'Kyrgyzstan',
            'Cambodia',
            'Kiribati',
            'Comoros',
            'Korea, Democratic People\'s Republic of',
            'Korea, Republic of',
            'Kuwait',
            'Kazakhstan',
            'Lao People\'s Democratic Republic',
            'Lebanon',
            'Saint Lucia',
            'Liechtenstein',
            'Sri Lanka',
            'Liberia',
            'Lesotho',
            'Lithuania',
            'Luxembourg',
            'Latvia',
            'Libyan Arab Jamahiriya',
            'Morocco',
            'Moldova, Republic of',
            'Madagascar',
            'Marshall Islands',
            'Macedonia, the Former Yugoslav Republic of',
            'Mali',
            'Mongolia',
            'Mauritania',
            'Malta',
            'Mauritius',
            'Maldives',
            'Malawi',
            'Mexico',
            'Malaysia',
            'Mozambique',
            'Namibia',
            'Niger',
            'Nigeria',
            'Nicaragua',
            'Netherlands',
            'Norway',
            'Nepal',
            'Nauru',
            'New Zealand',
            'Oman',
            'Panama',
            'Peru',
            'Papua New Guinea',
            'Philippines',
            'Pakistan',
            'Poland',
            'Palestinian Territory, Occupied',
            'Portugal',
            'Paraguay',
            'Qatar',
            'Romania',
            'Russian Federation',
            'Rwanda',
            'Saudi Arabia',
            'Solomon Islands',
            'Seychelles',
            'Sudan',
            'Sweden',
            'Singapore',
            'Slovenia',
            'Slovakia',
            'Sierra Leone',
            'Senegal',
            'Somalia',
            'Suriname',
            'Sao Tome and Principe',
            'El Salvador',
            'Syrian Arab Republic',
            'Swaziland',
            'Chad',
            'Togo',
            'Thailand',
            'Tajikistan',
            'Turkmenistan',
            'Tunisia',
            'Tonga',
            'Turkey',
            'Trinidad and Tobago',
            'Tuvalu',
            'Taiwan, Province of China',
            'Tanzania, United Republic of',
            'Ukraine',
            'Uganda',
            'United Kingdom',
            'United States',
            'Uruguay',
            'Uzbekistan',
            'Holy See (Vatican City State)',
            'Saint Vincent and the Grenadines',
            'Venezuela',
            'Viet Nam',
            'Vanuatu',
            'Samoa',
            'Yemen',
            'South Africa',
            'Zambia',
            'Zimbabwe',
        ];
        $country_code = [
                '376',
                '971',
                '93',
                '268',
                '355',
                '244',
                '672',
                '54',
                '43',
                '61',
                '994',
                '387',
                '246',
                '880',
                '32',
                '226',
                '359',
                '973',
                '229',
                '673',
                '591',
                '55',
                '242',
                '975',
                '267',
                '375',
                '501',
                '1',
                '236',
                '242',
                '41',
                '384',
                '56',
                '237',
                '86',
                '57',
                '506',
                '53',
                '132',
                '357',
                '420',
                '49',
                '253',
                '45',
                '767',
                '839',
                '213',
                '593',
                '372',
                '20',
                '291',
                '34',
                '231',
                '358',
                '242',
                '500',
                '691',
                '33',
                '241',
                '473',
                '995',
                '233',
                '299',
                '220',
                '324',
                '240',
                '30',
                '502',
                '670',
                '245',
                '592',
                '852',
                '504',
                '385',
                '509',
                '36',
                '62',
                '353',
                '972',
                '91',
                '964',
                '98',
                '354',
                '39',
                '876',
                '962',
                '81',
                '254',
                '417',
                '855',
                '686',
                '269',
                '850',
                '82',
                '965',
                '7',
                '418',
                '961',
                '662',
                '41',
                '94',
                '231',
                '266',
                '370',
                '352',
                '371',
                '218',
                '212',
                '373',
                '261',
                '692',
                '807',
                '466',
                '976',
                '222',
                '356',
                '230',
                '960',
                '265',
                '52',
                '60',
                '258',
                '264',
                '227',
                '234',
                '505',
                '31',
                '47',
                '977',
                '674',
                '64',
                '968',
                '507',
                '51',
                '675',
                '63',
                '92',
                '48',
                null,
                '351',
                '595',
                '974',
                '40',
                '7',
                '250',
                '966',
                '677',
                '690',
                '249',
                '46',
                '65',
                '386',
                '703',
                '232',
                '221',
                '252',
                '597',
                '678',
                '503',
                '963',
                '268',
                '235',
                '228',
                '66',
                '7',
                '993',
                '216',
                '776',
                '90',
                '780',
                '688',
                '886',
                '255',
                '380',
                '256',
                '44',
                '1',
                '598',
                '998',
                '376',
                '670',
                '58',
                '84',
                '678',
                '685',
                '967',
                '27',
                '260',
                '263',
        ];

        // END: Country data
        // -----------------------------------------------------------------------------------
        // return count($country_name);
        for ($i=0; $i < count($country_name); $i++) { 
            Country::create([
                'iso' => $country_iso[$i],
                'name' => $country_name[$i],
                'country_code' =>$country_code[$i],
                // 'created_at' => date("Y-m-d h:i:s",strtotime('now')),
            ]);
        }
        
    }
}
