<?php namespace ERA\Core\Secure;

class BiometricPassword extends Password {

    private $fingerprint_speeds = array();
    private $fingerprint_speeds_avg = array();

    private $proccess_level = 1;

    public static function init($password_input_name = null) {
         echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
         <style type="text/css">
         .bio-pass-wrapper{
            float:left;
            padding:5px;
            border-radius:50px;
            border:1px solid #ddd;
            background-color:#eee;
         }
         .bio-pass{
            float:left;
            border:1px solid transparent;
            background-color:#e5e5e5;
            width:20px;
            height:20px;
            outline:0;
            text-align:center;
            border-radius:50%;
            margin-left:5px;
            line-height:20px;

            -webkit-transition: all 500ms cubic-bezier(0.230, 1.000, 0.320, 1.000);
               -moz-transition: all 500ms cubic-bezier(0.230, 1.000, 0.320, 1.000);
                 -o-transition: all 500ms cubic-bezier(0.230, 1.000, 0.320, 1.000);
                    transition: all 500ms cubic-bezier(0.230, 1.000, 0.320, 1.000);
         }
         .bio-pass:focus{
            box-shadow:0 0 10px #bbb;
            border-color:#aaa!important;
            background-color:#fff;
         }
         .bio-disabled{
            background-color:#ccc;
            color:#eee;
         }
         </style>
        <script>
        $(document).ready(function() {

            var password_input = $("'.$password_input_name.'");
            var password = new Array();
            var run = false;
            var char;

            // Başla
            password_input.keydown(function(event) {

                char = String.fromCharCode(event.keyCode);

                password[char] = {
                    "char" : char,
                    "start_speed" : event.timeStamp,
                    "end_speed" : 0
                };

                console.log(event);

            });


            // Bitir
            password_input.keyup(function(event) {

                var index = $(this).attr("tabindex");
                $(this).addClass("bio-disabled").attr("disabled", "disabled");
                $(this).next("input").select();

                password[char].end_speed = event.timeStamp;

                console.log( (password[char].end_speed)-(password[char].start_speed) );
                console.log(password);

            });

        });
        </script>';
    }

    public function Level1(Array $fingerprints = null) {
        return $this->saveFingerprints(1, $fingerprints);
    }

    public function Level2(Array $fingerprints = null) {
        return $this->saveFingerprints(2, $fingerprints);
    }

    public function Level3(Array $fingerprints = null) {
        return $this->saveFingerprints(3, $fingerprints);
    }

    private function saveFingerprints($level, Array $fingerprints = null) {
        if ($level>1) {
            if (sizeof($fingerprints) != $this->fingerprint_speeds[$level-1]) {
                return false;
            }
        }
        $this->fingerprint_speeds[$level] = $fingerprints;
        return true;
    }

}