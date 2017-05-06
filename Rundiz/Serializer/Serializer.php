<?php
/**
 * Serializer class.
 * 
 * @package Number
 * @version 1.0.1
 * @author Vee W.
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundiz\Serializer;


/**
 * Works with serialization such as check if string is serialized.
 *
 * @author Vee W.
 * @since 1.0
 */
class Serializer
{


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
        return @unserialize($value);
    }// maybeUnserialize


}