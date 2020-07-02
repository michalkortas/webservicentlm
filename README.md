# Webservice with NTLM Windows Authentication
Override default SoapClient class to connect webservice with NTLM Windows authentication
## Licence
MIT
## Installation via Composer
```
composer require michalkortas/webservicentlm
```
###Laravel <5.6
Register new ServiceProvider in config/app.php
```php
michalkortas\LaravelForms\LaravelFormsServiceProvider::class
```

Register new Alias in config/app.php
```php
'NtlmSoapService' => michalkortas\WebserviceNtlm\Services\NtlmSoapService::class
```
## Usage
####Set credentials
Just add to your .enf file:
```php
NTLM_DOMAIN="domain"
NTLM_USER="user"
NTLM_PASSWORD="password"
```

####Init connection
```php
$client = NtlmSoapService::initClient('https://your_webservice_url');
$data = $client->webserviceMethod();
```

#### Change connection 
Package use config/ntlmsoapservice.php file to set domain\user credential. If you want to connect to other webservices with other credentials, set new credential type in this file, e.g.:

```php
return [
    'default' => [
        'domain' => env('NTLM_DOMAIN', 'domain'),
        'user' => env('NTLM_USER', 'user'),
        'password' => env('NTLM_PASSWORD', 'password'),
    ],
    'other_credentials' => [
        'domain' => 'domain2',
        'user' => 'user2',
        'password' => 'user3',
    ],
];
```

Add credential name as second initClient() param:

```php
$client = NtlmSoapService::initClient('https://other_webservice_url', 'other_credentials');
$data = $client->webserviceMethod();
```
####Headers
If you want add some headers to connection, just type:
```php
$client = NtlmSoapService::initClient('https://your_webservice_url');

$header = new \SoapHeader( 'http://schemas.xmlsoap.org/soap/envelope/', 'Header');
$client->__setSoapHeaders($header);

$data = $client->webserviceMethod();
```

####Get last request
If you want to show last request (e.g. send XML), check __getLastRequest() method:
```php
$client = NtlmSoapService::initClient('https://your_webservice_url');

$header = new \SoapHeader( 'http://schemas.xmlsoap.org/soap/envelope/', 'Header');
$client->__setSoapHeaders($header);

$data = $client->webserviceMethod();

var_dump($client->__getLastRequest());
```
