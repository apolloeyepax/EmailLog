# Laravel Email Helper/Logger

This is a laravel version 5.4 implementation of a Helper class to send e-mails. This implementation reuses a Mailable object to send mails.


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

A project setup using Laravel 5.4v or higher. 

### Installing

####Run the command : 
```
composer require deveyepax/email-log dev-master
```

Add: 
 'providers' => [
    DevEyepax\EmailLog\EmailLogServiceProvider::class,
  ]
  in config/app
  
run:
```
composer dump-autoload
```

```
php artisan vendor:push
```

```
php artisan migrate
```

After that you can use MailHelper inside controllers.. etc.

```
public function send(Request $request, MailHelper $helper){
        $helper->sendMail('123@gma.com', [], [], '', ['content' => "awesome", 'title' => 'test'], 'emails.send', '');
    }
```

## Example

```
MailHelper $helper;
$helper->sendMail($email-address, $cc, $bcc, $subject, $body, $template, $attachment-location);
```


## Authors

* **Buwaneka Kalansuriya** 

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
