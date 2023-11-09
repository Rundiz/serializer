<?php
/**
 * Serializer class.
 * 
 * @author Vee W.
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundiz\Serializer;


/**
 * Works with serialization such as check if string is serialized.
 *
 * @package Serializer
 * @version 1.0.5
 * @author Vee W.
 * @since 1.0
 */
class Serializer
{


    /**
     * Check if the given string is valid base 64 encoded.
     *
     * @since 1.0.4
     * @param string $data The value to check.
     * @return bool Return `true` if valid base 64 encoded, `false` for not.
     */
    public function isBase64Encoded($data)
    {
        if (!is_string($data)) {
            // if the value to check is NOT string
            // Due to base64_decode() on PHP document site require that this argument should be string, if it is not then just return false.
            return false;
        }

        $decoded = base64_decode($data, true);
        if (false === $decoded) {
            return false;
        }

        if (false === json_encode([$decoded])) {
            return false;
        }

        return true;
    }// isBase64Encoded


    /**
     * Check if JSON encoded or valid JSON string.
     * 
     * Please double check with type, otherwise it may cause unexpected result when you encode/decode it.<br>
     * Example: `$Serializer->isJSONEncoded(true);` This will return true but when you decode, it will becomes 1 (int).<br>
     * `$Serializer->isJSONEncoded('12345');` This will be also return true but when you decide, it will becomes 12345 (int).<br>
     *
     * @link https://stackoverflow.com/a/3845829/128761 Original source code.
     * @since 1.0.3
     * @param mixed $data The value to check.
     * @return boolean Return `true` if it is valid JSON, `false` for not.
     */
    public function isJSONEncoded($data)
    {
        if (!is_scalar($data)) {
            return false;
        }

        $pcre_regex = '
        /
        (?(DEFINE)
            (?<number>   -? (?= [1-9]|0(?!\d) ) \d+ (\.\d+)? ([eE] [+-]? \d+)? )    
            (?<boolean>   true | false | null )
            (?<string>    " ([^"\\\\]* | \\\\ ["\\\\bfnrt\/] | \\\\ u [0-9a-f]{4} )* " )
            (?<array>     \[  (?:  (?&json)  (?: , (?&json)  )*  )?  \s* \] )
            (?<pair>      \s* (?&string) \s* : (?&json)  )
            (?<object>    \{  (?:  (?&pair)  (?: , (?&pair)  )*  )?  \s* \} )
            (?<json>   \s* (?: (?&number) | (?&boolean) | (?&string) | (?&array) | (?&object) ) \s* )
        )
        \A (?&json) \Z
        /six   
        ';
        $pcre_regex = trim($pcre_regex);

        $checkResult = preg_match($pcre_regex, $data);
        if ($checkResult === 1) {
            return true;
        }
        return false;
    }// isJSONEncoded


    /**
     * Is serialized string.
     * 
     * @link https://core.trac.wordpress.org/browser/tags/4.7.3/src/wp-includes/functions.php#L341 Reference from WordPress.
     * @link https://gist.github.com/cs278/217091 Reference from Github cs278/is_serialized.php
     * @param string $string The string to check.
     * @return boolean Return true if serialized, false for otherwise.
     */
    public function isSerialized($string)
    {
        if (!is_string($string)) {
            return false;
        }

        $string = trim($string);

        if ($string === 'N;') {
            // if serialized string is NULL.
            return true;
        }

        $string_encoding = mb_detect_encoding($string);
        $length = mb_strlen($string, $string_encoding);
        $last_char = mb_substr($string, -1, NULL, $string_encoding);
        unset($string_encoding);

        if ($length < 4) {
            // if total characters of this string (string length) is less than 4 then it is not serialized except NULL which is verified above.
            unset($last_char, $length);
            return false;
        }

        if ($string[1] !== ':') {
            // if character number 2 (offset 1, start at 0) from this string is not colon means it is not serialized string.
            unset($last_char, $length);
            return false;
        }

        if (in_array($string[0], ['b', 'i', 'd', 's']) && $last_char !== ';') {
            // if first character maybe boolean, integer, double or float, string but last character is not semicolon means it is not serialized string.
            unset($last_char, $length);
            return false;
        } elseif (in_array($string[0], ['a', 'O']) && $last_char !== '}') {
            // last character of array, object is not right curly bracket means it is not serialized string.
            unset($last_char, $length);
            return false;
        }

        // switch to first character of this string.
        switch ($string[0]) {
            case 'b':
                // this maybe boolean
                if ($length > 4 || ($string[2] !== '0' && $string[2] !== '1')) {
                    // if string length is more than 4 or character number 3 (offset 2) is not 0 (false) and is not 1 (true) means it is not serialized string.
                    return false;
                } elseif ($length == 4 && ($string[2] === '0' || $string[2] === '1')) {
                    // if string length is exactly 4 and character number 3 (offset 2) is 0 (false) or 1 (true) means it is serialized string.
                    return true;
                } else {
                    return false;
                }
            case 'i':
                // this maybe integer
                return (boolean) preg_match('#^'.$string[0].':[0-9\-]+\\'.$last_char.'#', $string);
            case 'd':
                // this maybe double or float
                return (boolean) preg_match('#^'.$string[0].':[0-9\.E\-\+]+\\'.$last_char.'#', $string);
            case 's':
                // this maybe string
                $exp_string = explode(':', $string);
                if (isset($exp_string[1]) && isset($exp_string[2])) {
                    // if found number of total characters in serialize, count to make sure that it is matched.
                    unset($last_char, $length);
                    // number in serialized string type seems to use `strlen` because it is not counting the real unicode characters.
                    return (intval($exp_string[1]) === intval(strlen(trim($exp_string[2], ';"'))));
                }
                unset($exp_string, $last_char, $length);
                return false;
            case 'a':
                // this maybe array
            case 'O':
                // this maybe object
                return (boolean) preg_match('#^'.$string[0].':[0-9]+\:#s', $string);
        }// endswitch;

        return false;
    }// isSerialized


    /**
     * Check first that data is serialized or not, if not then serialize it otherwise return as is.
     * 
     * @param mixed $value The data to be serialize.
     * @return string Return serialized string.
     */
    public function maybeSerialize($value)
    {
        if ($this->isSerialized($value) === true) {
            return $value;
        }
        return @serialize($value);
    }// maybeSerialize


    /**
     * Check first that data is serialized or not, if yes then unserialize it otherwise return as is.
     * 
     * @since 1.0.1
     * @param mixed $value The data to be unserialize.
     * @return mixed Return unserialized value.
     */
    public function maybeUnserialize($value)
    {
        if ($this->isSerialized($value) === false) {
            return $value;
        }
        return @unserialize(trim($value));
    }// maybeUnserialize


}