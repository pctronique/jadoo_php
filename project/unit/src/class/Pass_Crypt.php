<?php

if (!class_exists('Pass_Crypt')) {

    include_once dirname(__FILE__) . '/Error_Log.php';

    class Pass_Crypt {

        public const START_PASS = '$argon2i$v=19$m=65536,t=4,p=1$';

        public static function test_Cost():int {
            $timeTarget = 0.05; // 50 millisecondes

            $cost = 8;
            do {
                $cost++;
                $start = microtime(true);
                password_hash("test", PASSWORD_ARGON2I, ["cost" => $cost]);
                $end = microtime(true);
            } while (($end - $start) < $timeTarget);

            return $cost;

        }

        public static function password(?string $pass):?string {
            $options = [
                'cost' => Pass_Crypt::test_Cost(),
            ];
            return str_replace(Pass_Crypt::START_PASS, '', password_hash("rasmuslerdorf", PASSWORD_ARGON2I, $options));
        }

        public static function verify(?string $pass, ?string $hash):bool {
            return password_verify($pass, Pass_Crypt::START_PASS.$hash);
        }

    }
}

echo Pass_Crypt::password("secret");

?>