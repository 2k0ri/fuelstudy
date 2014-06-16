<?php
/**
 * Created by PhpStorm.
 * User: kori
 * Date: 2014/06/11
 * Time: 14:01
 * @link http://blog.9wick.com/2012/08/fuelphp-model-phpdoc/
 */
namespace Fuel\Tasks;

class ModelProperty
{
    public static function run()
    {
        $modelFiles = \File::read_dir(
            APPPATH . "classes/model",
            0,
            array(
                '\.php$' => 'file',
            )
        );

        foreach ($modelFiles as $filename) {
            if (is_string($filename)) {
                self::addProperty(APPPATH . "classes/model/", $filename);
            }
        }
    }

    public static function addProperty($dir, $filename)
    {
        $fileString = \File::read($dir . $filename, true);
        $className = self::getClassName($fileString);
        if (!$className) {
            return;
        }

        $output = "<?php" . PHP_EOL;
        $output .= "/**" . PHP_EOL;
        $properties = $className::properties();
        foreach ($properties as $name => $detail) {
            $output .= ' * @property ';
            if (isset($detail['type'])) {
                $output .= $detail['type'] . " ";
            }
            $output .= '$' . $name . PHP_EOL;
        }
        $output .= " *" . PHP_EOL;
        $output .= ' * @method ' . $className . ' forge($data = array(), $new = true, $view = null)' . PHP_EOL;
        $output .= " **/" . PHP_EOL;
        $output .= "class";

        $replacedString = preg_replace("/<\\?php(.|\n)*class/mi", $output, $fileString);

        \File::update($dir, $filename, $replacedString);
    }

    private static function getClassName($string)
    {
        $matches = array();
        preg_match("/class\\s(\\S+)\\sextends/", $string, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }

}

