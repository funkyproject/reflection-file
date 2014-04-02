<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 *
 * @category    PhpStorm
 * @author     aurelien
 * @copyright  2014 Efidev
 * @version    CVS: Id:$
 */

namespace Funkyproject;


use Funkyproject\Exceptions\FileNotFoundException;

class ReflectionFile extends \ReflectionClass
{

    public function __construct($file)
    {
        parent::__construct($this->getClassByToken($file));
    }

    /**
     * @param $file
     * @return string
     * @throws \InvalidArgumentException
     *
     * @see http://stackoverflow.com/questions/7153000/get-class-name-from-file
     */
    private function getClassByToken($file)
    {

        if (false === file_exists($file)) {
            throw new FileNotFoundException(sprintf("File %s is not readable or not exist", $file));
        }

        $fp = fopen($file, 'r');

        $class = $namespace = $buffer = '';
        $i = 0;
        while (!$class) {
            if (feof($fp)) break;

            $buffer .= fread($fp, 512);
            $tokens = token_get_all($buffer);

            if (strpos($buffer, '{') === false) continue;

            for (;$i<count($tokens);$i++) {
                if ($tokens[$i][0] === T_NAMESPACE) {
                    for ($j=$i+1;$j<count($tokens); $j++) {
                        if ($tokens[$j][0] === T_STRING) {
                            $namespace .= '\\'.$tokens[$j][1];
                        } else if ($tokens[$j] === '{' || $tokens[$j] === ';') {
                            break;
                        }
                    }
                }

                if ($tokens[$i][0] === T_CLASS) {
                    for ($j=$i+1;$j<count($tokens);$j++) {
                        if ($tokens[$j] === '{') {
                            $class = $tokens[$i+2][1];
                        }
                    }
                }
            }
        }

        if($namespace == '') {
            return $class;
        }

        return sprintf("%s\\%s",$namespace, $class);
    }
} 