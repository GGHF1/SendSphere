# PHP Payment system

SendSphere is a payment system that allows users to manage their finances efficiently. It provides functionalities for user authentication, wallet management, card management, and transactions. Users can link their credit or debit cards, set a preferred card, view their wallet balance, and perform money transfers.

## Status
**Project Status**: Frozen

## Installation Steps

### 1. Clone/Download the repository

Clone or Download as ZIP this repository to your PC.

### 2. Install PHP/SQL/Composer

Make sure to install:

1. [PHP](https://www.php.net/downloads.php)
2. SQL Database, for instance, [MySQL](https://dev.mysql.com/downloads/installer/).
3. [Composer](https://getcomposer.org/download/) for managing PHP dependencies.

### 3. Create the Database

Create an account for your MySQL DB and CREATE DATABASE sendsphereDB.

### 4. Configure Environment Variables

Create and edit a ```.env``` file according to your DB. 
You can take the code from ```.env.example``` file. For example:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ToDo_Example
DB_USERNAME=root
DB_PASSWORD=1234
```
You need to set email which will be used for user verification.
After registering, the set email will send verificaiton mail to the user.
```
MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```
### 5. Install the Necessary Dependencies

Enter this command to install all necessary dependencies
```bash
composer install
```
### 6. Generate Application Key

Laravel requires an application key to be set. You can generate it by running:
```bash
php artisan key:generate
```
### 7. Migrate the Database

After configuring the ```.env``` file, run the following command to create the necessary tables in your DB:
```bash
php artisan migrate
php artisan migrate --seed
```

### 8. Serve the Application

Start the PHP server by running:
```bash
php artisan serve
```
This command will launch the server at ```http://127.0.0.1:8000/``` by default.

## Potential issues

1) extension=mbstring
The error Call to undefined function Termwind\ValueObjects\mb_strimwidth() indicates that the mb_strimwidth function is not available. This function is part of the PHP mbstring extension, which is not enabled by default.

2) extension=pdo_mysql
The error message you're encountering, "could not find driver", indicates that Laravel cannot find the MySQL PDO driver on your system. Here's how to resolve this issue:

3) Ensure the php.ini has the correct extension path: In your php.ini, ensure the extension directory is set to the correct path where your PHP extensions are located. Find the line that defines extension_dir and make sure it points to the ext folder. For example:
extension_dir = "C:\php-8.3.12\ext"

4) You can get: Call to undefined function Illuminate\Encryption\openssl_cipher_iv_length()
The error "Call to undefined function Illuminate\Encryption\openssl_cipher_iv_length()" occurs because Laravel uses the openssl extension for encryption, and it seems that the openssl extension is not enabled in your PHP installation.
extension=openssl

5) The error cURL error 60: SSL certificate problem: unable to get local issuer certificate occurs because your local environment (in this case, your development server) doesn't have the necessary SSL certificates to verify the connection to the external URL (https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml)
Steps for Windows:
Download the latest cacert.pem file:
onfigure PHP to use the downloaded cacert.pem:
Once you've downloaded cacert.pem, move it to a directory on your computer (for example, C:\php\extras\ssl\cacert.pem).
Open your php.ini file (this file is typically located in the PHP installation directory).
Find the line that starts with ;curl.cainfo and update it to point to the path of the cacert.pem file, like this:
LINK -> [CA certificates](https://curl.se/docs/caextract.html)
curl.cainfo = "C:\php-8.3.12\extras\ssl\cacert.pem"

## Current Features
### User Authentication
- **Registration**: Users can register an account.
- **Login**: Users can log in to their account.
- **User Email Verification System**: Users receive an email to verify their account.
- **Error Handling**: Displays validation and session errors to users.

### Contact Form System
- Users can fill out a contact form to send messages to the support team.

### Currency Management
- **Current Currency Price from Downloaded XML File**: Fetches and displays current currency prices from an XML file provided by the European Central Bank.
- **Currency Converter**: Converts amounts between different currencies based on the latest exchange rates.

### Wallet Management
- **Linking Card**: Users can link their credit or debit cards to their wallet.
- **Set Preferred Card**: Users can set a linked card as their preferred card.
- **View Wallet Balance**: Displays the user's wallet balance and linked cards.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/license/MIT).
