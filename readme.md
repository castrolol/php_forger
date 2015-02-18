#PHP Forger

(works in PHP >= 5.4)

A simple text template to mix text and logic blocks to generate php files (or anytype of text files).

use (make sure that the php path is in your PATH environment variable)

```shell
php -f gen.php <path of your projetct>
```

Example:
  ```shell
  php -f gen.php get/myProjectWeb
```


#Templating

You can gen your PHP with PHP

```php
<?php
  class Foo {
<+
  //starting the template
  $props = array();
  $props[] = "bar";
  $props[] = "baz";
+>

  function __construct(){
    //do something
  }

<+ foreach($props as $prop){  //foreach in template +>
  public $<+=$prop+>;
<+ } +>


?>

```


will genearte


```php

<?php
  class Foo {


  function __construct(){
    //do something
  }


  public $bar;

  public $baz;



?>

```
