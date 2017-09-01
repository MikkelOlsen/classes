<?php
class Validator {
    public function email($stringMail){
        if(filter_var($stringMail, FILTER_VALIDATE_EMAIL)) return true;
        return false;
    }
}

class Eksempel extends Validator{
    public function test(){

    }
}
