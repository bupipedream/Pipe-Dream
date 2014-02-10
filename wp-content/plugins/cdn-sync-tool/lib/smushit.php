<?PHP
/*
 * Copyright (c) 2009 Tyler Hall
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

    // smushit-php - a PHP client for Yahoo!'s Smush.it web service
    //
    // June 24, 2010
    // Tyler Hall <tylerhall@gmail.com>
    // http://github.com/tylerhall/smushit-php/tree/master

    class SmushIt
    {
        const SMUSH_URL = 'http://www.smushit.com/ysmush.it/ws.php?';

        public $filename;
        public $url;
        public $compressedUrl;
        public $size;
        public $compressedSize;
        public $savings;
        public $error;

        public function __construct($data = null)
        {
            if(!is_null($data))
            {
                if(preg_match('/https?:\/\//', $data) == 1)
                    $this->smushURL($data);
                else
                    $this->smushFile($data);
            }
        }

        public function smushURL($url)
        {
            $this->url = $url;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, self::SMUSH_URL . 'img=' . $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $json_str = curl_exec($ch);
            curl_close($ch);

            return $this->parseResponse($json_str);
        }

        public function smushFile($filename)
        {
            $this->filename = $filename;

            if(!is_readable($filename))
            {
                $this->error = 'Could not read file';
                return false;
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, self::SMUSH_URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('files' => '@' . $filename));
            $json_str = curl_exec($ch);
            curl_close($ch);

            return $this->parseResponse($json_str);
        }

        private function parseResponse($json_str)
        {
            $this->error = null;
            $json = json_decode($json_str);

            if(is_null($json))
            {
                $this->error = 'Bad response from Smush.it web service';
                return false;
            }

            if(isset($json->error))
            {
                $this->error = $json->error;
                return false;
            }
            $this->filename = substr (strrchr ($json->src, '/'), 1 );
            $this->size = $json->src_size;
            $this->compressedUrl = $json->dest;
            $this->compressedSize = $json->dest_size;
            $this->savings = $json->percent;
            return true;
        }
    }