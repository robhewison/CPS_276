<?php

class Validation{
    private $error = false;

    public function checkFormat($value, $regex)
    {
        switch($regex){
            case "name": return $this->name($value); break;
            case "address": return $this->address($value); break;
            case "city": return $this->city($value); break;
            case "phone": return $this->phone($value); break;
            case "email": return $this->email($value); break;
            case "dob": return $this->dob($value); break;
            case "password": return $this->password($value); break;
            case "state": return $this->state($value); break;
            default: return 'regex error';
        }
    }

    private function name($value){
        return preg_match('/^[\p{L}\s\'\-]+$/u', $value) ? '' : 'Name error: should only be letters and spaces';
    }

    private function address($value){
        return preg_match('/^\d+\s[\p{L}\s]+$/u', $value) ? '' : ' Address error: should be in Number and Street format';
    }

    private function city($value){
        return preg_match('/^[\p{L}\s]+$/u', $value) ? '' : 'City error';
    }

    private function phone($value){
        return preg_match('/^\d{3}\.\d{3}\.\d{4}$/', $value) ? '' : 'Phone error: should be in 123.456.7890 format';
    }

    // php has a built-in regular expression for email validation that I'm using here
    private function email($value){
        return filter_var($value, FILTER_VALIDATE_EMAIL) ? '' : 'Email error: should be in example@test.com format';
    }

    private function dob($value){
        return preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $value) ? '' : 'Date of Birth error: should be in mm/dd/yyyy format';
    }

    private function state($value){
        return preg_match('/^[a-zA-Z ]{1,30}$/', $value) ? '' : 'State error: must be a valid state';
    }

    private function password($value){
        return !empty($value) ? '' : 'Password error: password cannot be empty';
    }
}

?>
