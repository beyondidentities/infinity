<?php

declare(strict_types=1);

use App\Database\Type\UuidType;
use Cake\Cache\Cache;
use Dotenv\Dotenv;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;
use Cake\Database\Driver\Postgres;
use Cake\Database\TypeFactory;
use Cake\Cache\Engine\FileEngine;

use function Sentry\init as sentryInit;

if (!getenv('APP_NAME') && file_exists(dirname(__DIR__) . '/.env')) {
    $dotenv = Dotenv::createUnsafeImmutable(dirname(__DIR__));
    $dotenv->load();
}

Configure::write('debug', filter_var(getenv('NC_DEBUG'), FILTER_VALIDATE_BOOLEAN));

Configure::write('App', [
    'namespace' => 'App',
    'encoding' => 'UTF-8',
    'name' => (getenv('APP_NAME') ?: 'nCompass'),
    'version' => '0.9.25',
    'environment' => getenv('APP_ENV'),
]);

Configure::write('LogRocket', [
    'project_id' => getenv('LR_PROJECT_ID'),
]);

Configure::write('DigitalOcean', [
    'Spaces' => [
        'version' => 'latest',
        'region' => getenv('NC_SPACES_REGION'),
        's3_region' => getenv('NC_SPACES_S3_REGION'),
        'endpoint' => getenv('NC_SPACES_ENDPOINT'),
        'key' => getenv('NC_SPACES_API_KEY'),
        'secret' => getenv('NC_SPACES_API_SECRET'),
        'buckets' => [
            'media' => [
                'name' => getenv('NC_SPACES_MEDIA'),
            ],
        ],
    ],
]);

TypeFactory::map('uuid', UuidType::class);

Cache::setConfig([
    'default' => [
        'className' => FileEngine::class,
        'path' => CACHE,
        'url' => env('CACHE_DEFAULT_URL', null),
    ],

    /*
     * Configure the cache used for general framework caching.
     * Translation cache files are stored with this configuration.
     * Duration will be set to '+2 minutes' in bootstrap.php when debug = true
     * If you set 'className' => 'Null' core cache will be disabled.
     */
    '_cake_core_' => [
        'className' => FileEngine::class,
        'prefix' => 'myapp_cake_core_',
        'path' => CACHE . 'persistent' . DS,
        'serialize' => true,
        'duration' => '+1 years',
        'url' => env('CACHE_CAKECORE_URL', null),
    ],

    /*
     * Configure the cache for model and datasource caches. This cache
     * configuration is used to store schema descriptions, and table listings
     * in connections.
     * Duration will be set to '+2 minutes' in bootstrap.php when debug = true
     */
    '_cake_model_' => [
        'className' => FileEngine::class,
        'prefix' => 'myapp_cake_model_',
        'path' => CACHE . 'models' . DS,
        'serialize' => true,
        'duration' => '+1 years',
        'url' => env('CACHE_CAKEMODEL_URL', null),
    ],
]);

ConnectionManager::setConfig([
    'default' => [
        'className' => Connection::class,
        'driver' => Postgres::class,
        'persistent' => false,
        'host' => getenv('NC_DATABASE_HOST'),
        'port' => getenv('NC_DATABASE_PORT'),
        'username' => getenv('NC_DATABASE_USER'),
        'password' => getenv('NC_DATABASE_PASSWORD'),
        'database' => getenv('NC_DATABASE_NAME'),
        'encoding' => 'utf8',
        'cacheMetadata' => true,
        //'quoteIdentifiers' => true,
    ],
]);

Configure::write('Thinx', [
    'environments' => [
        'development' => [
            'adapter' => 'pgsql',
            'host' => getenv('NC_DATABASE_HOST'),
            'name' => getenv('NC_DATABASE_NAME'),
            'user' => getenv('NC_DATABASE_USER'),
            'pass' => getenv('NC_DATABASE_PASSWORD'),
            'port' => getenv('NC_DATABASE_PORT'),
        ],
        'production' => [
            'adapter' => 'pgsql',
            'host' => getenv('NC_DATABASE_HOST'),
            'name' => getenv('NC_DATABASE_NAME'),
            'user' => getenv('NC_DATABASE_USER'),
            'pass' => getenv('NC_DATABASE_PASSWORD'),
            'port' => getenv('NC_DATABASE_PORT'),
        ]
    ],
]);

Configure::write('Compass', [
    'Providers' => [
        'Brian Scott' => 'B. Scott',
        'Deairius Houston' => 'D. Houston',
        'Hillary Z Hines' => 'H. Hines',
        'Cheryl Gleeson' => 'C. Gleeson',
        'Mproncetpk' => 'M. White',
        'Justin Mack' => 'J. Mack',
        'Monika Henderson/Case Managerment' => 'M. Henderson',
        'Brian Scott,LSW' => 'B. Scott',
        'Joye Toombs' => 'J. Toombs',
        'Monisa Ramseur' => 'M. Ramseur',
        'Hillary Z.Hines' => 'H. Hines',
        'Michele Princeton' => 'M. White',
        'Monika Henderson' => 'M. Henderson',
        'Hillary Hines' => 'H. Hines',
        'Gail D. Anderson' => 'G. Anderson',
        'Cheryl Gleeson, LSW' => 'C. Gleeson',
        'Kara baldwin' => 'K. Baldwin',
        'Gail Anderson, LSW' => 'G. Anderson',
        'monika henderson' => 'M. Henderson',
        'Joye E. Toombs, LSW' => 'J. Toombs',
        'Kara Baldwin' => 'K. Baldwin',
        'Brian Scott, LSW' => 'B. Scott',
        'Rashwan Bradford' => 'R. Bradford',
        'Joye Toombs, LSW' => 'J. Toombs',
        'Monika  Henderson' => 'M. Henderson',
        'brian Scott, LSW' => 'B. Scott',
        'Brian Scott, lsw' => 'B. Scott',
        'Sonja Johnson' => 'S. Johnson',
        'Gail D. Anderson, LSW' => 'G. Anderson',
        'dwayne McCully' => 'D. McCully',
        'Dwayne McCully' => 'D. McCully',
        'Rashawn Bradford' => 'R. Bradford',
        'sjohnson@clevelanfdtaskforce.org' => 'S. Johnson',
        'mramseur@gmail.com' => 'M. Ramseur',
        '8' => 'K. Baldwin',
        'wsimpson@cevelandtaskforce.org' => 'W. Simpson',
        'ckelly@clevelandtaskforce.org' => 'C. Kelly',
        'jgoad@clevelandtaskforce.org' => 'J. Goad',
        'rbradford@clevelandtaskforce.org' => 'R. Bradford',
        'wsimpson@clevelandtaskforce.org' => 'W. Simpson',
        'chergleeson@clevelandtaskforce.org' => 'C. Gleeson',
        'wsiimpson@clevelandtaskforce.org' => 'W. Simpson',
        'tfoxworth@clevlenadtaskforce.org' => 'T. Foxworth',
        'AFORBES@CLEVELANDTASKFORCE.ORG' => 'A. Forbes',
        'HHINES@clevelandtaskforce.org' => 'H. Hines',
        'dhouston@clevelandtaskforce.orgorg' => 'D. Houston',
        'ganderson@clevelandtaskfroce.org' => 'G. Anderson',
        'mhenderson@clevelandtaskforce.org' => 'M. Henderson',
        'sjohnson@clevelandtaskfroce.org' => 'S. Johnson',
        'kbaldwin@clevelandtaskforce.og' => 'K. Baldwin',
        'tfoxworth@clevelanfdtaskforce.org' => 'T. Foxworth',
        'mhenderson@sbcglobal.net' => 'M. Henderson',
        'jmack@clevelandtaskforce.org' => 'J. Mack',
        'hhines@clevelanfdtaskforce.org' => 'H. Hines',
        'mprinceton@clevelandtaskforce.org' => 'M. White',
        'ckell@clevelandtaskforce.org' => 'C. Kelly',
        'jtoombs@yahoo.com' => 'J. Toombs',
        '4' => 'C. Gleeson',
        '9' => 'S. Johnson',
        'cgleeson@glevelandtaskforce.org' => 'C. Gleeson',
        'cgleeson@clevelandtaskforce.org' => 'C. Gleeson',
        'mramseur@clevelandtaskforce.orgorg' => 'M. Ramseur',
        'sjohnson@clevelandtasforce.org' => 'S. Johnson',
        'rbradford@clevelandtaskforce.ort' => 'R. Bradford',
        'cgleeson@clevelandtaskkforce.org' => 'C. Gleeson',
        'ckely@clevelandtaskforce.org' => 'C. Kelly',
        'bscott@clevelandfaskforce.org' => 'B. Scott',
        'bscott@clevelandtaskforce.org' => 'B. Scott',
        '11' => 'A.Forbes',
        'mwhite@clevelandtaskforce.org' => 'M. White',
        'ckelly@clevelandtaksforce.org' => 'C. Kelly',
        'tfoxworth@clevelandtaskforce.org' => 'T. Foxworth',
        'dhouston@clevelnadtaskforce.org' => 'D. Houston',
        'hhines@clevelandtaskforce.org' => 'H. Hines',
        'rbadford@clevelandtaskforce.org' => 'R. Bradford',
        'kbaldwin@clevelanstaskforce.org' => 'K. Baldwin',
        'mramseur@clevelandtaskforce.org' => 'M. Ramseur',
        'rbardford@clevelandtaskforce.org' => 'R. Bradford',
        'wsimpson@clevelandtaskfroce.org' => 'W. Simpson',
        '12' => 'K. Caige',
        'hhines@CLEVELANDTASKFORCE.ORG' => 'H. Hines',
        '7' => 'H. Hines',
        'jgoad@yahoo.com' => 'J. Goad',
        'jtoombs@Clevelandtaskforce.org' => 'J. Toombs',
        'wsimpson@clevlandtaskforce.oorg' => 'W. Simpson',
        '5' => 'M. Henderson',
        'hhinesn@clevelandtaskforce.org' => 'H. Hines',
        'sjohnson@clevelandtaskforce.org' => 'S. Johnson',
        'dhouston@clevelandtaskforce.ort' => 'D. Houston',
        'mhenderson@clevelandclevelandtaskforce.org' => 'M. Henderson',
        'hhines@clevlandtaskforce.org' => 'H. Hines',
        'wsimpson@clevlandtaskforce.org' => 'W. Simpson',
        'hhhines@clevelandtaskforce.org' => 'H. Hines',
        'tfoxwort@clevelandtaskforce.org' => 'T. Foxworth',
        'bscott@gmail.com' => 'B. Scott',
        'aforbes@clevelandtaskforce.org' => 'A. Forbes',
        'mhendersonj@clevelandtaskforce.org' => 'M Henderson',
        'mwhite@clevelandtaskforce.orgorg' => 'M. White',
        'ganderson@clevelandtaskforce.org' => 'G. Anderson',
        'mhenderson@clevelandtaskforce.ort' => 'M. Henderson',
        'hhines@aidstaskforce.org' => 'H. Hines',
        'mramseur@clevlandtaskforce.org' => 'M. Ramseur',
        'dhoston@clevelandtaskforce.org' => 'D. Houston',
        'dhouston@clevelandtaskforce.org' => 'D. Houston',
        'jtoombs@clevelandtaskforce.org' => 'J. Toombs',
        'jtoombs@clevelandtaskforce.ort' => 'J. Toombs',
        '3' => 'B. Scott',
        'kbaldwin@clevelandtaskforce.org' => 'K. Baldwin',
        'mhenderson@clevelandtaskforsce.org' => 'M. Henderson',
        'cgleeson1969@att.net' => 'C. Gleeson',
        'rorlowski@clevelandtaskforce.org' => 'R. Orlowski',
        'Bradford, Rashawn' => 'R. Bradford',
        'Orlowski, Robin' => 'R. Orlowski',
        'Ramseur, Monisa' => 'M. Ramseur',
        'Scott, Brian' => 'B. Scott',
        'Brian Scott' => 'B. Scott',
        'Gleeson, Cheryl' => 'C. Gleeson',
        'Cheryl Gleeson' => 'C. Gleeson',
        'Justin Mack' => 'J. Mack',
        'Princeton, Michele' => 'M. Princeton',
        'Houston, Deairius' => 'D. Houston',
        'Joye Toombs' => 'J. Toombs',
        'Monika Henderson' => 'M. Henderson',
        'Hillary Hines' => 'H. Hines',
        'Forbes, Anthony' => 'A. Forbes',
        'Kristofer Caige' => 'K. Caige',
        'Anderson, Gail' => 'G. Anderson',
        'Hines, Hillary' => 'H. Hines',
        'Anthony Forbes' => 'A. Forbes',
        'Kara Baldwin' => 'K. Baldwin',
        'Kelly, Charles' => 'C. Kelly',
        'Foxworth, Tara' => 'T. Foxworth',
        'Simpson, William' => 'W. Simpson',
        'Miquel Brazil' => 'M. Brazil',
        'Baldwin, Kara' => 'K. Baldwin',
        'Sonja Johnson' => 'S. Johnson',
        'Meredith, Nichelle' => 'N. Meredith',
        'Johnson, Sonja' => 'S. Johnson',
        'Toombs, Joye' => 'J. Toombs',
        'Henderson, Monika' => 'M. Henderson',
        'Dwayne McCully' => 'D. McCully',
        'Goad, Jeff' => 'J. Goad',
        '14' => 'S. Christian',
        'Sharon Christian' => 'S. Christian',
        'miquel@brazilliance.co' => 'M. Brazil',
        '18' => 'C. Nunez',
        'Carlos Nunez' => 'C. Nunez',
        '19' => 'M. Beebe',
        'Megan Beebe' => 'M. Beebe',
    ],
    'Demographics' => [
        'Ethnicity' => [
            'Hispanic' => 'Hispanic, Latino|a|x, Spanish Origin',
            '2' => 'Hispanic, Latino|a|x, Spanish Origin',
            'Non-Hispanic' => 'Non-Hispanic, Latino|a|x, Spanish Origin',
            '1' => 'Non-Hispanic, Latino|a|x, Spanish Origin',
            'Don\'t Know/Refused to answer' => 'No Response',
            'N/A' => 'No Response',
        ],
        'Race' => [
            '1' => 'American Indian or Alaska Native',
            '2' => 'Asian',
            '3' => 'Black or African American',
            '4' => 'Native Hawaiian or Other Pacific Islander',
            '5' => 'White',
            'White/Asian' => 'Asian',
            'African' => 'Black or African American',
            'African American' => 'Black or African American',
            'Caucasian' => 'White',
            'American-Indian' => 'American Indian or Alaska Native',
            'Multi-Racial' => 'Multi-Racial',
            'Bi-racial' => 'Multi-Racial',
        ],
        'GenderIdentity' => [
            '70' => 'Non-Binary',
            '10' =>	'Exclusively Male',
            '20' =>	'Mostly Male',
            '50' =>	'Equally Male and Female',
            '30' =>	'Mostly Female',
            '40' =>	'Exclusively Female',
            '90' =>	'Unsure/Unknown',
            '99' =>	'Other',
            'Male' => 'Exclusively Male',
            'Female' => 'Exclusively Female',
            'Transgender (male To Female)' => 'Exclusively Female',
            'Transgender' => 'Transgender',
        ],
        'SexualOrientation' => [
            '70' => 'Asexual',
            '10' => 'Exclusively Men',
            '20' => 'Mostly Men',
            '50' => 'Both Men and Women',
            '30' => 'Mostly Women',
            '40' => 'Exclusively Women',
            '90' => 'Pansexual',
            '92' => 'Unsure/Unknown',
            '99' => 'Other',
            'Heterosexual/Straight|Sexual Assault' => [ // is this what they call the sex they engage in or the gender of those they are sexually involved with?
                'Non-Binary' => 'Pansexual',
                'Exclusively Male' => 'Exclusively Women',
                'Mostly Male' => 'Exclusively Women',
                'Equally Male and Female' => 'Pansexual',
                'Mostly Female' => 'Exclusively Male',
                'Exclusively Female' => 'Exclusively Male',
                'Unsure/Unknown' => 'Other',
                'Other' => 'Other'
            ],
            'Bi-Sexual/Bi-curious|Heterosexual/Straight|MSM-Men Who Have Sex With Men' => [
                'Exclusively Male' => 'Mostly Women',
                'Mostly Male' => 'Mostly Women',
                'Equally Male and Female' => 'Other',
                'Mostly Female' => 'Unsure/Unknown',
            ]
        ],
        'MaritalStatus' => [
            'N' => 'Annulled',
            'C' => 'Common Law',
            'D' => 'Divorced',
            'P' => 'Domestic Partner',
            'E' => 'Legally Seperated',
            'G' => 'Living Together',
            'M' => 'Married',
            'R' => 'Registered Domestic Partner',
            'A' => 'Seperated',
            'S' => 'Single',
            'U' => 'Unknown',
            'B' => 'Unmarried',
            'T' => 'Unreported',
            'W' => 'Widowed',
            'O' => 'Other',
            'Domestic Partner' => 'Domestic Partner',
            'Divorced' => 'Divorced',
            'Common Law' => 'Common Law',
            'Widowed' => 'Widowed',
            'Single Parent' => 'Single',
            'Married' => 'Married',
            'Separated' => 'Seperated',
            'Single' => 'Single',
        ],
    ],
    'DataPanels' => [
        'identity' => [
            'label' => 'Identity',
            'fields' => [
                'ryan-white-number' => [
                    'label' => 'Ryan White Number',
                    'ref' => 'ryan_white_id',
                    'isValidatible' => false,
                ],
                'social-security-number' => [
                    'label' => 'Social Security Number',
                    'ref' => 'social_security_number',
                    'isValidatible' => true,
                ],
                'careware-id' => [
                    'label' => 'CAREWare ID',
                    'ref' => 'careware_id',
                    'isValidatible' => false,
                ],
                'date-of-birth' => [
                    'label' => 'Date of Birth',
                    'ref' => 'date_birth',
                    'isValidatible' => true,
                ],
            ],
        ],
        'demographic' => [
            'label' => 'Demographic',
            'fields' => [
                'ethnicity' => [
                    'label' => 'Ethnicity',
                    'ref' => 'ethnicity',
                    'normalize' => 'getNormalizedEthnicity',
                ],
                'race' => [
                    'label' => 'Race',
                    'ref' => [
                        'race',
                        'bundle.extra.race',
                    ],
                    'normalize' => 'getNormalizedRace',
                ],
                'assigned-sex' => [
                    'label' => 'Assigned Sex at Birth',
                ],
                'gender-identity' => [
                    'label' => 'Gender Identity',
                    'ref' => 'gender',
                    'normalize' => 'getNormalizedGenderIdentity',
                ],
                'gender-expression' => [
                    'label' => 'Gender Expression',
                ],
                'marital-status' => [
                    'label' => 'Marital Status',
                    'ref' => 'marital_status',
                    'normalize' => 'getNormalizedMaritalStatus',
                ],
                'sexual-orientation' => [
                    'label' => 'Sexual Orientation',
                    'ref' => 'sexual_orientation',
                    'normalize' => 'getNormalizedSexualOrientation',
                ],
            ]
        ],
        'contact' => [
            'label' => 'Contact',
            'fields' => [
                'emergency-contact' => [
                    'label' => 'Emergency Contact',
                    'group' => [
                        'first-name' => [
                            'label' => 'First Name',
                            'refs' => [
                                [
                                    'path' => 'emergency_name_first',
                                    'src' => '',
                                    'label' => '',
                                ],
                            ],
                            'value' => '',
                            'type' => '',
                            'format' => '',
                            'normalize' => '',
                        ],
                        'middle-name' => [
                            'label' => 'Middle Name',
                            'refs' => [
                                [
                                    'path' => 'emergency_name_middle',
                                    'src' => '',
                                    'label' => '',
                                ],
                            ],
                            'value' => '',
                            'type' => '',
                            'format' => '',
                            'normalize' => '',
                        ],
                        'last-name' => [
                            'label' => 'Last Name',
                            'refs' => [
                                'path' => 'emergency_name_last',
                                'src' => '',
                                'label' => '',
                            ],
                            'value' => '',
                            'type' => '',
                            'format' => '',
                            'normalize' => '',
                        ],
                        'relationship' => [
                            'label' => 'Relationship',
                            'refs' => [
                                'path' => 'emergency_relationship',
                                'src' => '',
                                'label' => '',
                            ],
                            'value' => '',
                            'type' => '',
                            'format' => '',
                            'normalize' => '',
                        ],
                        'phone-number' => [
                            'label' => 'Phone Number',
                            'refs' => [
                                'path' => 'emergency_phone',
                                'src' => '',
                                'label' => '',
                            ],
                        ]
                    ],
                    'template' => "<div>%s %s %s</div><div>%s</div><div>%s</d>",
                ]
            ]
        ],
        'housing' => [
            'label' => 'Housing'
        ],
        'finances' => [
            'label' => 'Finances'
        ],
        'medical' => [
            'label' => 'Medical'
        ],
        'mental-health' => [
            'label' => 'Mental Health'
        ],
        'substance-abuse' => [
            'label' => 'Substance Abuse'
        ],
        'transportation' => [
            'label' => 'Transportation'
        ],
    ],
    'Media' => [
        'excluded' => [
            /**
             * https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/1QCi-Acp1cw/m/8_OqIISZBgAJ
             * https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/08xvxgT8Ddc/m/9chxnNN_BgAJ
             * Reference # in second request was invalid – required deciphering
             */
            '442daf75-adb9-4aa8-9691-9e49b29bc3f3',
            /**
             * https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/1QCi-Acp1cw/m/8_OqIISZBgAJ
             * https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/08xvxgT8Ddc/m/9chxnNN_BgAJ
             */
            'dd86af2c-5f06-47bd-bc57-a707d8062865',
            /**
             * https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/1QCi-Acp1cw/m/8_OqIISZBgAJ
             * https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/08xvxgT8Ddc/m/9chxnNN_BgAJ
             */
            '92eec684-d799-422a-abb2-b2243ce85c14',
            'd489c393-0aa9-440e-8c35-0047e486f121', // https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/FcULhNb7OvE/m/Zph1ukqbBgAJ
            '599e0985-81aa-468a-a329-dabf0bfc6877', // https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/FcULhNb7OvE/m/Zph1ukqbBgAJ
            'ad15bb83-eb22-4458-ac22-20b4ce5a1932', // https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/giyWCceO9OY/m/0tmbE1ZUBgAJ
            /**
             * https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/oiFxVl2qdP4/m/nycbZY1SAQAJ
             * https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/08xvxgT8Ddc/m/9chxnNN_BgAJ
             * The second request indicates that this was for Darryl Fore, however this Client is not associated
             */
            'fc350284-1206-4103-8102-e1bcb71e25c3',
            /**
             * Reason: Incorrect Client Association
             * https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/08xvxgT8Ddc/m/9chxnNN_BgAJ
             */
            '6dd9e1c3-e911-4f38-bcc7-d87d687d34d8',
            /**
             * Reason: Incorrect Client Association
             * https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/08xvxgT8Ddc/m/9chxnNN_BgAJ
             */
            '06761efc-9644-4c8f-a57c-a64a29b9ee79',
            /**
             * Reason: Represents a conslidated Document that should be split into seprate uploads
             * https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/bU4Hkf1GPJA/m/Cr-C3jI5CgAJ
             */
            'c0c7d4b5-7fdf-4407-ae42-e13f5268286b',
            /**
             * Reason: Document incorrectly classified
             * https://groups.google.com/a/compass.clevelandtaskforce.org/g/support/c/bU4Hkf1GPJA/m/Cr-C3jI5CgAJ
             */
            '7bb81fef-2c8c-45aa-9cc4-4ddf59315ea4'
        ]
    ]
]);
