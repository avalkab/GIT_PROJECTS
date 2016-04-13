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
            border:1px solid #ddd;
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
            transform:scale(1.2);
         }
         .bio-disabled{
            background-color:#ccc;
            color:#eee;
         }
         .bio-button{
            float:left;
            border-radius: 10px;
            background-color:#5fc;
            border:0;
            outline:0;
            margin-left:5px;
            height:20px;
            line-height20px;
            text-align:center;
            color:#777;
         }
         </style>
        <script>
        $(document).ready(function() {

            function checkChar(str) {
                var re = /[a-zA-Z0-9]/;
                var m;

                if ((m = re.exec(str)) !== null) {
                    return true;
                }
            }

            var password_input = $("'.$password_input_name.'");
            var password = new Array();
            var run = false;
            var start_time = 0;
            var char;

            // Başla
            password_input.keypress(function(event) {

                char = String.fromCharCode(event.keyCode);

                if(!checkChar(char)) { return false; }

                if (0 == start_time) {
                    start_time = event.timeStamp;
                }

                console.log(event);

            });


            // Bitir
            password_input.keyup(function(event) {

                if(!checkChar(char)) { return false; }

                var index = $(this).attr("tabindex");
                $(this).addClass("bio-disabled").attr("disabled", "disabled");
                $(this).next("input").select();

                if ("bio_pas_end" == $(this).attr("id")) {
                    $(".bio-pass-wrapper").append("<button class=\"bio-button\">Onayla</button>");
                }

                password[char] = {
                    "char" : char,
                    "speed" : parseInt(event.timeStamp-start_time)
                };

                start_time = 0;

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