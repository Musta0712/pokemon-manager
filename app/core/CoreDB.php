<?php
class CoreDB{

    static function getConnection(): mysqli{
        return new mysqli("127.0.0.1", "root", "Sandia4you", "pokemoncitos");

    }
}
