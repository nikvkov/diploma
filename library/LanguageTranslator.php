<?php
/**
 * Created by PhpStorm.
 * User: Crow
 * Date: 09.03.2018
 * Time: 22:26
 */

namespace services;



use Mockery\Exception;

class LanguageTranslator
{

    // это адрес API, к которому делаются все запросы
    const ENDPOINT = 'https://www.googleapis.com/language/translate/v2';

    // холдер для Вашего API key
    protected $_apiKey = "AIzaSyAZckbG5WLccOuBhDu2poCeOQCRebZ4-S0";

//    // конструктор, принимает Google API key единственным параметром
//    public function __construct($apiKey)
//    {
//        $this->_apiKey = $apiKey;
//    }

    // переводимый текст/HTML хранится в $data. Целевой язык перевода
    // в $target. Также Вы можете указать исходный язык в $source.
    public function translate($data, $target, $source = '')
    {
        // это данные для запроса
        $values = array(
            'key'    => $this->_apiKey,
            'target' => $target,
            'q'      => $data
        );

        // добавим $source, если он был указан
        if (strlen($source) > 0) {
            $values['source'] = $source;
        }

        // преобразуем массив в строку,
        // чтобы их можно было использовать с cURL
        $formData = http_build_query($values);

        // создадим соединение с API
        $ch = curl_init(self::ENDPOINT);

        // просим cURL возвращать ответ, а не выводить его
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // запишем данные в тело запроса POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $formData);

        // обмануть Google, использовать POST запрос как GET
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array('X-HTTP-Method-Override: GET'));

        // выполнить HTTP запрос
        $json = curl_exec($ch);
        curl_close($ch);

        // декодировать ответ
        $data = json_decode($json, true);

        // убедимся в том, что данные корректны
        if (!is_array($data) || !array_key_exists('data', $data)) {
            throw new Exception('Unable to find data key');
        }

        // ещё раз убедимся
        if (!array_key_exists('translations', $data['data'])) {
            throw new Exception('Unable to find translations key');
        }

        // и ещё раз
        if (!is_array($data['data']['translations'])) {
            throw new Exception('Expected array for translations');
        }

        // пройдёмся в цикле по данным и вернём первый перевод
        // если Вы переводите несколько текстов,
        // код ниже нужно поправить
        foreach ($data['data']['translations'] as $translation) {
            return $translation['translatedText'];
        }
    }

}