<?php
/***************************************************************************
 * Populate location table
 **************************************************************************/

// Unique identifier set by developer.
$database_update_id = 172;

// Description of what the change will do.
$update_description = "Populate location table";

// Should the database change query execute if test is "test_fail" or "test_success"
$execute_condition = "test_fail";

//This is the test query, the query should be made to get an either true or false result.
$test_condition = "SELECT *
FROM location
LIMIT 1";

// Database change
$database_update_sql = "INSERT INTO `location` (`continent_code`, `name`, `country_iso2`, `country_iso3`, `type`) VALUES
('AF', 'Africa', NULL, NULL, 'Continent'),
('AF', 'Angola', 'AO', 'AGO', 'Country'),
('AF', 'Burkina Faso', 'BF', 'BFA', 'Country'),
('AF', 'Burundi', 'BI', 'BDI', 'Country'),
('AF', 'Benin', 'BJ', 'BEN', 'Country'),
('AF', 'Botswana', 'BW', 'BWA', 'Country'),
('AF', 'Congo (Kinshasa)', 'CD', 'COD', 'Country'),
('AF', 'Central African Republic', 'CF', 'CAF', 'Country'),
('AF', 'Congo (Brazzaville)', 'CG', 'COG', 'Country'),
('AF', 'Côte d\'Ivoire', 'CI', 'CIV', 'Country'),
('AF', 'Cameroon', 'CM', 'CMR', 'Country'),
('AF', 'Cape Verde', 'CV', 'CPV', 'Country'),
('AF', 'Djibouti', 'DJ', 'DJI', 'Country'),
('AF', 'Algeria', 'DZ', 'DZA', 'Country'),
('AF', 'Egypt', 'EG', 'EGY', 'Country'),
('AF', 'Western Sahara', 'EH', 'ESH', 'Country'),
('AF', 'Eritrea', 'ER', 'ERI', 'Country'),
('AF', 'Ethiopia', 'ET', 'ETH', 'Country'),
('AF', 'Gabon', 'GA', 'GAB', 'Country'),
('AF', 'Ghana', 'GH', 'GHA', 'Country'),
('AF', 'Gambia', 'GM', 'GMB', 'Country'),
('AF', 'Guinea', 'GN', 'GIN', 'Country'),
('AF', 'Equatorial Guinea', 'GQ', 'GNQ', 'Country'),
('AF', 'Guinea-Bissau', 'GW', 'GNB', 'Country'),
('AF', 'Kenya', 'KE', 'KEN', 'Country'),
('AF', 'Comoros', 'KM', 'COM', 'Country'),
('AF', 'Liberia', 'LR', 'LBR', 'Country'),
('AF', 'Lesotho', 'LS', 'LSO', 'Country'),
('AF', 'Libya', 'LY', 'LBY', 'Country'),
('AF', 'Morocco', 'MA', 'MAR', 'Country'),
('AF', 'Madagascar', 'MG', 'MDG', 'Country'),
('AF', 'Mali', 'ML', 'MLI', 'Country'),
('AF', 'Mauritania', 'MR', 'MRT', 'Country'),
('AF', 'Mauritius', 'MU', 'MUS', 'Country'),
('AF', 'Malawi', 'MW', 'MWI', 'Country'),
('AF', 'Mozambique', 'MZ', 'MOZ', 'Country'),
('AF', 'Namibia', 'NA', 'NAM', 'Country'),
('AF', 'Niger', 'NE', 'NER', 'Country'),
('AF', 'Nigeria', 'NG', 'NGA', 'Country'),
('AF', 'Reunion', 'RE', 'REU', 'Country'),
('AF', 'Rwanda', 'RW', 'RWA', 'Country'),
('AF', 'Seychelles', 'SC', 'SYC', 'Country'),
('AF', 'Sudan', 'SD', 'SDN', 'Country'),
('AF', 'Saint Helena', 'SH', 'SHN', 'Country'),
('AF', 'Sierra Leone', 'SL', 'SLE', 'Country'),
('AF', 'Senegal', 'SN', 'SEN', 'Country'),
('AF', 'Somalia', 'SO', 'SOM', 'Country'),
('AF', 'Sao Tome and Principe', 'ST', 'STP', 'Country'),
('AF', 'Swaziland', 'SZ', 'SWZ', 'Country'),
('AF', 'Chad', 'TD', 'TCD', 'Country'),
('AF', 'Togo', 'TG', 'TGO', 'Country'),
('AF', 'Tunisia', 'TN', 'TUN', 'Country'),
('AF', 'Tanzania', 'TZ', 'TZA', 'Country'),
('AF', 'Uganda', 'UG', 'UGA', 'Country'),
('AF', 'Mayotte', 'YT', 'MYT', 'Country'),
('AF', 'South Africa', 'ZA', 'ZAF', 'Country'),
('AF', 'Zambia', 'ZM', 'ZMB', 'Country'),
('AF', 'Zimbabwe', 'ZW', 'ZWE', 'Country'),
('AN', 'Antarctica', NULL, NULL, 'Continent'),
('AN', 'Antarctica', 'AQ', 'ATA', 'Country'),
('AN', 'Bouvet Island', 'BV', 'BVT', 'Country'),
('AN', 'South Georgia and South Sandwich Islands', 'GS', 'SGS', 'Country'),
('AN', 'Heard and McDonald Islands', 'HM', 'HMD', 'Country'),
('AN', 'French Southern Lands', 'TF', 'ATF', 'Country'),
('AS', 'Asia', NULL, NULL, 'Continent'),
('AS', 'United Arab Emirates', 'AE', 'ARE', 'Country'),
('AS', 'Afghanistan', 'AF', 'AFG', 'Country'),
('AS', 'Armenia', 'AM', 'ARM', 'Country'),
('AS', 'Azerbaijan', 'AZ', 'AZE', 'Country'),
('AS', 'Bangladesh', 'BD', 'BGD', 'Country'),
('AS', 'Bahrain', 'BH', 'BHR', 'Country'),
('AS', 'Brunei Darussalam', 'BN', 'BRN', 'Country'),
('AS', 'Bhutan', 'BT', 'BTN', 'Country'),
('AS', 'Cocos (Keeling) Islands', 'CC', 'CCK', 'Country'),
('AS', 'China', 'CN', 'CHN', 'Country'),
('AS', 'Christmas Island', 'CX', 'CXR', 'Country'),
('AS', 'Cyprus', 'CY', 'CYP', 'Country'),
('AS', 'Georgia', 'GE', 'GEO', 'Country'),
('AS', 'Hong Kong', 'HK', 'HKG', 'Country'),
('AS', 'Indonesia', 'ID', 'IDN', 'Country'),
('AS', 'Israel', 'IL', 'ISR', 'Country'),
('AS', 'India', 'IN', 'IND', 'Country'),
('AS', 'British Indian Ocean Territory', 'IO', 'IOT', 'Country'),
('AS', 'Iraq', 'IQ', 'IRQ', 'Country'),
('AS', 'Iran', 'IR', 'IRN', 'Country'),
('AS', 'Jordan', 'JO', 'JOR', 'Country'),
('AS', 'Japan', 'JP', 'JPN', 'Country'),
('AS', 'Kyrgyzstan', 'KG', 'KGZ', 'Country'),
('AS', 'Cambodia', 'KH', 'KHM', 'Country'),
('AS', 'Korea, North', 'KP', 'PRK', 'Country'),
('AS', 'Korea, South', 'KR', 'KOR', 'Country'),
('AS', 'Kuwait', 'KW', 'KWT', 'Country'),
('AS', 'Kazakhstan', 'KZ', 'KAZ', 'Country'),
('AS', 'Laos', 'LA', 'LAO', 'Country'),
('AS', 'Lebanon', 'LB', 'LBN', 'Country'),
('AS', 'Sri Lanka', 'LK', 'LKA', 'Country'),
('AS', 'Myanmar', 'MM', 'MMR', 'Country'),
('AS', 'Mongolia', 'MN', 'MNG', 'Country'),
('AS', 'Macau', 'MO', 'MAC', 'Country'),
('AS', 'Maldives', 'MV', 'MDV', 'Country'),
('AS', 'Malaysia', 'MY', 'MYS', 'Country'),
('AS', 'Nepal', 'NP', 'NPL', 'Country'),
('AS', 'Oman', 'OM', 'OMN', 'Country'),
('AS', 'Philippines', 'PH', 'PHL', 'Country'),
('AS', 'Pakistan', 'PK', 'PAK', 'Country'),
('AS', 'Palestine', 'PS', 'PSE', 'Country'),
('AS', 'Qatar', 'QA', 'QAT', 'Country'),
('AS', 'Saudi Arabia', 'SA', 'SAU', 'Country'),
('AS', 'Singapore', 'SG', 'SGP', 'Country'),
('AS', 'Syria', 'SY', 'SYR', 'Country'),
('AS', 'Thailand', 'TH', 'THA', 'Country'),
('AS', 'Tajikistan', 'TJ', 'TJK', 'Country'),
('AS', 'Timor-Leste', 'TL', 'TLS', 'Country'),
('AS', 'Turkmenistan', 'TM', 'TKM', 'Country'),
('AS', 'Turkey', 'TR', 'TUR', 'Country'),
('AS', 'Taiwan', 'TW', 'TWN', 'Country'),
('AS', 'Uzbekistan', 'UZ', 'UZB', 'Country'),
('AS', 'Vietnam', 'VN', 'VNM', 'Country'),
('AS', 'Yemen', 'YE', 'YEM', 'Country'),
('EU', 'Europe', NULL, NULL, 'Continent'),
('EU', 'Andorra', 'AD', 'AND', 'Country'),
('EU', 'Albania', 'AL', 'ALB', 'Country'),
('EU', 'Austria', 'AT', 'AUT', 'Country'),
('EU', 'Åland', 'AX', 'ALA', 'Country'),
('EU', 'Bosnia and Herzegovina', 'BA', 'BIH', 'Country'),
('EU', 'Belgium', 'BE', 'BEL', 'Country'),
('EU', 'Bulgaria', 'BG', 'BGR', 'Country'),
('EU', 'Belarus', 'BY', 'BLR', 'Country'),
('EU', 'Switzerland', 'CH', 'CHE', 'Country'),
('EU', 'Czech Republic', 'CZ', 'CZE', 'Country'),
('EU', 'Germany', 'DE', 'DEU', 'Country'),
('EU', 'Denmark', 'DK', 'DNK', 'Country'),
('EU', 'Estonia', 'EE', 'EST', 'Country'),
('EU', 'Spain', 'ES', 'ESP', 'Country'),
('EU', 'Finland', 'FI', 'FIN', 'Country'),
('EU', 'Faroe Islands', 'FO', 'FRO', 'Country'),
('EU', 'France', 'FR', 'FRA', 'Country'),
('EU', 'United Kingdom', 'GB', 'GBR', 'Country'),
('EU', 'Guernsey', 'GG', 'GGY', 'Country'),
('EU', 'Gibraltar', 'GI', 'GIB', 'Country'),
('EU', 'Greece', 'GR', 'GRC', 'Country'),
('EU', 'Croatia', 'HR', 'HRV', 'Country'),
('EU', 'Hungary', 'HU', 'HUN', 'Country'),
('EU', 'Ireland', 'IE', 'IRL', 'Country'),
('EU', 'Isle of Man', 'IM', 'IMN', 'Country'),
('EU', 'Iceland', 'IS', 'ISL', 'Country'),
('EU', 'Italy', 'IT', 'ITA', 'Country'),
('EU', 'Jersey', 'JE', 'JEY', 'Country'),
('EU', 'Liechtenstein', 'LI', 'LIE', 'Country'),
('EU', 'Lithuania', 'LT', 'LTU', 'Country'),
('EU', 'Luxembourg', 'LU', 'LUX', 'Country'),
('EU', 'Latvia', 'LV', 'LVA', 'Country'),
('EU', 'Monaco', 'MC', 'MCO', 'Country'),
('EU', 'Moldova', 'MD', 'MDA', 'Country'),
('EU', 'Montenegro', 'ME', 'MNE', 'Country'),
('EU', 'Macedonia', 'MK', 'MKD', 'Country'),
('EU', 'Malta', 'MT', 'MLT', 'Country'),
('EU', 'Netherlands', 'NL', 'NLD', 'Country'),
('EU', 'Norway', 'NO', 'NOR', 'Country'),
('EU', 'Poland', 'PL', 'POL', 'Country'),
('EU', 'Portugal', 'PT', 'PRT', 'Country'),
('EU', 'Romania', 'RO', 'ROU', 'Country'),
('EU', 'Serbia', 'RS', 'SRB', 'Country'),
('EU', 'Russian Federation', 'RU', 'RUS', 'Country'),
('EU', 'Sweden', 'SE', 'SWE', 'Country'),
('EU', 'Slovenia', 'SI', 'SVN', 'Country'),
('EU', 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', 'Country'),
('EU', 'Slovakia', 'SK', 'SVK', 'Country'),
('EU', 'San Marino', 'SM', 'SMR', 'Country'),
('EU', 'Ukraine', 'UA', 'UKR', 'Country'),
('EU', 'Vatican City', 'VA', 'VAT', 'Country'),
('NA', 'North America', NULL, NULL, 'Continent'),
('NA', 'Antigua and Barbuda', 'AG', 'ATG', 'Country'),
('NA', 'Anguilla', 'AI', 'AIA', 'Country'),
('NA', 'Netherlands Antilles', 'AN', 'ANT', 'Country'),
('NA', 'Aruba', 'AW', 'ABW', 'Country'),
('NA', 'Barbados', 'BB', 'BRB', 'Country'),
('NA', 'Saint Barthélemy', 'BL', 'BLM', 'Country'),
('NA', 'Bermuda', 'BM', 'BMU', 'Country'),
('NA', 'Bahamas', 'BS', 'BHS', 'Country'),
('NA', 'Belize', 'BZ', 'BLZ', 'Country'),
('NA', 'Canada', 'CA', 'CAN', 'Country'),
('NA', 'Costa Rica', 'CR', 'CRI', 'Country'),
('NA', 'Cuba', 'CU', 'CUB', 'Country'),
('NA', 'Dominica', 'DM', 'DMA', 'Country'),
('NA', 'Dominican Republic', 'DO', 'DOM', 'Country'),
('NA', 'Grenada', 'GD', 'GRD', 'Country'),
('NA', 'Greenland', 'GL', 'GRL', 'Country'),
('NA', 'Guadeloupe', 'GP', 'GLP', 'Country'),
('NA', 'Guatemala', 'GT', 'GTM', 'Country'),
('NA', 'Honduras', 'HN', 'HND', 'Country'),
('NA', 'Haiti', 'HT', 'HTI', 'Country'),
('NA', 'Jamaica', 'JM', 'JAM', 'Country'),
('NA', 'Saint Kitts and Nevis', 'KN', 'KNA', 'Country'),
('NA', 'Cayman Islands', 'KY', 'CYM', 'Country'),
('NA', 'Saint Lucia', 'LC', 'LCA', 'Country'),
('NA', 'Saint Martin (French part)', 'MF', 'MAF', 'Country'),
('NA', 'Martinique', 'MQ', 'MTQ', 'Country'),
('NA', 'Montserrat', 'MS', 'MSR', 'Country'),
('NA', 'Mexico', 'MX', 'MEX', 'Country'),
('NA', 'Nicaragua', 'NI', 'NIC', 'Country'),
('NA', 'Panama', 'PA', 'PAN', 'Country'),
('NA', 'Saint Pierre and Miquelon', 'PM', 'SPM', 'Country'),
('NA', 'Puerto Rico', 'PR', 'PRI', 'Country'),
('NA', 'El Salvador', 'SV', 'SLV', 'Country'),
('NA', 'Turks and Caicos Islands', 'TC', 'TCA', 'Country'),
('NA', 'Trinidad and Tobago', 'TT', 'TTO', 'Country'),
('NA', 'United States of America', 'US', 'USA', 'Country'),
('NA', 'Saint Vincent and the Grenadines', 'VC', 'VCT', 'Country'),
('NA', 'Virgin Islands, British', 'VG', 'VGB', 'Country'),
('NA', 'Virgin Islands, U.S.', 'VI', 'VIR', 'Country'),
('OC', 'Oceania', NULL, NULL, 'Continent'),
('OC', 'American Samoa', 'AS', 'ASM', 'Country'),
('OC', 'Australia', 'AU', 'AUS', 'Country'),
('OC', 'Cook Islands', 'CK', 'COK', 'Country'),
('OC', 'Fiji', 'FJ', 'FJI', 'Country'),
('OC', 'Micronesia', 'FM', 'FSM', 'Country'),
('OC', 'Guam', 'GU', 'GUM', 'Country'),
('OC', 'Kiribati', 'KI', 'KIR', 'Country'),
('OC', 'Marshall Islands', 'MH', 'MHL', 'Country'),
('OC', 'Northern Mariana Islands', 'MP', 'MNP', 'Country'),
('OC', 'New Caledonia', 'NC', 'NCL', 'Country'),
('OC', 'Norfolk Island', 'NF', 'NFK', 'Country'),
('OC', 'Nauru', 'NR', 'NRU', 'Country'),
('OC', 'Niue', 'NU', 'NIU', 'Country'),
('OC', 'New Zealand', 'NZ', 'NZL', 'Country'),
('OC', 'French Polynesia', 'PF', 'PYF', 'Country'),
('OC', 'Papua New Guinea', 'PG', 'PNG', 'Country'),
('OC', 'Pitcairn', 'PN', 'PCN', 'Country'),
('OC', 'Palau', 'PW', 'PLW', 'Country'),
('OC', 'Solomon Islands', 'SB', 'SLB', 'Country'),
('OC', 'Tokelau', 'TK', 'TKL', 'Country'),
('OC', 'Tonga', 'TO', 'TON', 'Country'),
('OC', 'Tuvalu', 'TV', 'TUV', 'Country'),
('OC', 'United States Minor Outlying Islands', 'UM', 'UMI', 'Country'),
('OC', 'Vanuatu', 'VU', 'VUT', 'Country'),
('OC', 'Wallis and Futuna Islands', 'WF', 'WLF', 'Country'),
('OC', 'Samoa', 'WS', 'WSM', 'Country'),
('SA', 'South America', NULL, NULL, 'Continent'),
('SA', 'Argentina', 'AR', 'ARG', 'Country'),
('SA', 'Bolivia', 'BO', 'BOL', 'Country'),
('SA', 'Brazil', 'BR', 'BRA', 'Country'),
('SA', 'Chile', 'CL', 'CHL', 'Country'),
('SA', 'Colombia', 'CO', 'COL', 'Country'),
('SA', 'Ecuador', 'EC', 'ECU', 'Country'),
('SA', 'Falkland Islands', 'FK', 'FLK', 'Country'),
('SA', 'French Guiana', 'GF', 'GUF', 'Country'),
('SA', 'Guyana', 'GY', 'GUY', 'Country'),
('SA', 'Peru', 'PE', 'PER', 'Country'),
('SA', 'Paraguay', 'PY', 'PRY', 'Country'),
('SA', 'Suriname', 'SR', 'SUR', 'Country'),
('SA', 'Uruguay', 'UY', 'URY', 'Country'),
('SA', 'Venezuela', 'VE', 'VEN', 'Country'),
(NULL, 'World', NULL, NULL, 'Continent')";

// If the update should auto execute without user interaction set to "yes".
$database_autoexecute = "yes";

// This var should almost allways be set to "no", it is only used for certain corner cases where
// the database change has already been done in some other way and we only want to update the
// change database.
$force_insert = "no";
