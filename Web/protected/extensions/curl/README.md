## 需求
* PHP 5.3+
* 安装Curl、php-curl

## 配置
* 在main.php文件中的组件部分添加:

```php
	'curl' => array(
		'class' => 'ext.curl.Curl',
		'options' => array(/* curl options */),
	),
```

## 使用
* GET

```php
	$output = Yii::app()->curl->get($url, $params);
```

* POST

```php
	$output = Yii::app()->curl->post($url, $data);
```

* PUT

```php
	$output = Yii::app()->curl->put($url, $data, $params);
```

* PATCH

```php
	$output = Yii::app()->curl->patch($url, $data);
```

* DELETE

```php
	$output = Yii::app()->curl->delete($url, $params);
```


* 配置选项

```php
	$output = Yii::app()->curl->setOption($name, $value)->get($url, $params);
	// $name & $value是CURL的options
	$output = Yii::app()->curl->setOptions(array($name => $value))->get($get, $params);
	// 配置多个
```

* 添加header

```php
    $output = Yii::app()->curl->addHeader(array('Content-Type'=> 'application/json; charset=UTF-8', 'Content-Length' => strlen($data)))->post($url, $data, $params);
```

* 实例

访问http://192.168.1.102:8080/supernote-store/goods/list

```php
    Yii::app()->curl->put('http://192.168.1.102:8080/supernote-store/goods/list', '{}');
```

或

```php
    Yii::app()->curl->addHeader(array('Content-Type'=> 'application/json;charset=UTF-8'))->post('http://192.168.1.102:8080/supernote-store/goods/list', json_encode(array('title' => 1)));
    // json_encode(array('title' => 1))可以直接写成'{title: 1}'
```

或

```php
    Yii::app()->curl->json()->post('http://192.168.1.102:8080/supernote-store/goods/list', json_encode(array('title'=>1)));
```

addHeader是设置全局header的，会影响下次的curl请求，如果需要临时添加header而不需要调用resetOption(CURLOPT_HTTPHEADER)方法，可以这样：

```php
    Yii::app()->curl->post('http://192.168.1.102:8080/supernote-store/goods/list', json_encode(array('title'=>1)), array(), array('Content-Type' => 'application/json;charset=UTF-8'));
```
或

```php
    Yii::app()->curl->post('http://192.168.1.102:8080/supernote-store/goods/list', json_encode(array('title'=>1)), array(), array('Content-Type: application/json;charset=UTF-8'));
```

options选项依然只支持全局的设置，Header头支持全局与局部两种设置方法。

测试设置的Header是否全局的可以：

```php
    Yii::app()->curl->json()->post('http://192.168.1.102:8080/supernote-store/goods/list', json_encode(array('title'=>1)));
    Yii::app()->curl->setOption('a', 'b');
    print_r(Yii::app()->curl->request_options);
    Yii::app()->curl->post('http://192.168.1.102:8080/supernote-store/goods/list', json_encode(array('title'=>1)), array(), array('Content-Type: application/json;charset=UTF-8'));
    print_r(Yii::app()->curl->request_options);
```